<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/product',[
	'uses'		=>'Admin\ProductController@index',
	'as'		=>'product'
]);

Route::get('/category',[
	'uses'		=>'Admin\CategoryController@index',
	'as'		=>'category'
]);

Route::get('/brand',[
	'uses'		=>'Admin\BrandController@index',
	'as'		=>'brand'
]);

*/

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);



Route::get('/admin-log-out',[
    'uses'      =>'HomeController@LogOut',
    'as'        =>'admin-log-out'
]);

//********Order Part************

Route::get('/get-orders',[
    'uses'      =>'OrderController@index',
    'as'        =>'get-orders'
]);
Route::get('/get-completed-order',[
    'uses'      =>'OrderController@completed',
    'as'        =>'get-completed-order'
]);
Route::get('/get-uncompleted-order',[
    'uses'      =>'OrderController@uncompleted',
    'as'        =>'get-uncompleted-order'
]);
Route::get('/delete-order',[
    'uses'      =>'OrderController@destroy',
    'as'        =>'delete-order'
]);
Route::get('/customer-info/{id}',[
    'uses'      =>'OrderController@customerInfo',
    'as'        =>'customer-info'
]);
Route::get('/order-info/{id}',[
    'uses'      =>'OrderController@orderInfo',
    'as'        =>'order-info'
]);
Route::get('/get-invoice/{id}',[
    'uses'      =>'OrderController@orderInvoice',
    'as'        =>'get-invoice'
]);
Route::get('/download-order/{id}',[
    'uses'      =>'OrderController@downloadOrderInvoice',
    'as'        =>'download-order'
]);
Route::get('/complete-order/{id}',[
    'uses'      =>'OrderController@completeOrder',
    'as'        =>'complete-order'
]);


//********Category Part**************

Route::post('/save-category',[
	'uses'		=>'Admin\CategoryController@store',
	'as'		=>'save-category'
]);
Route::post('/update-category',[
	'uses'		=>'Admin\CategoryController@update',
	'as'		=>'update-category'
]);
Route::get('/get-category',[
	'uses'		=>'Admin\CategoryController@index',
	'as'		=>'get-category'
]);
Route::get('/get-active-category',[
	'uses'		=>'Admin\CategoryController@getActiveCategory',
	'as'		=>'get-active-category'
]);
Route::get('/delete-category/{id}',[
	'uses'		=>'Admin\CategoryController@destroy',
	'as'		=>'delete-category'
]);
Route::get('/publish-category/{id}',[
	'uses'		=>'Admin\CategoryController@Publish',
	'as'		=>'publish-category'
]);
Route::get('/unpublish-category/{id}',[
	'uses'		=>'Admin\CategoryController@Unpublish',
	'as'		=>'unpublish-category'
]);
Route::get('/show-category/{slug}',[
	'uses'		=>'Admin\CategoryController@show',
	'as'		=>'show-category'
]);


//********Subcategory Part**************

Route::post('/save-subcategory',[
	'uses'		=>'Admin\SubCategoryController@store',
	'as'		=>'save-subcategory'
]);
Route::post('/update-subcategory',[
	'uses'		=>'Admin\SubCategoryController@update',
	'as'		=>'update-subcategory'
]);
Route::get('/get-getSubcategory',[
	'uses'		=>'Admin\SubCategoryController@index',
	'as'		=>'get-getSubcategory'
]);
Route::get('/delete-subcategory/{id}',[
	'uses'		=>'Admin\SubCategoryController@destroy',
	'as'		=>'delete-subcategory'
]);
Route::get('/publish-subcategory/{id}',[
	'uses'		=>'Admin\SubCategoryController@Publish',
	'as'		=>'publish-subcategory'
]);
Route::get('/unpublish-subcategory/{id}',[
	'uses'		=>'Admin\SubCategoryController@Unpublish',
	'as'		=>'unpublish-subcategory'
]);
Route::get('/show-subcategory/{slug}',[
	'uses'		=>'Admin\SubCategoryController@show',
	'as'		=>'show-subcategory'
]);


//********Super Subcategory Part**************

Route::post('/save-supersubcategory',[
	'uses'		=>'Admin\SuperSubcategoryController@store',
	'as'		=>'save-supersubcategory'
]);
Route::post('/update-supersubcategory',[
	'uses'		=>'Admin\SuperSubcategoryController@update',
	'as'		=>'update-supersubcategory'
]);
Route::get('/get-supersubcategory',[
	'uses'		=>'Admin\SuperSubcategoryController@index',
	'as'		=>'get-supersubcategory'
]);
Route::get('/delete-supersubcategory/{id}',[
	'uses'		=>'Admin\SuperSubcategoryController@destroy',
	'as'		=>'delete-supersubcategory'
]);
Route::get('/publish-supersubcategory/{id}',[
	'uses'		=>'Admin\SuperSubcategoryController@Publish',
	'as'		=>'publish-supersubcategory'
]);
Route::get('/unpublish-supersubcategory/{id}',[
	'uses'		=>'Admin\SuperSubcategoryController@Unpublish',
	'as'		=>'unpublish-supersubcategory'
]);
Route::get('/show-supersubcategory/{slug}',[
	'uses'		=>'Admin\SuperSubcategoryController@show',
	'as'		=>'show-supersubcategory'
]);


//************Product Part*************

Route::post('/save-product',[
	'uses'		=>'Admin\ProductController@store',
	'as'		=>'save-product'
]);
Route::post('/update-product-info',[
	'uses'		=>'Admin\ProductController@updateProductInfo',
	'as'		=>'update-product-info'
]);
Route::post('/update-product-image',[
	'uses'		=>'Admin\ProductController@updateProductImage',
	'as'		=>'update-product-image'
]);
Route::get('/get-product',[
	'uses'		=>'Admin\ProductController@index',
	'as'		=>'get-product'
]);
Route::get('/get-product-name/{slug}',[
	'uses'		=>'Admin\ProductController@productName',
	'as'		=>'get-product-name'
]);
Route::get('/get-my-product',[
	'uses'		=>'Admin\ProductController@myIndex',
	'as'		=>'get-my-product'
]);
Route::get('/delete-product/{id}',[
	'uses'		=>'Admin\ProductController@destroy',
	'as'		=>'delete-product'
]);
Route::get('/show-product/{slug}',[
	'uses'		=>'Admin\ProductController@show',
	'as'		=>'show-product'
]);
Route::get('/publish-product/{id}',[
	'uses'		=>'Admin\ProductController@Publish',
	'as'		=>'publish-product'
]);
Route::get('/unpublish-product/{id}',[
	'uses'		=>'Admin\ProductController@Unpublish',
	'as'		=>'unpublish-product'
]);
Route::get('/boost-product/{id}',[
	'uses'		=>'Admin\ProductController@boost',
	'as'		=>'boost-product'
]);
Route::get('/unboost-product/{id}',[
	'uses'		=>'Admin\ProductController@unboost',
	'as'		=>'unboost-product'
]);
Route::post('/get-search-product',[
	'uses'		=>'Admin\ProductController@getResultVal',
	'as'		=>'get-search-product'
]);
Route::post('/get-search-my-product',[
	'uses'		=>'Admin\ProductController@MyResultVal',
	'as'		=>'get-search-my-product'
]);
Route::post('/get-search-vendor-product',[
	'uses'		=>'Admin\ProductController@VendorResultVal',
	'as'		=>'get-search-vendor-product'
]);
Route::post('/get-search-front-product',[
	'uses'		=>'Admin\ProductController@frontResultVal',
	'as'		=>'get-search-front-product'
]);
Route::post('/get-prod-name/{name}',[
	'uses'		=>'Admin\ProductController@prodName',
	'as'		=>'get-prod-name'
]);

//********About Part**************

Route::post('/save-about',[
	'uses'		=>'Admin\AboutController@store',
	'as'		=>'save-about'
]);
Route::post('/update-about',[
	'uses'		=>'Admin\AboutController@update',
	'as'		=>'update-about'
]);
Route::get('/get-about',[
	'uses'		=>'Admin\AboutController@index',
	'as'		=>'get-about'
]);
Route::get('/delete-about/{id}',[
	'uses'		=>'Admin\AboutController@destroy',
	'as'		=>'delete-about'
]);
Route::get('/publish-about/{id}',[
	'uses'		=>'Admin\AboutController@Publish',
	'as'		=>'publish-about'
]);
Route::get('/unpublish-about/{id}',[
	'uses'		=>'Admin\AboutController@Unpublish',
	'as'		=>'unpublish-about'
]);
Route::get('/show-about/{slug}',[
	'uses'		=>'Admin\AboutController@show',
	'as'		=>'show-about'
]);

//********Contact Part**************

Route::post('/save-contact',[
	'uses'		=>'Admin\ContactController@store',
	'as'		=>'save-contact'
]);
Route::post('/update-contact',[
	'uses'		=>'Admin\ContactController@update',
	'as'		=>'update-contact'
]);
Route::get('/get-contact',[
	'uses'		=>'Admin\ContactController@index',
	'as'		=>'get-contact'
]);
Route::get('/delete-contact/{id}',[
	'uses'		=>'Admin\ContactController@destroy',
	'as'		=>'delete-contact'
]);
Route::get('/publish-contact/{id}',[
	'uses'		=>'Admin\ContactController@Publish',
	'as'		=>'publish-contact'
]);
Route::get('/unpublish-contact/{id}',[
	'uses'		=>'Admin\ContactController@Unpublish',
	'as'		=>'unpublish-contact'
]);
Route::get('/show-contact/{slug}',[
	'uses'		=>'Admin\ContactController@show',
	'as'		=>'show-contact'
]);

//********Team Part**************

Route::post('/save-team',[
	'uses'		=>'Admin\TeamController@store',
	'as'		=>'save-team'
]);
Route::post('/update-team',[
	'uses'		=>'Admin\TeamController@update',
	'as'		=>'update-team'
]);
Route::get('/get-team',[
	'uses'		=>'Admin\TeamController@index',
	'as'		=>'get-team'
]);
Route::get('/delete-team/{id}',[
	'uses'		=>'Admin\TeamController@destroy',
	'as'		=>'delete-team'
]);
Route::get('/publish-team/{id}',[
	'uses'		=>'Admin\TeamController@Publish',
	'as'		=>'publish-team'
]);
Route::get('/unpublish-team/{id}',[
	'uses'		=>'Admin\TeamController@Unpublish',
	'as'		=>'unpublish-team'
]);
Route::get('/show-team/{slug}',[
	'uses'		=>'Admin\TeamController@show',
	'as'		=>'show-team'
]);

//********Model Part**************

Route::post('/save-model',[
	'uses'		=>'Admin\ModelController@store',
	'as'		=>'save-model'
]);
Route::get('/delete-model/{id}',[
	'uses'		=>'Admin\ModelController@destroy',
	'as'		=>'delete-model'
]);
Route::get('/get-model',[
	'uses'		=>'Admin\ModelController@index',
	'as'		=>'get-model'
]);
Route::get('/publish-model/{id}',[
	'uses'		=>'Admin\ModelController@Publish',
	'as'		=>'publish-model'
]);
Route::get('/unpublish-model/{id}',[
	'uses'		=>'Admin\ModelController@Unpublish',
	'as'		=>'unpublish-model'
]);
Route::get('/publish-banner/{id}',[
	'uses'		=>'Admin\ModelController@PublishBanner',
	'as'		=>'publish-banner'
]);
Route::get('/unpublish-banner/{id}',[
	'uses'		=>'Admin\ModelController@UnpublishBanner',
	'as'		=>'unpublish-banner'
]);

//********Vendor Part**************

Route::post('/save-vendor',[
	'uses'		=>'Admin\VendorController@store',
	'as'		=>'save-vendor'
]);
Route::get('/delete-vendor/{id}',[
	'uses'		=>'Admin\VendorController@destroy',
	'as'		=>'delete-vendor'
]);
Route::get('/delete-company/{id}',[
	'uses'		=>'Admin\VendorController@destroyCompany',
	'as'		=>'delete-company'
]);
Route::get('/get-customer',[
	'uses'		=>'Admin\VendorController@Customer',
	'as'		=>'get-customer'
]);
Route::get('/seller-info/{id}',[
	'uses'		=>'Admin\VendorController@Seller',
	'as'		=>'seller-info'
]);
Route::get('/get-company',[
	'uses'		=>'Admin\VendorController@company',
	'as'		=>'get-company'
]);
Route::get('/publish-vendor/{id}',[
	'uses'		=>'Admin\VendorController@Publish',
	'as'		=>'publish-vendor'
]);
Route::get('/unpublish-vendor/{id}',[
	'uses'		=>'Admin\VendorController@Unpublish',
	'as'		=>'unpublish-vendor'
]);
Route::get('/publish-company/{id}',[
	'uses'		=>'Admin\VendorController@Publishcompany',
	'as'		=>'publish-company'
]);
Route::get('/unpublish-company/{id}',[
	'uses'		=>'Admin\VendorController@Unpublishcompany',
	'as'		=>'unpublish-company'
]);
Route::post('/get-search-customer',[
	'uses'		=>'Admin\VendorController@getResultVal',
	'as'		=>'get-search-customer'
]);
Route::post('/get-search-company',[
	'uses'		=>'Admin\VendorController@getCompanyVal',
	'as'		=>'get-search-company'
]);
Route::post('/get-company-name/{name}',[
	'uses'		=>'Admin\VendorController@getCompanyName',
	'as'		=>'get-company-name'
]);
Route::post('/save-company',[
	'uses'		=>'Admin\VendorController@SaveCompanyInfo',
	'as'		=>'save-company'
]);

//********Logo Part**************

Route::post('/save-logo',[
	'uses'		=>'Admin\LogoController@store',
	'as'		=>'save-logo'
]);
Route::get('/show-logo/{id}',[
	'uses'		=>'Admin\LogoController@show',
	'as'		=>'save-logo'
]);
Route::get('/delete-logo/{id}',[
	'uses'		=>'Admin\LogoController@destroy',
	'as'		=>'delete-logo'
]);
Route::get('/get-logo',[
	'uses'		=>'Admin\LogoController@index',
	'as'		=>'get-logo'
]);
Route::get('/publish-logo/{id}',[
	'uses'		=>'Admin\LogoController@Publish',
	'as'		=>'publish-logo'
]);
Route::get('/unpublish-logo/{id}',[
	'uses'		=>'Admin\LogoController@Unpublish',
	'as'		=>'unpublish-logo'
]);
Route::post('/update-logo',[
	'uses'		=>'Admin\LogoController@update',
	'as'		=>'update-logo'
]);

//********Message Part**************

Route::get('/delete-message/{id}',[
	'uses'		=>'CustomerController@destroy',
	'as'		=>'delete-message'
]);
Route::get('/get-messages',[
	'uses'		=>'CustomerController@index',
	'as'		=>'get-messages'
]);
Route::post('/forgot-password',[
	'uses'		=>'CustomerController@ForgotPassword',
	'as'		=>'forgot-password'
]);
Route::post('/check-code',[
	'uses'		=>'CustomerController@Check',
	'as'		=>'check-code'
]);

Route::post('/reset-pass',[
	'uses'		=>'CustomerController@resetPass',
	'as'		=>'reset-pass'
]);



//*************Front End***************
Route::get('/', [App\Http\Controllers\SiteController::class, 'Site']);

Route::get('/get-front-about',[
	'uses'		=>'SiteController@about',
	'as'		=>'get-front-about'
]);
Route::get('/get-front-contact',[
	'uses'		=>'SiteController@contact',
	'as'		=>'get-front-contact'
]);
Route::get('/get-ceo',[
	'uses'		=>'SiteController@ceo',
	'as'		=>'get-ceo'
]);
Route::get('/get-front-team',[
	'uses'		=>'SiteController@teams',
	'as'		=>'get-front-team'
]);
Route::post('/register-customer',[
	'uses'		=>'SiteController@Register',
	'as'		=>'register-customer'
]);
Route::post('/get-cus-mail/{email}',[
	'uses'		=>'SiteController@cusMail',
	'as'		=>'get-cus-mail'
]);
Route::post('/login-customer',[
	'uses'		=>'SiteController@Login',
	'as'		=>'login-customer'
]);

Route::post('/customer-logout',[
    'uses'      =>'SiteController@customerLogout',
    'as'        =>'customer-logout'
]);
Route::get('/get-front-customer',[
	'uses'		=>'SiteController@frontCustomer',
	'as'		=>'get-front-customer'
]);
Route::get('/get-company-status',[
	'uses'		=>'SiteController@companyStatus',
	'as'		=>'get-company-status'
]);
Route::get('/show-customer/{slug}',[
	'uses'		=>'SiteController@show',
	'as'		=>'show-customer'
]);
Route::post('/update-bio',[
	'uses'		=>'SiteController@updateBio',
	'as'		=>'update-bio'
]);
Route::post('/customer-contact',[
	'uses'		=>'CustomerController@store',
	'as'		=>'customer-contact'
]);
Route::get('/get-front-model',[
	'uses'		=>'Admin\ModelController@frontModel',
	'as'		=>'get-front-model'
]);
Route::get('/get-middle-model',[
	'uses'		=>'Admin\ModelController@middleModel',
	'as'		=>'get-middle-model'
]);
Route::get('/get-active-sub-category',[
	'uses'		=>'Admin\SubCategoryController@ActiveSubCategory',
	'as'		=>'get-active-sub-category'
]);
Route::get('/get-active-front-super-sub-category/{subcategory}',[
	'uses'		=>'Admin\SuperSubcategoryController@ActiveFrontSuperSubCategory',
	'as'		=>'get-active-front-super-sub-category'
]);
Route::get('/get-sub-cat/{category}',[
	'uses'		=>'Admin\SubCategoryController@getSubCat',
	'as'		=>'get-sub-cat'
]);
Route::get('/sub-category-product/{id}',[
	'uses'		=>'Admin\SubCategoryController@getSubCatProduct',
	'as'		=>'sub-category-product'
]);
Route::get('/super-sub-category-product/{id}',[
	'uses'		=>'Admin\SuperSubcategoryController@getSuperSubCatProduct',
	'as'		=>'super-sub-category-product'
]);
Route::get('/get-super-sub-cat/{subCategory}',[
	'uses'		=>'Admin\SuperSubcategoryController@superSubcats',
	'as'		=>'get-super-sub-cat'
]);
Route::get('/front-boost-product',[
	'uses'		=>'Admin\ProductController@boosts',
	'as'		=>'front-boost-product'
]);
Route::get('/front-product',[
	'uses'		=>'Admin\ProductController@FrontProduct',
	'as'		=>'front-product'
]);
Route::get('/view-product/{slug}',[
	'uses'		=>'Admin\ProductController@ViewProduct',
	'as'		=>'view-product'
]);
Route::get('/view-boost-product/{slug}',[
	'uses'		=>'Admin\ProductController@ViewBoostProduct',
	'as'		=>'view-boost-product'
]);
Route::get('/category-product/{id}',[
	'uses'		=>'FrontProductController@categoryProduct',
	'as'		=>'category-product'
]);
Route::get('/related-category-product/{id}',[
	'uses'		=>'Admin\CategoryController@relatedProduct',
	'as'		=>'related-category-product'
]);
Route::get('/related-boost-category-product/{id}',[
	'uses'		=>'Admin\CategoryController@relatedBoostProduct',
	'as'		=>'related-category-product'
]);
Route::get('/customer-logged-in',[
	'uses'		=>'SiteController@CustomerLoggedIn',
	'as'		=>'customer-logged-in'
]);
Route::get('/get-user-name',[
	'uses'		=>'SiteController@userName',
	'as'		=>'get-user-name'
]);
Route::get('/get-front-product',[
	'uses'		=>'FrontProductController@vendorProduct',
	'as'		=>'get-front-product'
]);
Route::post('/add-to-cart',[
	'uses'		=>'CartCOntroller@store',
	'as'		=>'add-to-cart'
]);
Route::post('/update-quantity/{id}/{qty}/{product_id}',[
	'uses'		=>'CartCOntroller@update',
	'as'		=>'update-quantity'
]);
Route::get('/get-cart-item',[
	'uses'		=>'CartCOntroller@index',
	'as'		=>'get-cart-item'
]);
Route::get('/delete-cart-item/{id}',[
	'uses'		=>'CartCOntroller@destroy',
	'as'		=>'delete-cart-item'
]);
Route::get('/customername',[
	'uses'		=>'CartCOntroller@customername',
	'as'		=>'customername'
]);
Route::get('/shipping-info',[
	'uses'		=>'CartCOntroller@shippingInfo',
	'as'		=>'shipping-info'
]);
Route::post('/save-shipping-info',[
	'uses'		=>'CartCOntroller@saveShippingInfo',
	'as'		=>'save-shipping-info'
]);
Route::post('/total-to-session/{total}/{ship}',[
	'uses'		=>'CartCOntroller@total',
	'as'		=>'total-to-session'
]);
Route::get('/get-user-bool',[
	'uses'		=>'SiteController@CustomerLoggedIn',
	'as'		=>'get-user-bool'
]);
Route::post('/save-order',[
	'uses'		=>'OrderController@store',
	'as'		=>'save-order'
]);
Route::get('/ship-tot',[
	'uses'		=>'OrderController@ShippingAndTotal',
	'as'		=>'ship-tot'
]);
Route::get('/get-some',[
	'uses'		=>'SiteController@Cus',
	'as'		=>'get-some'
]);

Route::get('/get-comp',[
	'uses'		=>'SiteController@Comp',
	'as'		=>'get-comp'
]);
Route::get('/get-vendor-stat',[
	'uses'		=>'CustomerController@Vendor',
	'as'		=>'get-vendor-stat'
]);
Route::get('/get-very',[
	'uses'		=>'SiteController@very',
	'as'		=>'get-very'
]);
Route::get('/get-code',[
	'uses'		=>'SiteController@code',
	'as'		=>'get-code'
]);
Route::get('/get-email',[
	'uses'		=>'SiteController@email',
	'as'		=>'get-email'
]);

// Route::get('/{anypath}',[
// 	'uses'		=>'SiteController@Site',
// 	'as'		=>'{anypath}'
// ])->where('path','.*');
