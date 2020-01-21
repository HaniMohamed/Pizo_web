<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(["middleware" => ['cors']],function(){

    Route::get('/home',    function(){
        return view("home.index");
    });


    Route::get('/',    function(){
        return view("admin.index");
    });

    Route::group(['prefix'=>'api/v1/admin'],function (){

        Route::get('users','Admin\UsersController@all');
        Route::get('users/{cid}','Admin\UsersController@getbygroup');
        Route::get('users/{id}/delete','Admin\UsersController@delete');
        Route::get('users/{id}/activate','Admin\UsersController@activate');
        Route::get('users/{id}/deactivate','Admin\UsersController@deactivate');





    });

    Route::group(['prefix'=>'api/v1/users'],function (){
        // API
        Route::post('signup',   'Users\apiUsersController@signup');
        Route::post('signin',   'Users\apiUsersController@signin');
        Route::post('update',   'Users\apiUsersController@update');
        Route::post('password', 'Users\apiUsersController@passwordUpdate');
        Route::get('profile',   'Users\apiUsersController@profile');
        Route::get('logout',    'Users\apiUsersController@logout');

    });

    /**
     * Messages
     */

    Route::group(['prefix'=>'api/v1/messages'],function (){

        Route::get('/',                 'Messages\MessagesController@user');
        Route::get('/{cid}',            'Messages\MessagesController@info');
        Route::get('/{cid}/messages',   'Messages\MessagesController@messages');

        Route::post('/create',          'Messages\MessagesController@create');
        Route::post('/{cid}/send',      'Messages\MessagesController@send');

    });


    Route::group(['prefix'=>'api/v1'],function (){

        Route::post('events/','Events\EventsController@store');
        Route::post('events/{id}/image','Events\EventsController@image');

        Route::get('events/','Events\EventsController@index');
        Route::get('events/{id}','Events\EventsController@show');
        Route::get('events/{id}/delete','Events\EventsController@destroy');

    });

    Route::group(['prefix'=>'api/v1'],function (){
        Route::get('posts','News\NewsController@get');
        Route::get('posts/{id}','News\NewsController@post');
        Route::get('posts/{id}/delete','News\NewsController@delete');

        Route::post('posts','News\NewsController@add');
        Route::post('posts/{id}/image','News\NewsController@image');
    });

    Route::group(['prefix'=>'api/v1/orders'],function (){

        Route::get('/engineers',   'Orders\ordersController@getEngineers');
        Route::post('/',   'Orders\ordersController@addOrder');
        Route::post('/{id}/image','Orders\ordersController@uploadOrderImage');
        Route::get('/{id}','Orders\ordersController@getOrderInfo' );
        Route::get('/{id}/delete',   'Orders\ordersController@deleteOrder');

    });

    Route::group(['prefix'=>'api/v1/store'],function (){

        Route::post('/product',             'Products\productsController@add');
        Route::post('/product/{id}/image',  'Products\productsController@image');

        Route::post('/product/{id}',       'Products\productsController@update');
        Route::get('/product/{id}/delete',      'Products\productsController@delete');

        Route::get('/product/{id}',         'Products\productsController@get');
        Route::get('/product',              'Products\productsController@all');

        /**
         *  clinics parts
         */

        Route::post('/clinics',             'Clinics\productsController@add');
        Route::post('/clinics/{id}/image',  'Clinics\productsController@image');

        Route::post('/clinics/{id}',       'Clinics\productsController@update');

        Route::get('/clinics/{id}/delete',      'Clinics\productsController@delete');

        Route::get('/clinics/{id}',         'Clinics\productsController@get');
        Route::get('/clinics',              'Clinics\productsController@all');

    });

    Route::group(['prefix'=>'api/v1'],function () {
        Route::get('jobs/',         'Jobs\jobsController@all');
        Route::get('jobs/{id}',     'Jobs\jobsController@get');
        Route::post('jobs/',        'Jobs\jobsController@add');
        Route::get('jobs/{id}/delete',  'Jobs\jobsController@delete');
    });



//TEST
    Route::any('test',      'testController@any');


});
