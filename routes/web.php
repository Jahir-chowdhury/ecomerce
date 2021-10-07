<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('layouts.frontend.home');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/register', 'Backend\LoginController@register_index')->name('register');



Route::group(["namespace"=>"Backend"],function() {
    Route::group(['middleware' =>'guest'], function () {
        Route::get('/admin', 'LoginController@login_index')->name('login');
        Route::get('/register', 'LoginController@register_index')->name('register');
        Route::post('/register-store', 'LoginController@store')->name('user.store');

        Route::post('/login', 'LoginController@login')->name('user.login');
        Route::get('/verify/{token}', 'LoginController@user_verify')->name('verify');

         //login with google account
         Route::get('login/google', 'LoginController@redirect');
         Route::get('callback/google', 'LoginController@callback');


         //login with facebook account
         Route::get('/login/facebook', 'LoginController@redirectToProvider');
         Route::get('/login/facebook/callback', 'LoginController@handleProviderCallback');

    });

    Route::group(['middleware' => ['auth','user.role']], function () {
        Route::get('/logout', 'LoginController@logout')->name('logout');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('user-list', 'DashboardController@user_list')->name('user.list');
        Route::get('vendor-list', 'DashboardController@vendor_list')->name('vendor.list');
        Route::post('vendor-wise-product', 'DashboardController@vendor_wise_product')->name('vendor.by.product');
         Route::post('vendor-wise-single-vendor', 'DashboardController@vendor_wise_single')->name('vendor.by.single');
        Route::post('update-user', 'LoginController@update')->name('update.user');
        Route::post('delete-user', 'LoginController@destroy')->name('delete.user');
        Route::get('user-role', 'RoleController@create')->name('user.role');
        Route::post('user-role-store', 'RoleController@store')->name('store.role');
        Route::get('role-edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::post('role-update', 'RoleController@update')->name('update.role');
        Route::post('role-delete/{id}', 'RoleController@destroy')->name('role.delete');
        //banar
        Route::get('banar-list', 'BanarController@index')->name('banar.list');
        Route::get('banar', 'BanarController@index_banar')->name('banar');
        Route::post('banar-update', 'BanarController@update')->name('banar.update');
        Route::post('banar-upload', 'BanarController@upload')->name('banar.upload');
        Route::post('delete-banar', 'BanarController@delete')->name('banar.delete');
        //category
        Route::get('categories', 'CategoryController@index')->name('categories');
        Route::post('create-category', 'CategoryController@store')->name('category.add');
        Route::post('update-category', 'CategoryController@update')->name('category.update');
        Route::post('delete-category', 'CategoryController@destroy')->name('category.delete');
        Route::post('active-category', 'CategoryController@active')->name('category.active');
        Route::post('inactive-category', 'CategoryController@inactive')->name('category.inactive');
        //sub cat
        Route::get('sub-categories', 'ChildCategoryController@index')->name('child.category');
        Route::post('sub-category-create', 'ChildCategoryController@store')->name('child.add');
        Route::post('sub-category-update', 'ChildCategoryController@update')->name('update.child');
        Route::post('sub-category-delete/{id}', 'ChildCategoryController@destroy')->name('delete.child');
        //sub sub-cat
        Route::get('sub-sub-categories', 'SubChildCategoryController@index')->name('sub.child.category');
        Route::post('sub-sub-category-create', 'SubChildCategoryController@store')->name('sub.child.add');
        Route::post('sub-sub-category-update', 'SubChildCategoryController@update')->name('update.sub.child');
        Route::post('sub-sub-category-delete/{id}', 'SubChildCategoryController@destroy')->name('delete.sub.child');

        //product attribute route
        Route::get('product-attributes', 'AttributeController@index')->name('attributes');
        Route::post('product-attribute-update', 'AttributeController@update')->name('update.attribute');
        Route::post('product-attribute-create', 'AttributeController@store')->name('store.attribute');


         //Brand
        //  Route::get('products', 'ProductController@index')->name('products');
        Route::post('brand-create', 'BrandController@store')->name('brand.add');
        Route::get('brand-list', 'BrandController@index')->name('brand.brand_list');
         Route::post('get-cat-subCat', 'BrandController@getCatSubCat')->name('get.cat.subCat');
         Route::post('brand-update', 'BrandController@update')->name('brand.update');

        //product
        Route::get('products', 'ProductController@index')->name('products');
        Route::post('product-create', 'ProductController@store')->name('product.add');
        Route::get('product-edit/{slug}', 'ProductController@edit')->name('product.edit');
        Route::post('product-update/{slug}', 'ProductController@update')->name('product.update');
        Route::post('product-delete/{id}', 'ProductController@destroy')->name('product.delete');
        Route::post('product-flash-update', 'ProductController@flash_update')->name('product.flash.update');
        Route::post('product-status', 'ProductController@product_status')->name('product.status');
        Route::post('product-add-to-flash', 'ProductController@add_to_flash')->name('add.to.flash');

        //product avatars
        Route::get('products/avatars', 'ProductAvatarController@index')->name('avatars');
        Route::get('products/avatars/{slug}', 'ProductAvatarController@show')->name('product.avatars');
        Route::post('product-avatar-create', 'ProductAvatarController@store')->name('avatar.upload');
        Route::post('product-avatar-update', 'ProductAvatarController@update')->name('avatar.update');
        Route::post('product-avatar-delete/{id}', 'ProductAvatarController@destroy')->name('avatar.delete');

         //ads manager
        Route::get('ads', 'AdManagerController@index')->name('ads');
        Route::get('all-ads', 'AdManagerController@get_ads')->name('ads-all');
        Route::post('update-ads', 'AdManagerController@update')->name('ads.update');
        Route::post('ads-create', 'AdManagerController@store')->name('ads.upload');
        // Route::post('product-avatar-update', 'ProductAvatarController@update')->name('avatar.update');
        Route::post('ads-delete/{id}', 'AdManagerController@destroy')->name('ads.delete');

        //vendor
        Route::get('vendors', 'VendorController@vendor_index')->name('vendors');
        Route::post('vendor-update', 'VendorController@update')->name('vendor.update');
        Route::post('vendor-delete/{slug}', 'VendorController@destroy')->name('req.vendor.delete');
        Route::post('approve-vendor', 'VendorController@approve')->name('approve.vendor');
        Route::post('disable-vendor', 'VendorController@disable')->name('disable.vendor');
        Route::get('verdor-product-list', 'VendorProductController@index')->name('vendor.products');
        Route::post('vendor-create', 'VendorController@store')->name('vendor.add');

        //vendor product attribute...
        Route::get('product/attribute-list', 'ProductAttributeController@index')->name('product.attribute');
        Route::post('product/attribute-store', 'ProductAttributeController@store')->name('store.product.attribute');
        Route::post('product/attribute-update', 'ProductAttributeController@update')->name('update.product.attribute');

        

        Route::post('vendor-brand-create', 'SingleVendorController@store')->name('vendor.brand.add');
        Route::get('vendor-brand-list', 'SingleVendorController@index')->name('single.vendors');
        Route::post('vendor-brand-update', 'SingleVendorController@update')->name('single.vendor.update');

        Route::post('vendor-product-store', 'VendorProductController@store')->name('vendor.product.store');
        Route::get('vendor-product-edit/{slug}', 'VendorProductController@edit')->name('vendor.product.edit');
        Route::post('vendor-product-update/{slug}', 'VendorProductController@update')->name('vendor.product.update');
        //vendor product avatar
        Route::post('vendor-product-avatar', 'VendorProductAvatarController@store')->name('vendor.product.avatar');
        Route::get('vendor-product-avatars', 'VendorProductAvatarController@index')->name('avatar.index');
        Route::get('vendor-product-avatars/{slug}', 'VendorProductAvatarController@showAvatar')->name('vendor.product.avatars');
        Route::post('vendor-product-avatar/update', 'VendorProductAvatarController@update')->name('vendor.product.avatar.update');
        Route::get('vendor-product-avatar/delete/{slug}', 'VendorProductAvatarController@destroy')->name('vendor.product.avatar.delete');

        //sales owner
        Route::get('product-sales-history', 'OrdersController@sales_history')->name('sales.history');
        Route::post('order-by-product', 'OrdersController@order_by_product')->name('orderBy.product');

        //product delivery
        Route::post('product-delivered', 'OrdersController@delivery')->name('product.delivery');

        //sales vendor
        Route::get('vendor-sales-history', 'OrdersController@vendor_sales_history')->name('vendor.sales.history');
        Route::get('vendor-sales-refund', 'OrdersController@vendor_sales_refund')->name('vendor.sales.refund');
        Route::post('order-by-vendor-product', 'OrdersController@order_by_vendor_product')->name('orderBy.vendor.product');
        Route::post('vendor-order-refunded', 'OrdersController@vendor_refunded')->name('vendor.order.refunded');
        //orders
        //sales vendor
        Route::post('order/{id}', 'OrdersController@delete_single_order')->name('single.order.delete');
        Route::get('order-refunds', 'OrdersController@refundView')->name('refund.view');
        Route::post('order-refunded', 'OrdersController@refunded')->name('order.refunded');

        //invoice
        Route::post('order-invoice', 'OrdersController@invoice')->name('order.invoice');

        //table data search daily,weekly,monthly,yearly
        Route::post('product-sales-history', 'ProductController@table_search')->name('table.search');
        Route::post('vendor-sales-history', 'VendorProductController@vendor_table_search')->name('vendor.table.search');


        //Subscription
        Route::get('subscribers', 'SubscriberController@index')->name('subscribers');
        Route::get('update-subscriber-status/{id}/{status}', 'SubscriberController@updateSubscriberStatus');
        Route::get('delete-subscriber/{id}', 'SubscriberController@deleteSubscriber');
        Route::get('export-subscriber-list','SubscriberController@exportSubscriber');


        //Settings
        Route::post('save-settings', 'SettingsController@store')->name('settings.save');
        Route::get('setup-settings', 'SettingsController@index')->name('setup-settings');

        Route::get('/setup/about', 'AboutUsController@index')->name('about.view');
        Route::post('/store/about', 'AboutUsController@store')->name('about.store');

        Route::get('/get-contacts', 'ContactController@index')->name('contact.list');
        Route::get('/delete-contact/{id}', 'ContactController@destroy');
        Route::get('export-contact-list','ContactController@exportContact');


        //pdf
        Route::post('pdf-sales-history', 'OrdersController@sales_history_pdf')->name('sales.pdf');
        Route::get('pdf-vendor-sales-history', 'OrdersController@vendor_sales_history_pdf')->name('vendor.sales.pdf');
        
        //vendor order payment from admin...
        Route::post('order-payment','OrdersController@order_payment')->name('order.payment');

    });

});



Route::group(["namespace"=>"Frontend"],function() {
    Route::get('/', 'HomeController@index')->name('home');
    // Route::any('approve-purchase', 'HomeController@purchaseByEmoney')->name('purchase.emoney');

    //wishlist
    Route::get('wishlist', 'WishListController@index')->name('wishlist');
    Route::post('wishlist/store', 'WishListController@store')->name('wishlist.store');
    Route::post('{params?}/wishlist/store', 'WishListController@store');
    Route::post('/wishlist/delete/{id}', 'WishListController@destroy')->name('wishlist.delete');

    //cart
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart/store', 'CartController@store')->name('cart.store');
    Route::post('{params?}/cart/store', 'CartController@store');
    Route::get('/cart/billing-address', 'CartController@billing_index')->name('cart.bill');
    Route::post('/cart/update', 'CartController@update')->name('cart.update');
    Route::post('/cart/item', 'CartController@destroy')->name('cart.item.delete');
    Route::get('get-shipp-des', 'CartController@get_shipp_des')->name('get.shipp.des');
    Route::post('product-shipp-update', 'CartController@update_by_shipping')->name('product.shipp.des');

    //user
    Route::get('/user/logout', 'UserController@logout')->name('user.logout');
    Route::get('profile', 'UserController@index')->name('user');

    Route::get('/product/{brand}', 'HomeController@show_vendor')->name('vendor.list.product');
    Route::get('/vendor/product/{name}', 'HomeController@show_vendor_products')->name('vendor.all.products');

    Route::get('{cat}', 'HomeController@category')->name('category');
    //quick view
    Route::get('/product-view/{slug}', 'HomeController@product_quick_view')->name('product.quick');
    Route::get('view/{slug}', 'HomeController@quick_view')->name('quick');
    Route::post('product/price-by-size', 'HomeController@priceBysize')->name('price.by.size');
    Route::post('product/price-by-product-size', 'HomeController@priceByProductsize')->name('price.by.product.size');

    //order refund
    Route::post('order-refund', 'UserController@refund')->name('product.refund');
    Route::post('view-by-order', 'UserController@previewByOrder')->name('view.product.order');

    //search product
    Route::post('search-product', 'HomeController@search')->name('search');
    Route::post('load', 'HomeController@load')->name('load');
    Route::post('product-search', 'HomeController@productSearch')->name('search.product');
    Route::post('/category/load-category', 'HomeController@load_category');


    //check subscriber
    Route::post('check-subscriber-email', 'NewsletterController@checkSubscriber');
    //add subscriber
    Route::post('add-subscriber', 'NewsletterController@addSubscriber');

    //Contact us
    Route::get('/contact/us', 'ContactController@index')->name('user.contact');
    Route::post('/contact/store', 'ContactController@storeContact')->name('contact.store');

    //about us
    Route::get('/about/us', 'AboutUsController@index')->name('about.us');


});



// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END




