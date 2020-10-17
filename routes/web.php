<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('category/{id}', 'WelcomeController@category');

Route::get('selectstate/{countryid}', 'WelcomeController@selectstate');
Route::get('selectcity/{stateid}', 'WelcomeController@selectcity');
Route::get('selectsubcat/{catid}', 'WelcomeController@selectsubcat');
Auth::routes();
	Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('adminlogin');
    Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm')->name('hostlogin');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('adminregister');
    Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm')->name('hostregister');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
    
    Route::post('/register/writer', 'Auth\RegisterController@createWriter');
    Route::post('/login/writer', 'Auth\LoginController@writerLogin');

    Route::view('/home', 'home')->middleware('auth');
    Route::view('/admin', 'admin')->middleware('auth:admin');
    Route::view('/writer', 'writer')->middleware('auth:writer');

    //room profile
    Route::get('property/{id}', 'PropertyController@show');
    //owner profile
    Route::get('profile/{id}', 'ProfileController@show');
    Route::get('getstate/{countryid}', 'Writer\RoomController@selectstate');
    Route::get('getcity/{stateid}', 'Writer\RoomController@selectcity');
    Route::get('getsubcategory/{catid}', 'Writer\RoomController@selectsubcat');

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(
    [
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth:admin'
    ], function()
    {
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('category', 'CategoryController');
    Route::resource('subcategory', 'SubcategoryController');
    Route::resource('country', 'CountryController');
    Route::resource('state', 'StateController');
    Route::resource('city', 'CityController');
    Route::resource('property', 'PropertyController');
    Route::resource('amenities', 'AmenitiesController');
    Route::resource('user', 'UserController');
    Route::resource('owner', 'OwnerController');
    Route::resource('booking', 'BookingController');
    Route::get('notifications', 'NotificationController@index');
    Route::post('notifications', 'NotificationController@index');
    Route::post('setapproval', 'PropertyController@setapproval');
    Route::post('setbookapproval', 'BookingController@setapproval');
    });
Route::group(
        [
        'prefix' => 'writer',
        'namespace' => 'Writer',
        'middleware' => 'auth:writer'
        ], function()
        {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('user', 'DashboardController@user');
        Route::resource('room', 'RoomController');
        Route::post('search', 'RoomController@search');
        Route::resource('profile', 'ProfileController');
        Route::resource('booking', 'BookingController');
        });
Route::group(
        [
        'prefix' => 'user',        
        'middleware' => 'auth'
        ], function()
        {
        Route::get('bookroom/{id}', 'BookingController@bookroom');
        Route::post('booking', 'BookingController@step1');
        Route::resource('review', 'ReviewController');

        });          
