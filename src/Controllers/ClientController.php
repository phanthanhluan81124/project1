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





class ClientController extends BaseController
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    // Start Product ==============================================================================================================================================================
    public function index()
    {
        if (isset($_GET['partnerCode'])) {
            $data = [
                'partnerCode' => $_GET['partnerCode'],
                'orderId' => $_GET['orderId'],
                'requestId' => $_GET['requestId'],
                'amount' => $_GET['amount'],
                'orderInfo' => $_GET['orderInfo'],
                'orderType' => $_GET['orderType'],
                'transId' => $_GET['transId'],
                'payType' => $_GET['payType'],
                'signature' => $_GET['signature']
            ];
            Payment_MomoModel::insert($data);

        }
        $products = ProductModel::getProductHot();
        $productsNew = ProductModel::getProductNew();
        $categories = CategoryModel::where('id', '>', 1)->get();
        $this->renderClient('home', [
            'products' => $products,
            'categories' => $categories,
            'productsNew' => $productsNew
        ]);

    }
    // PRODUCT SEARCH =================================================================================================
    public function productSearch()
    {

        if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
            $count = ProductModel::getProductSearch($_GET['keyword']);
            $number = ceil(count($count) / 3);
            $limit = 3;
            $start = 0;
            $price = "desc";
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $start = ($_GET['page'] - 1) * ($limit);
            }
            if (isset($_GET['gia']) && !empty($_GET['gia'])) {
                $price = $_GET['gia'];
            }
            $keyword = $_GET['keyword'];
            $categories = CategoryModel::where('id', '>', 1)->get();
            $productSearch = ProductModel::getProductSearchPagination($_GET['keyword'], $start, $limit, $price);
            $this->renderClient('searchProduct', compact('keyword', 'productSearch', 'categories', 'number'));
        } else {
            header("Location:" . BASE_URL);
        }
    }



    // PRODUCT DETAIL ===============================================================================
    public function detail($id)
    {

        $images = ProductImageModel::where('product_id', '=', $id)->andWhere('product_id', 'ORDER BY', '')->get();
        $product = ProductModel::find($id);
        $comment = ProductModel::getComment($id);
        $productSize = ProductDetail::where('product_id', '=', $id)->get();
        $products = ProductModel::getEvaluation($product->category_id, $id);
        $category = CategoryModel::where('id', '=', $product->category_id)->get();
        $categories = CategoryModel::where('id', '>', 1)->get();
        $this->renderClient('detail', compact('product', 'productSize', 'products', 'comment', 'categories', 'category', 'images'));
    }

    // GET PRODUCT CATEGORY ===============================================================================
    public function getProductCategory($id)
    {
        $count = ProductModel::where('category_id', '=', $id)->get();
        if ($count[0]->id != "") {
            $number = ceil(count($count) / 3);
            $limit = 3;
            $start = 0;
            $price = "desc";
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $start = ($_GET['page'] - 1) * ($limit);
            }
            if (isset($_GET['gia']) && !empty($_GET['gia'])) {
                $price = $_GET['gia'];
            }
            $products = ProductModel::getEvaluationCategory($count[0]->category_id, $id, $start, $limit, $price);
            $categories = CategoryModel::where('id', '>', 1)->get();
            $this->renderClient('category', compact('products', 'categories', 'number'));
        } else {
            header("Location:" . BASE_URL);
        }


    }
    public function getProducts()
    {

        $count = ProductModel::all();
        $number = ceil(count($count) / 3);
        $limit = 3;
        $start = 0;
        $price = "desc";
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        if (isset($_GET['gia']) && !empty($_GET['gia'])) {
            $price = $_GET['gia'];
        }


        $products = ProductModel::getAllProduct($start, $limit, $price);
        $categories = CategoryModel::where('id', '>', 1)->get();
        $this->renderClient('listProduct', compact('products', 'categories', 'number'));


    }
    // end Product ==============================================================================================================================================================

    // Start User ==============================================================================================================================================================

    // LOGIN ===============================================================================
    public function login()
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $this->renderClient('login', ['categories' => $categories]);
    }
    // CHECK LOGIN ===============================================================================
    public function loginCheck()
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $userCheckForgotPass = UserModel::all();
        if (isset($_POST['code']) && !empty($_POST['code'])) {
            $_SESSION['resPass'] = 'pass';
            unset($_SESSION['code']);
            header("Location:" . BASE_URL . 'login');
        }
        if (isset($_POSt) && !empty($_POST) && !empty($_POST['email']) && !isset($_POST['code'])) {
            $data = $_POST;
            if (isset($data['newPass'])) {
                $ForgotPass = UserModel::where('email', '=', $data['email'])->get();
                $dataPass = get_object_vars($ForgotPass[0]);
                $dataPass['password'] = password_hash($data['newPass'], PASSWORD_DEFAULT);
                // dd($ForgotPass);
                // dd($dataPass);
                // die();
                // $dataPass[] = $data['newPass'];
                UserModel::update($dataPass['id'], $dataPass);
                session_destroy();
                header("Location:" . BASE_URL . 'login');
            } else {
                foreach ($userCheckForgotPass as $item) {
                    if ($data['email'] == $item->email) {
                        dd($_GET['url']);
                        $title = "Mã xác thực email";
                        $code = substr(rand(0, 99999), 0, 6);
                        $content = "Mã xác nhận của bạn là : <span style = 'color:green; font-size:20px;'>" . $code . "</span>";
                        SenMail::SenMail($title, $content, $data['email']);
                        $_SESSION['emailCheck'] = $data['email'];
                        $_SESSION['code'] = $code;
                        header("Location:" . BASE_URL . 'login');
                        break;
                    } else {
                        $mess1 = "Email không tồn tại";
                        $this->renderClient('login', compact('mess1', 'categories', 'data'));
                        break;
                    }
                }
            }
        }
        if (!empty($_POST) && empty($_POST['email'])) {

            $data = $_POST;
            $mess = "";
            // dd($data);
            // die();
            if (($data['username']) == "" || $data['password'] == "") {
                $mess = 'Vui lòng nhập đầy đủ thông tin ';
                $this->renderClient('login', compact('mess', 'categories', 'data'));
            } else {
                // $data['password'] = password_verify($loginPassword, $hashedPassword);
                $passCheck = UserModel::where('username', '=', $data['username'])->get();
                $password = password_verify($data['password'], $passCheck[0]->password);
                // $user = UserModel::getByEmailAndPassword($data['username'], $data['password']);
                if (!$password) {
                    $mess = 'Thông tin đăng nhập không chính xác';
                    $this->renderClient('login', compact('mess', 'categories', 'data'));
                } else {
                    $_SESSION['user'] = $passCheck;
                    $cart = $_SESSION['user'][0]->id;
                    $cart_id = CartModel::where('user_id', '=', $cart)->get();
                    $_SESSION['cart'] = $cart_id;
                    header("Location:" . BASE_URL);
                    die();
                }
            }
        }
    }
    // REGISTER ===============================================================================
    public function register()
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $this->renderClient('register', ['categories' => $categories]);
    }
    // CHECK REGISTER ===============================================================================
    public function registerCheck()
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $userCheck = UserModel::all();
        $data = $_POST;
        $mess = [];
        $check = true;
        foreach ($userCheck as $user) {
            if ($data['email'] == $user->email) {
                $mess['email'] = "Email đã tồn tại";
                $check = false;
                $this->renderClient('register', compact('data', 'mess'));
                break;
            }
            if ($data['username'] == $user->username) {
                $mess['username'] = "Tên đăng nhập đã tồn tại";
                $check = false;
                $this->renderClient('register', compact('data', 'mess'));
                break;
            }
        }
        if ($check != false) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user_id = UserModel::insert($data);
            CartModel::insertCart($user_id);
            header("Location:" . BASE_URL . 'login');
            die();
        }

    }

    // LOGOUT ===============================================================================
    public function logout()
    {
        session_destroy();
        header("Location:" . BASE_URL);
        die();
    }
    // GET INFOR USER ===============================================================================
    public function getInforUser($id)
    {
        if ($_SESSION['user'][0]->id === $id) {
            $userInfor = UserModel::getinfor($id);
            $categories = CategoryModel::where('id', '>', 1)->get();
            $this->renderClient('inforUser', compact('userInfor', 'categories'));
        } else {
            $id = $_SESSION['user'][0]->id;
            $userInfor = UserModel::getinfor($id);
            $categories = CategoryModel::where('id', '>', 1)->get();
            $this->renderClient('inforUser', compact('userInfor', 'categories'));

        }

    }
    // UPDATE INFOR USER  ===============================================================================
    public function updateInforUser($id)
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $userInfor = UserModel::getinfor($id);
        $data = $_POST;
        // dd($data);
        // die();
        // dd($data);
        // die();
        $pattern = '/^(0|\+84|\+841|\+849|\+8498)([2-9]\d{8})$/';
        $mess = [];
        $file = $_FILES['avatar'];
        $image_name = $file['name'];

        if ($data['email'] == "") {
            $mess['email'] = 'Vui lòng nhập đầy đủ thông tin ';

        }
        if ($data['email'] != "" && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $mess['email'] = 'Email không đúng định dạng ';
        }
        if ($data['tel'] != '' && !preg_match($pattern, $data['tel'])) {

            $mess['tel'] = 'Số điện thoại không đúng định dạng ';
        }

        if ($file['size'] > 0) {
            $image = $file['name'];
            $data['avatar'] = $image_name;
            move_uploaded_file($file['tmp_name'], 'upload/' . $image);

        }
        if (!empty($mess)) {
            unset($_SESSION['all']);
            $this->renderClient('inforUser', compact('mess', 'categories', 'userInfor'));
        }
        if (!isset($_GET['changepass'])) {
            $data['password'] = $userInfor[0]->password;
            UserModel::update($id, $data);
            $mes['all'] = "Lưu Thành Công";
            $this->renderClient('inforUser', compact('mes', 'categories', 'userInfor'));
        } else {
            $passCheck = password_verify($data['oldPassword'], $userInfor[0]->password);
            if (!$passCheck) {
                $mes['error'] = "Mật khẩu cũ không đúng";
                $this->renderClient('inforUser', compact('mes', 'categories', 'userInfor','data'));
            } else {
                $data1 = [
                    'email' => $_POST['email'],
                    'fullname' => $_POST['fullname'],
                    'tel' => $_POST['tel'],
                    'address' => $_POST['address'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
                ];
                UserModel::update($id, $data1);
                $mes['all'] = "Lưu Thành Công";
                $this->renderClient('inforUser', compact('mes', 'categories', 'userInfor'));
            }
        }



    }
    // END USER=============================================================================================================================================================================================================================================


    // START CART ==============================================================================================================================================================

    // GET CART ===============================================================================
    public function getCart($id)
    {
        if (isset($_POST['cart_detail_id'])) {
            $data = $_POST;
            // dd($data);
            // die();
            CartDetailModel::updateDetail($data['cart_detail_id'], $data);
            header("Location:" . BASE_URL . 'cart/' . $id);
            die();

        }
        if ($_SESSION['user'][0]->id === $id) {
            $categories = CategoryModel::where('id', '>', 1)->get();
            $cart = CartModel::getCart($id);
            $sumCart = CartModel::getSumCart($id);
            // dd($sum);
            // die();
            unset($_SESSION['code']);
            $this->renderClient('cart', compact('categories', 'cart', 'sumCart'));
        } else {
            $id = $_SESSION['user'][0]->id;
            $categories = CategoryModel::where('id', '>', 1)->get();
            $cart = CartModel::getCart($id);
            $sumCart = CartModel::getSumCart($id);
            // dd($sum);
            // die();
            unset($_SESSION['code']);
            $this->renderClient('cart', compact('categories', 'cart', 'sumCart'));
        }

    }
    // ADD CART ===============================================================================
    public function addCart($id)
    {
        $data = $_POST;
        $cart = CartModel::getCart($_SESSION['user'][0]->id);
        // // dd($_SESSION['user'][0]->id);
        // dd($cart);
        // dd(count($cart) == 3);

        // die();
        $images = ProductImageModel::where('product_id', '=', $id)->andWhere('product_id', 'ORDER BY', '')->get();
        $product = ProductModel::find($id);
        $comment = ProductModel::getComment($id);
        $productSize = ProductDetail::where('product_id', '=', $id)->get();
        $products = ProductModel::getEvaluation($product->category_id, $id);
        $category = CategoryModel::where('id', '=', $product->category_id)->get();
        $categories = CategoryModel::where('id', '>', 1)->get();
        $check = 0;
        if (isset($data['number_stars'])) {
            $userCheckBuy = OrderModel::checkComment($data['user_id']);
            foreach ($userCheckBuy as $value) {
                if ($value->id == $data['product_id']) {
                    // $check = 3;
                    $data['number_stars'] = (int) $data['number_stars'];
                    EvaluationModel::insert($data);
                    header("Location:" . BASE_URL . 'detail/' . $id);
                    die();
                } else {
                    $check = 3;
                    $this->renderClient('detail', compact('check', 'product', 'productSize', 'products', 'comment', 'categories', 'category', 'images'));
                }
            }
        }
        if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
            $product_size = ProductDetail::where('product_detail_id', '=', $data['product_detail_id'])->get();

            // dd(count($cart));
            // die();
            if (count($cart) == 0) {
                $data['total'] = $data['total'] * $data['product_quantity'];
                $data['product_size'] = $product_size[0]->product_size;
                CartModel::insertCartDetail($data);
                header("Location:" . BASE_URL . 'detail/' . $id);
            } else if (count($cart) != 0) {
                $hello = "";
                foreach ($cart as $value) {
                    if ($value->product_detail_id == $data['product_detail_id']) {
                        if (((int) $data['product_quantity'] + $value->product_quantity) <= $value->quantityProductDetail) {
                            $data['product_quantity'] += $value->product_quantity;
                            $data['total'] = $data['total'] * $data['product_quantity'];
                            CartModel::updateCartDetail($data['product_detail_id'], $data);
                            $hello = true;
                            header("Location:" . BASE_URL . 'detail/' . $id);
                            break;

                        } else {
                            $check = 2;
                            $hello = true;
                            $this->renderClient('detail', compact('check', 'product', 'productSize', 'products', 'comment', 'categories', 'category', 'images'));
                        }
                    }
                }
                if ($hello != true) {
                    $data['total'] = $data['total'] * $data['product_quantity'];
                    $data['product_size'] = $product_size[0]->product_size;
                    CartModel::insertCartDetail($data);
                    header("Location:" . BASE_URL . 'detail/' . $id);
                }
                // header("Location:" . BASE_URL . 'detail/' . $id);
            }
        }
    }
    // DETELTE CART ===============================================================================
    public function deleteCartDetail($id)
    {
        CartModel::deleteCart($id);
        header("Location:" . BASE_URL . 'cart/' . $_SESSION['user'][0]->id);
        die();
    }

    // END CART ==============================================================================================================================================================

    // START ORDER ==============================================================================================================================================================

    // GET ORDER ===============================================================================
    public function getOrder($id)
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $cart = CartModel::getCartOrder($id);
        $user = UserModel::where('id', '=', $id)->get();
        // dd($user);
        $this->renderClient('order', compact('categories', 'cart', 'user'));

    }
    // CHECK INFOR ORDER ===============================================================================

    public function updateAndInsertOder($cart, $data, $cartAll)
    {
        foreach ($cart as $item) {
            $idpd = $item->product_detail_id;
            $product_price = $item->product_price;
            $product_quantity_cart = $item->product_quantity;
            $cart_detali_id = $item->cart_detail_id;
            $order_id = OrderModel::insertOrder($data['user_id'], $data['fullname'], $data['email'], $data['tel'], $data['address'], $data['total'], $data['total_discount'], $data['payment_method'], $data['status'],$data['note']);
            OrderModel::insertOrderDetail($order_id, $idpd, $product_price, $product_quantity_cart);
            $prd = ProductDetail::where('product_detail_id', '=', $idpd)->get();
            $product_quantity_detail = $prd[$i]->product_quantity - $product_quantity_cart;
            ProductDetail::updateQuantity($idpd, $product_quantity_detail);
            foreach ($cartAll as $key) {
                if ($key->product_detail_id == $idpd && $key->product_quantity > $product_quantity_detail && $product_quantity_detail > 0) {
                    CartModel::updateCart($idpd, $product_quantity_detail, 1);
                } else if ($key->product_detail_id == $idpd && $key->product_quantity > $product_quantity_detail && $product_quantity_detail == 0) {
                    CartModel::updateCart($idpd, 1, 0);
                }
            }
            CartModel::deleteCart($cart_detali_id);
            $i++;
        }
        $data_voucher =
            [
                "voucher_id" => $_SESSION['code'][0]->voucher_id,
                "code" => $_SESSION['code'][0]->code,
                "value" => $_SESSION['code'][0]->value,
                "category_code" => $_SESSION['code'][0]->category_code,
                "date_start" => $_SESSION['code'][0]->date_start,
                "date_end" => $_SESSION['code'][0]->date_end,
                "quantity" => $_SESSION['code'][0]->quantity - 1

            ];
        VoucherModel::update($_SESSION['code'][0]->voucher_id, $data_voucher);

    }

    public function order($id)
    {
        $data = $_POST;
        dd($data);
        $pattern = '/^(0|\+84|\+841|\+849|\+8498)([2-9]\d{8})$/';
        $code = $_POST['code'];
        $categories = CategoryModel::where('id', '>', 1)->get();
        $cart = CartModel::getCartOrder($id);
        $cartAll = CartModel::all();
        $product_detail = ProductDetail::all();
        // dd($cart);
        // die();
        $prd = ProductDetail::all();

        $user = UserModel::where('id', '=', $id)->get();
        // dd($user);
        $mess = [];

        if ($data['fullname'] == "") {
            $mess['fullname'] = "Vui lòng nhập họ và tên";
        } else if (strlen(($data['fullname'])) < 6 || strlen(($data['fullname'])) > 256) {
            $mess['fullname'] = "Họ và tên phải lớn hơn 6 kí tự và nhỏ hơn 256 kí tự";
        }
        if ($data['email'] == "") {
            $mess['email'] = "Vui lòng Email";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $mess['email'] = "Email không đúng định dạng";
        }
        if ($data['tel'] == "") {
            $mess['tel'] = "Vui lòng nhập số điện thoại";
        } else if ($data['tel'] != '' && !preg_match($pattern, $data['tel'])) {
            $mess['tel'] = 'Số điện thoại không đúng định dạng ';
        }
        if ($data['address'] == "") {
            $mess['address'] = "Vui lòng nhập Địa chỉ";
        } else if (strlen(($data['address'])) < 6 && strlen(($data['address'])) > 256) {
            $mess['address'] = "Địa chỉ phải lớn hơn 6 kí tự và nhỏ hơn 256 kí tự";
        }
        if ($code != "") {
            $codeCheck = VoucherModel::where('code', '=', $code)->get();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            // dd(date('Y-m-d h:i:s') );
            // die();
            // dd($codeCheck);
            // die();
            if (empty($codeCheck)) {
                $mess['code'] = "Voucher không đúng";
                unset($_SESSION['code']);
                $this->renderClient('order', compact('categories', 'cart', 'user', 'mess', 'data'));
            } else {
                if (date('Y-m-d h:i:s') > $codeCheck[0]->date_start && date('Y-m-d') < $codeCheck[0]->date_end && $codeCheck[0]->quantity >= 1) {
                    $_SESSION['code'] = $codeCheck;
                    $this->renderClient('order', compact('categories', 'cart', 'user', 'data'));
                } else {
                    $mess['code'] = "Voucher đã hết hạn hoặc đã hết số lượt dùng";
                    unset($_SESSION['code']);
                    $this->renderClient('order', compact('categories', 'cart', 'user', 'mess', 'data'));
                }

            }
        } else if (!empty($mess)) {
            $this->renderClient('order', compact('categories', 'cart', 'user', 'mess', 'data'));
        } else {
            $i = 0;
            $check = "";
            foreach ($cart as $item) {
                $idpd = $item->product_detail_id;
                $product_price = $item->product_price;
                $product_quantity_cart = $item->product_quantity;
                $cart_detali_id = $item->cart_detail_id;
                if ($item->quantityProductDetail < $product_quantity_cart) {
                    $quantity_check = 1;
                    $check = false;
                    CartModel::updateCart($idpd, 1, 0);
                    $this->renderClient('order', compact('categories', 'quantity_check', 'cart', 'user', 'mess', 'data'));
                    break;
                }
            }
            if ($check == "") {
                if ($data['payment_method'] == 'banking') {

                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                    $partnerCode1 = 'MOMOBKUN20180529';
                    $accessKey1 = 'klm05TvNBzhg7h7j';
                    $secretKey1 = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                    $orderInfo1 = "Thanh toán qua MoMo";
                    $amount1 = $data['total_discount'];
                    $orderId1 = time() . "";
                    $redirectUrl1 = "http://project-1.test/";
                    $ipnUrl1 = "http://project-1.test/";
                    $extraData1 = "";

                    $partnerCode = $partnerCode1;
                    $accessKey = $accessKey1;
                    $serectkey = $secretKey1;
                    $orderId = $orderId1; // Mã đơn hàng
                    $orderInfo = $orderInfo1;
                    $amount = $amount1;
                    $ipnUrl = $ipnUrl1;
                    $redirectUrl = $redirectUrl1;
                    // $extraData = $extraData1;

                    $requestId = time() . "";
                    // $requestType = "payWithATM"; // thanh toán vs atm
                    $requestType = "captureWallet"; // thanh toán với qr code
                    $extraData = "hello1234";

                    //before sign HMAC SHA256 signature
                    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                    $signature = hash_hmac("sha256", $rawHash, $serectkey);
                    $data = array(
                        'partnerCode' => $partnerCode,
                        'partnerName' => "Test",
                        "storeId" => "MomoTestStore",
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature
                    );
                    $result = $this->execPostRequest($endpoint, json_encode($data));

                    $jsonResult = json_decode($result, true); 
                     // decode json
                    $data1 = $_POST;
                    $this->updateAndInsertOder($cart, $data1, $cartAll);

                    header('Location: ' . $jsonResult['payUrl']);

                } else {
                    // $this->updateAndInsertOder($cart, $data, $cartAll,);
                }
            }
            header("Location:" . BASE_URL);
            die();
        }
    }
    // GET LIST ORDER ===============================================================================
    public function getListOrder($id)
    {
        $id = $_SESSION['user'][0]->id;
        $categories = CategoryModel::where('id', '>', 1)->get();
        $count = OrderModel::where('user_id', '=', $id)->get();
        $number = ceil(count($count) / 3);
        $limit = 3;
        $start = 0;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $start = ($_GET['page'] - 1) * ($limit);
        }
        $listOrder = OrderModel::getOrder($id, $start, $limit);
        unset($_SESSION['code']);
        $this->renderClient('listOrder', compact('categories', 'listOrder', 'number'));
    }
    public function cancelOrder($id)
    {
        $data = $_POST;
        $data['user_id'] = $id;
        $data['status'] = "canceled";
        dd($data);
        OrderModel::update($data['order_id'], $data);
        header("Location:" . BASE_URL . 'listOrder/' . $id);
        die();
        // OrderModel::update();
    }
    // ORDER DETAIL ===============================================================================
    public function orderDetail($id)
    {
        $categories = CategoryModel::where('id', '>', 1)->get();
        $inforOrder = OrderModel::where('order_id', '=', $id)->get();
        $orderDetail = OrderModel::getOrderDetail($id);
        $this->renderClient('orderDetail', compact('categories', 'inforOrder', 'orderDetail'));
    }
    // CANCEL ORDER ===============================================================================
    public function cancelOrderDetail($id)
    {
        $data = $_POST;
        $data['status'] = "canceled";
        dd($data);
        OrderModel::update($id, $data);
        header("Location:" . BASE_URL . 'orderdetail/' . $id);
        die();
    }
    // END ORDER==============================================================================================================================================================
}