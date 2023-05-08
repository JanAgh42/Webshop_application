<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$pathPrefix = 'App\Http\Controllers\\';

Route::view('/register', 'register');
Route::view('/order-confirmation', 'cart-confirmation');
Route::view('/admin/login', 'admin-login');

Route::get('/admin/product/add', $pathPrefix . '' . 'AdminController@showAddProductPage')->middleware('adminauth');
Route::get('/admin/product/modify/{productId}', $pathPrefix . '' . 'AdminController@showEditProductPage')->middleware('adminauth');
Route::get('/admin/manage-products', $pathPrefix . '' . 'AdminController@showManageProductsPage')->middleware('adminauth');
Route::view('/admin/order/modify', 'admin.modify-order')->middleware('adminauth');
Route::get('/admin/order/detail/{orderId}', $pathPrefix . '' . 'AdminController@showOrderDetailPage')->middleware('adminauth');
Route::get('/admin/orders', $pathPrefix . '' . 'AdminController@showOrdersPage')->middleware('adminauth');
Route::view('/admin/add-parameters', 'admin.add-parameters')->middleware('adminauth');

Route::get('/', $pathPrefix . '' . 'ShopController@mainPageInfo');
Route::get('/catalog', $pathPrefix . '' . 'ShopController@filterProducts');
Route::get('/cart', $pathPrefix . '' . 'ShopController@getCartProducts');
Route::get('/profile', $pathPrefix . '' . 'ShopController@getProfileInfo')->middleware('auth');
Route::get('/product/{id}/{conf}', $pathPrefix . '' . 'ShopController@getChosenProduct')->name('get_product');
Route::get('/reviews/{product_id}', $pathPrefix . '' . 'ShopController@getReviewsForProduct');

Route::get('/order-detail', $pathPrefix . '' . 'ShopController@loadUserData');

Route::post('/login', $pathPrefix . '' . 'AuthenticationController@login');
Route::post('/register', $pathPrefix . '' . 'AuthenticationController@register');
Route::get('/logout', $pathPrefix . '' . 'AuthenticationController@logout')->middleware('auth');

Route::post('/review', $pathPrefix . '' . 'ShopController@postReview');
Route::post('/add-to-cart', $pathPrefix . '' . 'ShopController@addToCart');
Route::post('/edit-cart-item', $pathPrefix . '' . 'ShopController@editCartItem')->middleware('cart');
Route::post('/delete-cart-item', $pathPrefix . '' . 'ShopController@deleteCartItem')->middleware('cart');
Route::post('/payment-delivery', $pathPrefix . '' . 'ShopController@paymentDelivery')->middleware('cart');
Route::post('/set-address', $pathPrefix . '' . 'ShopController@setAddress')->middleware('cart');
Route::any('/payment', $pathPrefix . '' . 'ShopController@goToPayment')->middleware('cart');
Route::post('/edit-profile', $pathPrefix . '' . 'ShopController@editProfile')->middleware('auth');

Route::post('/admin/login', $pathPrefix . '' . 'AuthenticationController@loginAdmin');
Route::post('/admin/register', $pathPrefix . '' . 'AuthenticationController@registerAdmin');
Route::get('/admin/logout', $pathPrefix . '' . 'AuthenticationController@logoutAdmin')->middleware('adminauth');

Route::post('/admin/brand/add', $pathPrefix . '' . 'AdminController@addBrand')->middleware('adminauth');
Route::post('/admin/category/add', $pathPrefix . '' . 'AdminController@addCategory')->middleware('adminauth');
Route::post('/admin/color/add', $pathPrefix . '' . 'AdminController@addColor')->middleware('adminauth');

Route::get('/admin/product/delete/{productId}', $pathPrefix . '' . 'AdminController@deleteProduct')->middleware('adminauth');
Route::post('/admin/product/update', $pathPrefix . '' . 'AdminController@updateProduct')->middleware('adminauth');

Route::post('/admin/product/image/add', $pathPrefix . '' . 'AdminController@addProductImage')->middleware('adminauth');
Route::get('/admin/product/image/delete/{imageId}', $pathPrefix . '' . 'AdminController@deleteProductImage')->middleware('adminauth');
Route::post('/admin/product/configuration/add', $pathPrefix . '' . 'AdminController@addProductConfiguration')->middleware('adminauth');
Route::get('/admin/product/configuration/delete/{configurationId}', $pathPrefix . '' . 'AdminController@deleteProductConfiguration')->middleware('adminauth');
Route::post('/admin/product/add', $pathPrefix . '' . 'AdminController@addProduct')->middleware('adminauth');
Route::post('admin/clear-session', $pathPrefix . '' . 'AdminController@clearSession')->middleware('adminauth');