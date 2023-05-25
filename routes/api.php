<?php

use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Dash\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as Auth;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\SubCategoriesController;
use App\Http\Controllers\Dash\BannersController as DashBannersController;
use App\Http\Controllers\Dash\CategoriesController as DashCategoriesController;
use App\Http\Controllers\Dash\CityController;
use App\Http\Controllers\Dash\CouponController;
use App\Http\Controllers\Dash\NotiController;
use App\Http\Controllers\Dash\OrdersController as DashOrdersController;
use App\Http\Controllers\Dash\ProductsController as DashProductsController;
use App\Http\Controllers\Dash\SettingsController as DashSettingsController;
use App\Http\Controllers\Dash\SubCategoriesController as DashSubCategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('isAdmin')->get('/authenticated', function () {
    return true;
});


//this is the start of application apis:
Route::post('register', [Auth::class, 'register']);
Route::post('login', [Auth::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add_address', [AddressesController::class, 'store']);
    Route::put('/edit_address/{id}', [AddressesController::class, 'update']);
    Route::post('/del_address/{id}', [AddressesController::class, 'destroy']);
    Route::get('/user_addresses', [AddressesController::class, 'user_addresses']);
    Route::get('/address/{id}', [AddressesController::class, 'show']);

    Route::post('edit_profile', [UserController::class, 'editData']);
    Route::post('change_password', [UserController::class, 'change_password']);
    Route::get('profile', [UserController::class, 'profile']);

    Route::post('addToCart/{id}', [CartController::class, 'addToCart']);
    Route::post('zamzamToCart/{id}', [CartController::class, 'zamzamToCart']);
    Route::post('masajedToCart/{id}', [CartController::class, 'masajedToCart']);
    Route::get('cartItems', [CartController::class, 'cartItems']);
    Route::post('addQuantity/{id}', [CartController::class, 'addQuantity']);
    Route::post('rmQuantity/{id}', [CartController::class, 'rmQuantity']);
    Route::post('removeItem/{id}', [CartController::class, 'removeItem']);

    Route::post('confirm_order', [OrdersController::class, 'confirm_order']);
    Route::get('order_details/{id}', [OrdersController::class, 'order_details']);
    Route::get('user_orders', [OrdersController::class, 'user_orders']);
});

Route::post('send_code', [UserController::class, 'send_code']);
Route::post('confirm_code/{id}', [UserController::class, 'confirm_code']);
Route::post('password_reset', [UserController::class, 'password_reset']);

Route::get('news', [NewsController::class, 'index']);
Route::get('banners', [BannersController::class, 'index']);
Route::get('categories', [CategoriesController::class, 'index'])->middleware('lang');
Route::get('subcategories', [SubCategoriesController::class, 'index'])->middleware('lang');
Route::get('subcategory/{id}', [SubCategoriesController::class, 'comCat'])->middleware('lang');

Route::get('products', [ProductsController::class, 'index'])->middleware('lang');
Route::get('catproducts/{id}', [ProductsController::class, 'CatProducts'])->middleware('lang');
Route::post('searchProducts', [ProductsController::class, 'searchProducts'])->middleware('lang');

Route::get('cities', [AddressesController::class, 'cities'])->middleware('lang');

Route::get('settings', [SettingsController::class, 'index'])->middleware('lang');

Route::post('delUser', [UserController::class, 'delUser'])->middleware('auth:sanctum');
//end of app apis

// this is the start of the dashboard apis :
Route::group(['prefix' => 'dash', 'middleware' => 'isAdmin'], function () {
    // Users
    Route::get('admins', [AuthController::class, 'admins']);
    Route::get('users', [AuthController::class, 'users']);
    Route::get('user/show/{id}', [AuthController::class, 'show']);
    Route::post('user/add', [AuthController::class, 'dashRegister']);
    Route::post('user/edit/{id}', [AuthController::class, 'update']);
    Route::post('user/del/{id}', [AuthController::class, 'delUser']);

    //noti
    Route::post('/push', [NotiController::class, 'push']);

    // cities
    Route::get('cities', [CityController::class, 'index']);
    Route::get('city/show/{id}', [CityController::class, 'show']);
    Route::post('city/add', [CityController::class, 'store']);
    Route::post('city/edit/{id}', [CityController::class, 'update']);
    Route::post('city/del/{id}', [CityController::class, 'destroy']);
    Route::get('fetchAramexCities', [CityController::class, 'fetchAramexCities']);

    // categories
    Route::get('cats', [DashCategoriesController::class, 'index']);
    Route::get('catswithoutpagination', [CategoriesController::class, 'index']);
    Route::get('cat/show/{id}', [DashCategoriesController::class, 'show']);
    Route::post('cat/add', [DashCategoriesController::class, 'store']);
    Route::post('cat/edit/{id}', [DashCategoriesController::class, 'update']);
    Route::post('cat/del/{id}', [DashCategoriesController::class, 'destroy']);

    // sub cats
    Route::get('subs', [DashSubCategoriesController::class, 'index']);
    Route::get('subswithoutpagination', [SubCategoriesController::class, 'index']);
    Route::get('sub/show/{id}', [DashSubCategoriesController::class, 'show']);
    Route::post('sub/add', [DashSubCategoriesController::class, 'store']);
    Route::post('sub/edit/{id}', [DashSubCategoriesController::class, 'update']);
    Route::post('sub/del/{id}', [DashSubCategoriesController::class, 'destroy']);

    // banners
    Route::get('banners', [DashBannersController::class, 'index']);
    Route::get('banner/show/{id}', [DashBannersController::class, 'show']);
    Route::post('banner/add', [DashBannersController::class, 'store']);
    Route::post('banner/edit/{id}', [DashBannersController::class, 'update']);
    Route::post('banner/del/{id}', [DashBannersController::class, 'destroy']);

    // products
    Route::get('products', [DashproductsController::class, 'index']);
    Route::get('product/show/{id}', [DashproductsController::class, 'show']);
    Route::post('product/add', [DashproductsController::class, 'store']);
    Route::post('product/edit/{id}', [DashproductsController::class, 'update']);
    Route::post('product/del/{id}', [DashproductsController::class, 'destroy']);
    Route::post('product/image/del/{id}', [DashproductsController::class, 'delImage']);

    //settings
    Route::get('settings', [DashSettingsController::class, 'index']);
    Route::post('setting/edit', [DashSettingsController::class, 'update']);

    //orders
    Route::get('orders/pending', [DashOrdersController::class, 'pending']);
    Route::get('orders/accepted', [DashOrdersController::class, 'accepted']);
    Route::get('orders/declined', [DashOrdersController::class, 'declined']);
    Route::get('order/{id}', [DashOrdersController::class, 'order']);
    Route::post('order/destroy/{id}', [DashOrdersController::class, 'destroy']);
    Route::post('changeStatus/{id}', [DashOrdersController::class, 'changeStatus']);

    //data
    Route::get('data', [DashSettingsController::class, 'data']);

    // cat products
    Route::get('subProducts/{id}', [DashProductsController::class, 'subProducts']);
    Route::get('catProducts/{id}', [DashProductsController::class, 'catProducts']);

    // Coupons
    Route::get('coupons', [CouponController::class, 'index']);
    Route::post('coupon/add', [CouponController::class, 'store']);
    Route::get('coupon/show/{id}', [CouponController::class, 'show']);
    Route::post('coupon/edit/{id}', [CouponController::class, 'update']);
    Route::post('coupon/del/{id}', [CouponController::class, 'destroy']);
});

Route::post('/dashLogin', [AuthController::class, 'dashLogin']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('discount', [CouponController::class, 'searchByCode']);

Route::get('fetchAramexCities', [CityController::class, 'fetchAramexCities']);
