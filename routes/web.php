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

Route::get('/home', 'HomeController@index');

Route::get('/', 'HomeController@index');

Auth::routes();

    Route::resources([
        'rooms' => 'RoomController',
        'residents' => 'ResidentController',
        'owners' => 'OwnerController',
        'repairs' => 'RepairController',
        'violations' => 'ViolationController',
        'personnels' => 'PersonnelController',
        'transactions' => 'TransactionController',
        'payments' => 'PaymentController',
    ]);


