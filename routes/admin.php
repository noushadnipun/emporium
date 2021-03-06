<?php
//'middleware' => ['admin']
Route::group([
    'prefix'=> 'admin/', 
    'namespace'=> 'App\Http\Controllers\Admin', 
    'as' => 'admin_', 
    'middleware' => ['auth', 'admin']
], function(){
    
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('adminMenu','DashboardController@menu')->name('adminMenu');
    
    //Media
    Route::get('media/all', 'MediaController@index')->name('media_index');
    Route::post('media/store', 'MediaController@store')->name('media_store');
    Route::post('media/store/noajax', 'MediaController@storeMedia')->name('media_store_noajax');
    Route::get('media/get', 'MediaController@getMedia')->name('media_get');
    Route::get('media/delete/{id}', 'MediaController@destroy')->name('media_delete');

    //Products
    Route::get('product/all', 'ProductController@index')->name('product_index');
    Route::get('product/create', 'ProductController@form')->name('product_create');
    Route::post('product/store', 'ProductController@store')->name('product_store');
    Route::get('product/{id}', 'ProductController@form')->name('product_edit');
    Route::post('product/update', 'ProductController@update')->name('product_update');
    Route::get('product/{id}/delete', 'ProductController@destroy')->name('product_delete');
    Route::get('product-category/{id}/product', 'ProductController@index')->name('category_by_product');
    Route::get('product-brand/{brandId}/product', 'ProductController@index')->name('brand_by_product');

    //Product category
    Route::get('product-category/all', 'ProductCategoryController@index')->name('product_category_index');
    Route::post('product-category/store', 'ProductCategoryController@store')->name('product_category_store');
    Route::get('product-category/{id}', 'ProductCategoryController@index')->name('product_category_edit');
    Route::post('product-category/update', 'ProductCategoryController@update')->name('product_category_update');
    Route::get('product-category/{id}/delete', 'ProductCategoryController@destroy')->name('product_category_delete');
    Route::get('ajaxget/product-category/{id}', 'ProductCategoryController@ajaxCategory')->name('product_category_ajax_get');

    //Product Order
    Route::get('manage/order', 'ProductOrderController@index')->name('product_order_index');
    Route::get('order/create', 'ProductOrderController@create')->name('product_order_create');
    Route::get('order/store', 'ProductOrderController@store')->name('product_order_store');
    Route::get('order/view/{id}', 'ProductOrderController@view')->name('product_order_view');
    Route::get('order/delete/{id}', 'ProductOrderController@destroy')->name('product_order_delete');
    Route::get('manage/order/filter', 'ProductOrderController@index')->name('product_order_filter');

    //Status Chage
    Route::post('order/payment-status/', 'ProductOrderController@changePaymentStatus')->name('order_change_payment_status');
    Route::post('order/delivery-status/', 'ProductOrderController@changeDeliveryStatus')->name('order_change_delivery_status');

    //Brand
    Route::get('product-brand/all', 'ProductBrandController@index')->name('product_brand_index');
    Route::post('product-brand/store', 'ProductBrandController@store')->name('product_brand_store');
    Route::get('product-brand/{id}', 'ProductBrandController@index')->name('product_brand_edit');
    Route::post('product-brand/update', 'ProductBrandController@update')->name('product_brand_update');
    Route::get('product-brand/{id}/delete', 'ProductBrandController@destroy')->name('product_brand_delete');

    //Coupon
    Route::get('coupon/all', 'CouponController@index')->name('product_coupon_index');
    Route::post('coupon/store', 'CouponController@store')->name('product_coupon_store');
    Route::get('coupon/{id}', 'CouponController@index')->name('product_coupon_edit');
    Route::post('coupon/update', 'CouponController@update')->name('product_coupon_update');
    Route::get('coupon/{id}/delete', 'CouponController@destroy')->name('product_coupon_delete');

    //Attribute
    Route::get('attribute/all', 'AttributeController@index')->name('product_attribute_index');
    Route::post('attribute/store', 'AttributeController@store')->name('product_attribute_store');
    Route::get('attribute/{id}', 'AttributeController@index')->name('product_attribute_edit');
    Route::post('attribute/update', 'AttributeController@update')->name('product_attribute_update');
    Route::get('attribute/{id}/delete', 'AttributeController@destroy')->name('product_attribute_delete');

    //Attribute
    Route::get('attribute-value/all', 'AttributeController@valueindex')->name('product_attribute_value_index');
    Route::post('attribute-value/store', 'AttributeController@valuestore')->name('product_attribute_value_store');
    Route::get('attribute-value/{id}', 'AttributeController@valueindex')->name('product_attribute_value_edit');
    Route::post('attribute-value/update', 'AttributeController@valueupdate')->name('product_attribute_value_update');
    Route::get('attribute-value/{id}/delete', 'AttributeController@valuedestroy')->name('product_attribute_value_delete');

    /**
     * Product Purchase 
     * Inventory
     */
    Route::get('purchase/all', 'ProductPurchaseController@index')->name('purchase_product_index');
    Route::get('purchase/create', 'ProductPurchaseController@create')->name('purchase_product_create');
    Route::post('purchase/store', 'ProductPurchaseController@store')->name('purchase_product_store');
    Route::post('purchase/update', 'ProductPurchaseController@update')->name('purchase_product_update');

    /**
     * Dynamic Post Type && Term Taxonomy
     */
    //Post
    Route::get('term_type={type}/all', 'PostController@index')->name('term_type_index');
    Route::get('term_type={type}/create', 'PostController@form')->name('term_type_form'); 
    Route::post('term_type={type}/store', 'PostController@store')->name('term_type_store'); 
    Route::get('term_type={type}/edit/{id}', 'PostController@form')->name('term_type_edit'); 
    Route::post('term_type={type}/update', 'PostController@update')->name('term_type_update'); 
    Route::get('term_type={type}/delete/{id}', 'PostController@destroy')->name('term_type_delete');
    
    //Categories
    Route::get('term_type={type}/taxonomy={taxonomy}/all', 'CategoryController@index')->name('taxonomy_type_index');
    Route::post('term_type={type}/taxonomy={taxonomy}/store', 'CategoryController@store')->name('taxonomy_type_store'); 
    Route::get('term_type={type}/taxonomy={taxonomy}/edit/{id}', 'CategoryController@index')->name('taxonomy_type_edit'); 
    Route::post('term_type={type}/taxonomy={taxonomy}/update', 'CategoryController@update')->name('taxonomy_type_update'); 
    Route::get('term_type={type}/taxonomy={taxonomy}/delete/{id}', 'CategoryController@destroy')->name('taxonomy_type_delete');


    /* -------------------------------
    ----------- Settings -------------
    ----------------------------------*/

    // Frontend Settings
    Route::get('seetings/fronend/view', 'FrontendSettingsController@index')->name('frontend_settings_index');
    Route::post('seetings/fronend/update', 'FrontendSettingsController@update')->name('frontend_settings_update');
    //Store Settings
    Route::get('seetings/store/view', 'StoreSettingController@index')->name('product_store_settings_index');
    Route::post('seetings/store/update', 'StoreSettingController@update')->name('product_store_settings_update');






    /**-------------------------
     * -----User -------------- 
     ---------------------------*/

    //User
    Route::get('user', 'UserController@userIndex')->name('user_index');
    Route::post('user/store', 'UserController@userStore')->name('user_store');
    Route::get('user/edit/{id}', 'UserController@userIndex')->name('user_edit');
    Route::post('user/update', 'UserController@userUpdate')->name('user_update');
    Route::get('user/delete/{datefilter}', 'UserController@userDestroy')->name('user_delete');

    //Customer
    Route::get('customer', 'UserController@customerIndex')->name('customer_index');
    Route::post('customer/store', 'UserController@customerStore')->name('customer_store');
    Route::get('customer/edit/{id}', 'UserController@customerIndex')->name('customer_edit');
    Route::post('customer/update', 'UserController@customerUpdate')->name('customer_update');
    Route::get('customer/delete/{datefilter}', 'UserController@customerDestroy')->name('customer_delete');

});

?>