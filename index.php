<?php
use Luan\Project1\Controllers\AdminController;

session_start();
ob_start();
use Luan\Project1\Controllers\ClientController;
use Phroute\Phroute\RouteCollector;


require_once 'env.php';
require_once 'helper.php';
require_once './vendor/autoload.php';


$router = new RouteCollector();

$url = $_GET['url'] ?? '/';

// if (!isset($_SESSION['user']) || $_SESSION['user'][0]->role == 'admin') {
   
// }
if (isset($_SESSION['user']) && ($_SESSION['user'][0]->role == 'admin' || $_SESSION['user'][0]->role == 'manager')) {
    $router->group(['prefix' => 'admin'], function ($router) {
        $router->get('/', [AdminController::class, 'index']);

        $router->get('category', [AdminController::class, 'getAllCategory']);
        $router->post('category', [AdminController::class, 'getAllCategory']);
        $router->get('category-delete/{id}', [AdminController::class, 'deleteCategory']);

        $router->get('products', [AdminController::class, 'listProducts']);
        $router->get('product-add', [AdminController::class, 'addProduct']);
        $router->post('product-add', [AdminController::class, 'storeProduct']);
        $router->get('product-edit-{id}', [AdminController::class, 'editProduct']);
        $router->post('product-edit-{id}', [AdminController::class, 'editProductDetail']);
        $router->get('product-delete/{id}', [AdminController::class, 'deleteProduts']);

        $router->get('accounts',[AdminController::class, 'listAccounts']);
        $router->get('accounts-add',[AdminController::class, 'addAccount']);
        $router->post('accounts-add',[AdminController::class, 'addAccount']);
        $router->get('accounts-delete-{id}',[AdminController::class, 'deleteAccounts']);

        $router->get('orders',[AdminController::class,'listOrders']);
        $router->get('orders-today',[AdminController::class,'listOrdersToday']);
        $router->get('orders-pending',[AdminController::class,'listOrdersPeding']);
        $router->get('orders-detail-{id}',[AdminController::class,'orderDetail']);
        $router->post('orders-detail-{id}',[AdminController::class,'UpdateOrder']);

        $router->get('list-bill-payment',[AdminController::class,'billMomo']);
        $router->get('bill-payment-detail-{id}',[AdminController::class,'billMomoDetail']);

        $router->get('list-voucher',[AdminController::class, 'voucher']);
        $router->get('add-voucher',[AdminController::class, 'addVoucher']);
        $router->post('add-voucher',[AdminController::class, 'addVoucherNew']);
        $router->get('edit-voucher-{id}',[AdminController::class, 'EditVoucher']);
        $router->post('edit-voucher-{id}',[AdminController::class, 'updateVoucher']);


    });
}
    $router->get('/', [ClientController::class, 'index']);
    $router->get('products', [ClientController::class, 'getProducts']);
    $router->post('products', [ClientController::class, 'getProducts']);
    $router->get('search', [ClientController::class, 'productSearch']);
    $router->get('detail/{id}', [ClientController::class, 'detail']);
    $router->post('detail/{id}', [ClientController::class, 'addCart']);
    $router->get('category/{id}', [ClientController::class, 'getProductCategory']);
    // $router->post('category/{id}', [ClientController::class, 'getProductCategory']);
    $router->get('login', [ClientController::class, 'login']);
    $router->post('login', [ClientController::class, 'loginCheck']);
    $router->get('register', [ClientController::class, 'register']);
    $router->post('register', [ClientController::class, 'registerCheck']);
    $router->get('logout', [ClientController::class, 'logout']);
    $router->get('infor/{id}', [ClientController::class, 'getInforUser']);
    $router->post('infor/{id}', [ClientController::class, 'updateInforUser']);
    $router->get('cart/{id}', [ClientController::class, 'getCart']);
    $router->post('cart/{id}', [ClientController::class, 'getCart']);
    $router->get('listOrder/{id}', [ClientController::class, 'getListOrder']);
    $router->post('listOrder/{id}', [ClientController::class, 'cancelOrder']);
    $router->get('cart/delete/{id}', [ClientController::class, 'deleteCartDetail']);
    $router->get('orderdetail/{id}', [ClientController::class, 'orderDetail']);
    $router->post('orderdetail/{id}', [ClientController::class, 'cancelOrderDetail']);
    $router->get('order/{id}', [ClientController::class, 'getOrder']);
    $router->post('order/{id}', [ClientController::class, 'order']);



try {
    # NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

    // Print out the value returned from the dispatched function
    echo $response;
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    echo "404 FILE NOT FOUND!";
}
