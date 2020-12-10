<?php
//-----------------------CLIENT------------------------------------ 
//Index
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('trangchu','App\Http\Controllers\HomeController@index');
Route::get('/tim-kiem','App\Http\Controllers\HomeController@search');
//Shop
Route::get('/register-shop','App\Http\Controllers\ShopController@register_shop');
Route::post('/save-shop','App\Http\Controllers\ShopController@save_shop');
Route::get('chi-tiet-shop&{shop_id}','App\Http\Controllers\ShopController@chitietshop');
Route::post('/load-comment','App\Http\Controllers\ShopController@load_comment');
Route::post('/insert-rating-shop','App\Http\Controllers\ShopController@insert_rating_shop');
//Category
Route::get('danh-muc={category_slug}','App\Http\Controllers\CategoryProductController@show_category');
//Customer
Route::get('login-customer','App\Http\Controllers\CheckoutController@LoginCustomer');
Route::post('login-cus','App\Http\Controllers\CheckoutController@Login_Customer');
Route::get('register-customer','App\Http\Controllers\CheckoutController@RegisterCustomer');
Route::post('sigin-customer','App\Http\Controllers\CheckoutController@SiginCustomer');
Route::get('logout-customer','App\Http\Controllers\CheckoutController@logout_customer');
Route::get('order-customer','App\Http\Controllers\CheckoutController@order_customer');
Route::get('order-details-customer&{order_code}','App\Http\Controllers\CheckoutController@order_details_customer');
Route::get('change-password-customer','App\Http\Controllers\CheckoutController@change_password_customer');
Route::post('change-password-cus','App\Http\Controllers\CheckoutController@change_password_cus');
Route::post('cancel-order','App\Http\Controllers\OrderController@cancel_order');
//Product
Route::get('allproduct','App\Http\Controllers\ProductController@allproduct');
Route::get('chi-tiet-san-pham&{product_slug}&{shop_id}&dm={category_id}','App\Http\Controllers\ProductController@chitietsanpham');
Route::post('/send-comment-product','App\Http\Controllers\ProductController@send_comment_product');
//Cart
Route::get('thanhtoan','App\Http\Controllers\CartController@payment');
Route::get('cart','App\Http\Controllers\CartController@cart');
Route::get('delete-product-cart/{session_id}','App\Http\Controllers\CartController@delete_product_cart');
Route::post('add-cart','App\Http\Controllers\CartController@add_cart');
Route::post('update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('confirm-order','App\Http\Controllers\CartController@confirm_order');
//Gallery
Route::get('add-gallery-product-shop&{product_id}','App\Http\Controllers\GalleryController@add_gallery_product_shop');
//Mail
Route::get('quen-mat-khau','App\Http\Controllers\MailController@quen_mat_khau');
Route::get('update-new-password-customer','App\Http\Controllers\MailController@update_new_password_customer');
Route::post('recover-password-customer','App\Http\Controllers\MailController@recover_password_customer');
Route::post('reset-new-password-customer','App\Http\Controllers\MailController@reset_new_password_customer');
//----------------------Admin-----------------------------------------
//Dashboard
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::get('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

//Order
Route::get('manager-order','App\Http\Controllers\OrderController@manager_order');
Route::get('print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');
Route::get('view-details-order&{order_code}','App\Http\Controllers\OrderController@view_details_order');
Route::get('delete-order-admin&{order_code}','App\Http\Controllers\OrderController@delete_order_admin');
Route::post('update-order-quantity','App\Http\Controllers\OrderController@update_order_quantity');
//Shop
Route::get('add-shop-admin','App\Http\Controllers\ShopController@add_shop_admin')->middleware('admin.roles');
Route::get('all-shop-admin','App\Http\Controllers\ShopController@all_shop_admin')->middleware('admin.roles');
Route::get('all-shop-wait-active','App\Http\Controllers\ShopController@all_shop_wait_active')->middleware('admin.roles');
Route::get('all-shop-block','App\Http\Controllers\ShopController@all_shop_block')->middleware('admin.roles');
Route::get('edit-shop-admin&{shop_id}','App\Http\Controllers\ShopController@edit_shop_admin')->middleware('admin.roles');
Route::get('delete-shop-admin/{shop_id}','App\Http\Controllers\ShopController@delete_shop_admin');
Route::post('save-shop-admin','App\Http\Controllers\ShopController@save_shop_admin');
Route::post('update-shop-admin/{shop_id}','App\Http\Controllers\ShopController@update_shop_admin');
Route::get('/unactive-shop/{shop_id}','App\Http\Controllers\ShopController@unactive_shop');
Route::get('/active-shop/{shop_id}','App\Http\Controllers\ShopController@active_shop');
Route::get('/char-details-shop&{shop_id}','App\Http\Controllers\ShopController@char_details_shop');
//Customer   
Route::get('add-customer-admin','App\Http\Controllers\CustomerController@add_customer')->middleware('admin.roles');
Route::get('all-customer-admin','App\Http\Controllers\CustomerController@all_customer')->middleware('admin.roles');
Route::get('edit-customer-admin&{customer_id}','App\Http\Controllers\CustomerController@edit_customer')->middleware('admin.roles');
Route::get('delete-customer-admin/{customer_id}','App\Http\Controllers\CustomerController@delete_customer');
Route::post('save-customer-admin','App\Http\Controllers\CustomerController@save_customer');
Route::post('update-customer-admin/{customer_id}','App\Http\Controllers\CustomerController@update_customer');
//Product
Route::get('/all-product-admin','App\Http\Controllers\ProductController@all_product_admin')->middleware('author.roles');
Route::get('/add-product-admin','App\Http\Controllers\ProductController@add_product_admin')->middleware('author.roles');
Route::get('/edit-product-admin&{product_id}','App\Http\Controllers\ProductController@edit_product_admin');
Route::get('/delete-product-admin/{product_id}','App\Http\Controllers\ProductController@delete_product_admin');
Route::get('/delete-product-shop/{product_id}','App\Http\Controllers\ProductController@delete_product_shop');
Route::post('save-product-admin','App\Http\Controllers\ProductController@save_product_admin');
Route::post('/update-product-admin/{product_id}','App\Http\Controllers\ProductController@update_product_admin');
Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');
//Gallery
Route::get('/add-gallery-product-admin&{product_id}','App\Http\Controllers\GalleryController@add_gallery_product_admin');
Route::post('/select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('/update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('/delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('/update-gallery','App\Http\Controllers\GalleryController@update_gallery');
//Category Product
Route::get('/add-category-product-admin','App\Http\Controllers\CategoryProductController@add_category_product')->middleware('author.roles');
Route::get('/all-category-product-admin','App\Http\Controllers\CategoryProductController@all_category_product')->middleware('author.roles');
Route::get('/edit-category-product-admin&{category_id}','App\Http\Controllers\CategoryProductController@edit_category_product');
Route::get('/delete-category-product-admin/{category_id}','App\Http\Controllers\CategoryProductController@delete_category_product');
Route::post('/save-category-product-admin','App\Http\Controllers\CategoryProductController@save_category_product');
Route::post('/update-category-product-admin/{category_id}','App\Http\Controllers\CategoryProductController@update_category_product');
//Users
Route::get('/add-user','App\Http\Controllers\AuthController@add_user')->middleware('admin.roles');
Route::post('/save-user','App\Http\Controllers\AuthController@save_user');
Route::get('/logout-admin','App\Http\Controllers\AuthController@logout_admin');
Route::get('/delete-user-roles/{admin_id}','App\Http\Controllers\AuthController@delete_user_roles');
Route::post('/login','App\Http\Controllers\AuthController@login');
Route::get('/logout-admin','App\Http\Controllers\AuthController@logout_admin');
Route::get('/change-password-admin','App\Http\Controllers\AuthController@change_password_admin');
Route::post('/change-password-admin-form','App\Http\Controllers\AuthController@change_password_admin_form');
//Roles
Route::get('/users','App\Http\Controllers\UserController@index')->middleware('admin.roles');
Route::post('/assign-roles','App\Http\Controllers\UserController@assign_roles');
//Middleware Roles
Route::group(['middleware' => 'admin.roles'],function(){
});
Route::group(['middleware' => 'author.roles'],function(){
});

//----------------------Sales-----------------------------------------
//Dashboard
Route::get('/sales','App\Http\Controllers\ShopController@index_sales');
Route::get('/sales-dashboard','App\Http\Controllers\ShopController@sales_dashboard');
Route::post('/filter-by-date','App\Http\Controllers\ShopController@filter_by_date');
Route::post('/dashboard-filter','App\Http\Controllers\ShopController@dashboard_filter');
Route::post('/statistical-30-days','App\Http\Controllers\ShopController@statistical_30_days');
//Product
Route::get('/add-product-shop','App\Http\Controllers\ShopController@add_product_shop');
Route::get('/all-product-shop','App\Http\Controllers\ShopController@all_product_shop');
Route::post('/post-product-shop','App\Http\Controllers\ShopController@post_product_shop');
Route::get('change-password-shop','App\Http\Controllers\ShopController@change_password_shop');
Route::post('change-password-sh','App\Http\Controllers\ShopController@change_password_sh');
Route::get('order-shop','App\Http\Controllers\ShopController@order_shop');
Route::post('/login-sh','App\Http\Controllers\ShopController@loginshop');
Route::get('/login-shop','App\Http\Controllers\ShopController@login_shop');
Route::get('/edit-product-shop&{product_id}','App\Http\Controllers\ProductController@edit_product_shop');
Route::post('/update-product-shop/{product_id}','App\Http\Controllers\ProductController@update_product_shop');
Route::get('/logout-shop','App\Http\Controllers\ShopController@logout_shop');
Route::get('/order-access-sales/{order_details_id}','App\Http\Controllers\OrderController@order_access_sales');
