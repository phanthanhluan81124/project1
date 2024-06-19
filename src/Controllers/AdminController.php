<?php

namespace Luan\Project1\Controllers;

use Luan\Project1\Models\CartDetailModel;
use Luan\Project1\Models\CartModel;
use Luan\Project1\Models\CategoryModel;
use Luan\Project1\Models\EvaluationModel;
use Luan\Project1\Models\OrderModel;
use Luan\Project1\Models\Payment_MomoModel;
use Luan\Project1\Models\ProductDetail;
use Luan\Project1\Models\ProductImageModel;
use Luan\Project1\Models\ProductModel;
use Luan\Project1\Models\UserModel;
use Luan\Project1\Models\VoucherModel;
use Luan\Project1\Phpmailer\phpmailer\SenMail;

class AdminController extends BaseController
{

    public function __construct()
    {
        $userCheck = UserModel::where('id', '=', $_SESSION['user'][0]->id)->get();
        if ($userCheck[0]->status == "ban") {
            session_destroy();
            header("Location:" . BASE_URL);
        } else {
            $_SESSION['user'] = $userCheck;
        }
    }
    public function index()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d');
        $allOrder = OrderModel::all();
        $orders = OrderModel::where('status', '=', 'delivered')->get();
        $ordersDelivered = count($orders);
        $ordersCancel = count(OrderModel::where('status', '=', 'canceled')->get());
        $ordersShip = count(OrderModel::where('status', '=', 'shiped')->get());
        $ordersPending = count(OrderModel::where('status', '=', 'pending')->get());
        $ordersNewDay = count(OrderModel::where('created_at', '=', $date)->get());
        $products = ProductModel::where('status', '=', '1')->get();
        $comments = EvaluationModel::allEvaluation();
        $allCommets = EvaluationModel::all();
        $this->renderAdmin('homeAdmin', compact('allOrder', 'products', 'orders', 'comments', 'allCommets', 'ordersShip', 'ordersDelivered', 'ordersCancel', 'ordersPending', 'ordersNewDay'));
    }
    // START CATEGORY +++=============================================================================================================================================================================================================++++++++
    public function getAllCategory()
    {
        if (isset($_POST['category_name']) && isset($_GET['id'])) {
            $data = $_POST;
            CategoryModel::update($_POST['id'], $data);
            header("Location:" . BASE_URL . 'admin/category');
        }
        if (isset($_POST['category_name']) && !isset($_POST['id'])) {
            $data = $_POST;
            $check = "";
            $categoryNameCheck = CategoryModel::all();
            foreach ($categoryNameCheck as $value) {
                if (strtolower($data['category_name']) == strtolower($value->category_name)) {
                    $check = "Danh mục đã tồn tại";
                    $this->renderAdmin('category', compact('check', 'data'));
                    break;
                }
            }
            if ($check == "") {
                $mess = "Thêm thành công";
                CategoryModel::insert($data);
                $this->renderAdmin('category', compact('mess'));
            }
        } else if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $category = CategoryModel::where('id', '=', $_GET['category_id'])->get();
            $this->renderAdmin('category', compact('category'));
        } else {
            if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                $categories = CategoryModel::getCategorySearch($_GET['keyword']);
                $count = count($categories);
                $keyword = $_GET['keyword'];
            } else {
                $count = count(CategoryModel::all());
                $keyword = "";

            }
            $number = (ceil($count / 3));
            $start = 0;
            $limit = 3;

            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $start = ($_GET['page'] - 1) * ($limit);
            }
            $categories = CategoryModel::getCategorySearchPagination($keyword, $start, $limit);
            $this->renderAdmin('Category', compact('categories', 'number'));
        }
    }
    public function deleteCategory($id)
    {
        $products = ProductModel::where('category_id', '=', $id)->get();

        foreach ($products as $value) {
            dd($value);
            $data = get_object_vars($value);
            $data['category_id'] = 1;
            ProductModel::updateProduct($value->id, $data);
        }
        CategoryModel::delete($id);
        header('Location:' . BASE_URL . 'admin/category');
    }
    // END CATEGORY +++ ==================================================================================================================================================

    // START PRODUCTS +++ ===================================================================================================================================================

    public function listProducts()
    {

        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $count = count(ProductModel::getProductSearch($_GET['keyword']));
            $keyword = $_GET['keyword'];

        } else {
            $count = count(ProductModel::where('status', '=', '1')->get());
            $keyword = "";
        }
        $number = (ceil($count / 5));
        $start = 0;
        $limit = 5;
        $price = '';
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $products = ProductModel::getProductSearchPagination($keyword, $start, $limit, $price);
        $this->renderAdmin('ListProducts', compact('products', 'number'));
    }
    public function addProduct()
    {
        $category = CategoryModel::where('id', '>', 1)->get();
        $this->renderAdmin('addProduct', compact('category'));
    }
    public function storeProduct()
    {
        $data = $_POST;
        $file = $_FILES['product_images'];
        $filename = $_FILES['product_image'];
        $image_name = $filename['name'];
        $data1 =
            [
                "product_name" => $_POST['product_name'],
                "product_price" => $_POST['product_price'],
                "discounted_price" => $_POST['discounted_price'],
                "product_describe" => $_POST['product_describe'],
                "category_id" => $_POST['category_id'],
                'product_image' => $image_name
            ];

        move_uploaded_file($filename['tmp_name'], 'upload/' . $image_name);
        $idProductNew = ProductModel::insert($data1);
        for ($i = 0; $i < count($file['name']); $i++) {
            $imageName = $file['name'][$i];
            $tmpName = $file['tmp_name'][$i];
            move_uploaded_file($tmpName, 'test/' . $imageName);
            $data2 = [
                'product_id' => $idProductNew,
                'image_name' => $imageName
            ];
            // dd($imageName);
            ProductImageModel::insert($data2);
        }
        for ($i = 0; $i < count($data['size']); $i++) {
            $size = $data['size'][$i];
            $quantity = $data['variantQuantity'][$i];
            $data3 =
                [
                    'product_id' => $idProductNew,
                    'product_quantity' => $quantity,
                    'product_size' => $size
                ];
            ProductDetail::insert($data3);
        }

        header("Location:" . BASE_URL . 'admin/products');
    }
    public function editProduct($id)
    {
        if (isset($_GET['idImage']) && !empty($_GET['idImage'])) {
            if (isset($_GET['addNewImage']) && !empty($_GET['addNewImage'])) {
                $this->renderAdmin('EditProductImageAnDeatil', []);
            } else {
                $productImage = ProductImageModel::where('product_id', '=', $id)->get();
                $this->renderAdmin('EditProductImageAnDeatil', compact('productImage'));
            }
        } else if (isset($_GET['detail']) && !empty($_GET['detail'])) {
            if (isset($_GET['addNewDetail']) && !empty($_GET['addNewDetail'])) {
                $this->renderAdmin('EditProductImageAnDeatil', []);
            } else {
                $productDetail = ProductDetail::where('product_id', '=', $id)->get();
                $this->renderAdmin('EditProductImageAnDeatil', compact('productDetail'));
            }
        } else {
            $infoProduct = ProductModel::where('id', '=', $id)->get();
            $productImage = ProductImageModel::where('product_id', '=', $id)->get();
            $productDetail = ProductDetail::where('product_id', '=', $id)->get();
            $category = CategoryModel::all();
            $this->renderAdmin('EditProduct', compact('infoProduct', 'productImage', 'productDetail', 'category'));
        }
    }
    public function editProductDetail($id)
    {

        if (isset($_GET['idImage']) && !empty($_GET['idImage'])) {
            if (isset($_GET['addNewImage']) && !empty($_GET['addNewImage'])) {
                $file = $_FILES['product_images'];
                for ($i = 0; $i < count($file['name']); $i++) {
                    $imageName = $file['name'][$i];
                    $tmpName = $file['tmp_name'][$i];
                    move_uploaded_file($tmpName, 'test/' . $imageName);
                    $data2 = [
                        'product_id' => $id,
                        'image_name' => $imageName
                    ];
                    ProductImageModel::insert($data2);
                }
            } else {
                if (isset($_POST['edit'])) {
                    for ($j = 0; $j < (int) ($_POST['QuantityPost']); $j++) {
                        $file = $_FILES['image_' . $j];
                        $filename = $file['name'];
                        $data = [
                            'image_id' => $_POST['id_' . $j],
                            'image_name' => $filename
                        ];
                        if ($filename != "") {
                            move_uploaded_file($file['tmp_name'], 'upload/' . $filename);
                            ProductImageModel::update($_POST['id_' . $j], $data);
                        }
                    }
                } else {
                    for ($i = 0; $i < (int) $_POST['QuantityPost']; $i++) {
                        ProductImageModel::delete($_POST['image_id_' . $i]);
                    }
                }
            }
        } else if (isset($_GET['detail']) && !empty($_GET['detail'])) {
            if (isset($_POST['edit'])) {
                for ($j = 0; $j < (int) $_POST['QuantityPost']; $j++) {
                    ProductDetail::updateDetail((int) $_POST['idDetail_' . $j], $_POST['variantQuantity_' . $j], $_POST['size_' . $j]);
                }
            } else if (isset($_POST['delete'])) {
                for ($i = 0; $i < (int) $_POST['QuantityPost']; $i++) {
                    ProductDetail::delete($_POST['product_detail_id_' . $i]);
                }
            } else if (isset($_GET['addNewDetail']) && !empty($_GET['addNewDetail'])) {
                for ($i = 0; $i < count($_POST['size']); $i++) {
                    $data =
                        [
                            'product_id' => $id,
                            'product_quantity' => $_POST['variantQuantity'][$i],
                            'product_size' => $_POST['size'][$i],
                        ];
                    ProductDetail::insert($data);
                }
            }
        } else {
            $product_image = ProductModel::find($id);
            $data = $_POST;
            $file = $_FILES['product_image'];
            $filename = $file['name'];
            $data['product_image'] = $filename;
            if ($data['product_image'] == "") {
                $data['product_image'] = $product_image->product_image;
                ProductModel::update($id, $data);
            } else {
                move_uploaded_file($file['tmp_name'], 'upload/' . $filename);
                ProductModel::update($id, $data);
            }
        }
        header("Location:" . BASE_URL . 'admin/product-edit-' . $id);
        die();
    }
    public function deleteProduts($id)
    {
        $infoProduct = ProductModel::find($id);
        $data = get_object_vars($infoProduct);
        $data['status'] = 0;
        ProductModel::update($id, $data);
        header("Location:" . BASE_URL . 'admin/products');
    }
    // END PRODUCT +++=============================================================================================================================================================


    // START ACCOUNTS +++=============================================================================================================================================================
    public function listAccounts()
    {
        $user = UserModel::where('id', '=', $_SESSION['user'][0]->id)->get();
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $count = count(UserModel::getUserSearch($_GET['keyword'], $user[0]->role));
            $keyword = $_GET['keyword'];
        } else {
            if ($user[0]->role == "manager") {
                $count = count(UserModel::all());
            } else {
                $count = count(UserModel::where('role', '!=', 'manager')->get());
            }
            $keyword = "";
        }
        $number = (ceil($count / 4));
        $start = 0;
        $limit = 4;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $Accounts = UserModel::getUserSearchPagination($keyword, $start, $limit, $user[0]->role);
        $this->renderAdmin('ListAccounts', compact('Accounts', 'number'));
    }
    public function addAccount()
    {
        if (isset($_POST) && !empty($_POST)) {
            $data = $_POST;
            $userCheck = UserModel::where('username', '=', $data['username'])->get();
            $emailCheck = UserModel::where('email', '=', $data['email'])->get();
            $error = [];
            $file = $_FILES['avatar'];
            $fileName = $file['name'];
            if (!isset($data['avatar'])) {
                $data['avatar'] = $fileName;
            }
            if (!empty($userCheck)) {
                $error['username'] = 'Username đã tồn tại';
            }
            if (!empty($emailCheck)) {
                $error['email'] = 'email đã tồn tại';
            }
            if (!empty($error)) {
                $this->renderAdmin('addAccount', compact('data', 'error'));
            } else {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                UserModel::insert($data);
                $mess = "Thêm Thành Công";
                $this->renderAdmin('addAccount', compact('mess'));
            }

        } else {
            $this->renderAdmin('addAccount', []);
        }
    }
    public function deleteAccounts($id)
    {
        $deleteAccounts = UserModel::find($id);
        $data = get_object_vars($deleteAccounts);
        if (isset($_GET['unban'])) {
            $data['status'] = 'active';
        } else {
            $data['status'] = "ban";
        }
        UserModel::update($id, $data);
        header("Location:" . BASE_URL . 'admin/accounts');
        die();
    }
    // END ACCOUNTS +++=============================================================================================================================================================

    // START ORDERS +++=============================================================================================================================================================

    public function listOrders()
    {
        $orderPeding = "";
        $orderToday = "";
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $count = count(OrderModel::getOrderSearch($_GET['keyword'], $orderToday, $orderPeding));
            $keyword = $_GET['keyword'];
        } else {
            $count = count(OrderModel::all());
            $keyword = "";
        }
        $number = (ceil($count / 5));
        $limit = 5;
        $start = 0;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $orders = OrderModel::getOrderSearchPagination($keyword, $orderToday, $orderPeding, $start, $limit);
        $this->renderAdmin('listOrders', compact('orders', 'number'));

    }
    public function listOrdersToday()
    {
        $date = date("Y-m-d");
        $orderPeding = "";
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $count = count(OrderModel::getOrderSearch($_GET['keyword'], $date, $orderPeding));
            $keyword = $_GET['keyword'];
        } else {
            $count = count(OrderModel::where('created_at', '=', $date)->get());
            $keyword = "";
        }
        $number = (ceil($count / 5));
        $limit = 5;
        $start = 0;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $orders = OrderModel::getOrderSearchPagination($keyword, $date, $orderPeding, $start, $limit);
        $this->renderAdmin('listOrders', compact('orders', 'number'));
    }
    public function listOrdersPeding()
    {
        $pending = 'pending';
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $date = "";
            $count = count(OrderModel::getOrderSearch($_GET['keyword'], $date, $pending));
            $keyword = $_GET['keyword'];
        } else {
            $count = count(OrderModel::where('status', '=', $pending)->get());
            $keyword = "";
        }
        $number = (ceil($count / 5));
        $limit = 5;
        $start = 0;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $orderToday = "";
        $orders = OrderModel::getOrderSearchPagination($keyword, $orderToday, $pending, $start, $limit);
        $this->renderAdmin('listOrders', compact('orders', 'number'));
    }
    public function orderDetail($id)
    {
        $inforOrder = OrderModel::where('order_id', '=', $id)->get();
        $orderDetail = OrderModel::getOrderDetail($id);
        $this->renderAdmin('OrderDetail', compact('inforOrder', 'orderDetail'));
    }
    // CANCEL ORDER ===============================================================================
    public function UpdateOrder($id)
    {
        if (isset($_POST)) {
            $data = $_POST;
            $inforOrder = OrderModel::where('order_id', '=', $id)->get();
            if (isset($data['update'])) {
                if ($inforOrder[0]->status == "pending") {
                    $inforOrder[0]->status = "processing";
                    OrderModel::update($id, get_object_vars($inforOrder[0]));
                } else if ($inforOrder[0]->status == "processing") {
                    $inforOrder[0]->status = "shiped";
                    OrderModel::update($id, get_object_vars($inforOrder[0]));
                }
            }
            if (isset($data['cancel'])) {
                $inforOrder[0]->status = 'canceled';
                OrderModel::update($id, get_object_vars($inforOrder[0]));
            }
            header("Location:" . BASE_URL . 'admin/orders-detail-' . $id);
            die();
        }
    }
    public function billMomo()
    {
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $count = count(Payment_MomoModel::getPaymentSearch($_GET['keyword']));
            $keyword = $_GET['keyword'];
        } else {
            $count = count(Payment_MomoModel::all());
            $keyword = "";
        }
        $number = (ceil($count / 5));
        $limit = 5;
        $start = 0;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $bills = Payment_MomoModel::getPaymentSearchPagination($keyword, $start, $limit);
        $this->renderAdmin('BillPayment_Momo', compact('bills', 'number'));

    }
    public function billMomoDetail($id)
    {
        $bills = Payment_MomoModel::find($id);
        $this->renderAdmin('BillMomoDetail', compact('bills'));
    }
    public function voucher()
    {
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $count = count(VoucherModel::getVoucherSearch($_GET['keyword']));
            $keyword = $_GET['keyword'];
        } else {
            $count = count(VoucherModel::all());
            $keyword = "";
        }
        $number = (ceil($count / 5));
        $limit = 5;
        $start = 0;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $vouchers = VoucherModel::getVoucherSearchPagination($keyword, $start, $limit);
        $this->renderAdmin('Voucher', compact('vouchers', 'number'));
    }
    public function addVoucher()
    {
        $this->renderAdmin('addVoucher', []);
    }
    public function EditVoucher($id)
    {
        $infoVoucher = VoucherModel::find($id);
        $this->renderAdmin('addVoucher', compact('infoVoucher'));
    }
    public function addVoucherNew()
    {
        $data = [
            'code' => trim($_POST['code']),
            'value' => $_POST['value'],
            'category_code' => $_POST['category_code'],
            'date_start' => $_POST['date_start'],
            'date_end' => $_POST['date_end'],
            'quantity' => $_POST['quantity']
        ];
        $error = [];
        $checked = VoucherModel::where('code', '=', $data['code'])->get();
        if (count($checked) > 0) {
            $error['code'] = "Mã giảm giá đã tồn tại";
            $this->renderAdmin('addVoucher', compact('data', 'error'));
        } else {
            VoucherModel::insert($data);
            $mess = "Thêm mã giảm giá thành công";
            $this->renderAdmin('addVoucher', compact('mess'));
        }
    }
    public function updateVoucher($id)
    {
        $infoVoucher = VoucherModel::find($id);
        $data = [
            'code' => trim($_POST['code']),
            'value' => $_POST['value'],
            'category_code' => $_POST['category_code'],
            'date_start' => $_POST['date_start'],
            'date_end' => $_POST['date_end'],
            'quantity' => $_POST['quantity']
        ];
        if ($data['date_start'] == "") {
            $data['date_start'] = $infoVoucher->date_start;
        }
        if ($data['date_end'] == "") {
            $data['date_end'] = $infoVoucher->date_end;
        }
        $error = [];
        if ($data['code'] == $infoVoucher->code) {
            VoucherModel::update($id, $data);
            $mess = "Thay đổi mã giảm giá thành công";
            $this->renderAdmin('addVoucher', compact('mess', 'infoVoucher'));
        } else {
            $checked = VoucherModel::where('code', '=', $data['code'])->get();
            if (count($checked) > 0) {
                $error['code'] = "Mã giảm giá đã tồn tại";
                $this->renderAdmin('addVoucher', compact('infoVoucher', 'error'));
            } else {
                VoucherModel::update($id, $data);
                $mess = "Thay đổi mã giảm giá thành công";
                $this->renderAdmin('addVoucher', compact('mess', 'infoVoucher'));
            }
        }
    }
}
