<?php
\Event::listen('illuminate.query',function($query){
    var_dump($query);
});

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

// Disable checkpoints (throttling, activation) for demo purposes
Route::pattern('account_id','[0-9]+');
Route::pattern('token','[0-9a-z]+');

Sentinel::enableCheckpoints();

# Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function()
{
    Route::get('/', ['uses' => 'Admin\AdminController@getHome']);
    //users
    Route::resource('users','Admin\UsersController');
    Route::group(['prefix' => 'users'], function () {
        Route::get('{id}/deactivate','Admin\UsersController@deactivate')->where('id','\d+');
        Route::get('{id}/activate','Admin\UsersController@activate')->where('id','\d+');
    });

    // roles
    Route::resource('roles','Admin\RolesController',array('except'=>array('show')));
    //categories
    Route::resource('categories','Admin\CategoriesController');
    //orders
    Route::resource('orders','Admin\OrdersController');
    //orderItem
    Route::resource('orderitem','Order\OrderItemController', array('except' => array('delete','destroy')));

    Route::group(['prefix' => 'settings'], function(){
        Route::resource('approval', 'Settings\ApprovalController',['except'=>'show']);
        Route::resource('vendor', 'Settings\VendorController',['except'=>'show']);
        Route::resource('payment', 'Settings\PaymentController',['except'=>'show']);
    });
});


/*******************************************************
 * //User account routes
 ******************************************************/

Route::group(['middleware' => ['auth','stdUser']], function() {


    Route::get('/', function(){
        return redirect('account/');
    });

    Route::get('/dashboard', function(){
     return Redirect::to('account/');
    });


    Route::group(['prefix' => 'account'],function(){

        Route::get('/', function () {
            $user = Sentinel::getUser();

            $persistence = Sentinel::getPersistenceRepository();

            return view('account.home', compact('user', 'persistence'));
        });


        Route::resource('profile', 'Accounts\AccountsController', ['only' => ['show', 'edit', 'update']]);

        Route::get('kill', function () {

            $user = Sentinel::getUser();

            Sentinel::getPersistenceRepository()->flush($user);

            return Redirect::back();
        });

        Route::get('kill-all', function () {
            $user = Sentinel::getUser();

            Sentinel::getPersistenceRepository()->flush($user, false);

            return Redirect::back();
        });

        Route::get('kill/{code}', function ($code) {
            Sentinel::getPersistenceRepository()->remove($code);

            return Redirect::back();
        });
    });
});

/*******************************************************
 * //User login and active routes
 ******************************************************/
Route::get('login', ['as' => 'login', 'middleware' => 'guest', 'uses' => 'Auth\AuthController@login']);
Route::post('login', 'Auth\AuthController@processLogin');
Route::get('logout', 'Auth\AuthController@logout');
Route::post('logout', 'Auth\AuthController@logout');
Route::get('activate/{id}/{code}', 'Auth\AuthController@getActivate')->where('id', '\d+');
Route::get('activate/{id}/{code}', 'Auth\AuthController@getReactivate')->where('id', '\d+');
Route::get('deactivate', 'Auth\AuthController@deactivate');
Route::get('wait', 'Auth\AuthController@wait');

Route::get('reset_password', 'Auth\PasswordController@index');
Route::post('reset_password', 'Auth\PasswordController@update');
Route::get('reset/{id}/{code}','Auth\PasswordController@getResetPasswordCode')->where('id', '\d+');
Route::post('reset/{id}/{code}','Auth\PasswordController@postResetPasswordCode')->where('id', '\d+');


//check user permission before order check order and book order
//
Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', function()
    {
        return view('home');
    });

    Route::get('/charts', function()
    {
        return view('mcharts');
    });

    Route::get('/tables', function()
    {
        return view('table');
    });

    Route::get('/forms', function()
    {
        return view('form');
    });

    Route::get('/grid', function()
    {
        return view('grid');
    });

    Route::get('/buttons', function()
    {
        return view('buttons');
    });


    Route::get('/icons', function()
    {
        return view('icons');
    });

    Route::get('/panels', function()
    {
        return view('panel');
    });

    Route::get('/typography', function()
    {
        return view('typography');
    });

    Route::get('/notifications', function()
    {
        return view('notifications');
    });

    Route::get('/blank', function()
    {
        return view('blank');
    });

    Route::get('/documentation', function()
    {
        return view('documentation');
    });
});