<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');
Route::get('test','Api\AuthController@test');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
        Route::get('auditlog', 'AuditLogsController@index');

        // Buyers
        Route::post('buyers/register',"BuyerController@Register")->name('buyers.register');
        Route::post('buyers/login',"BuyerController@login")->name('buyers.login');

        Route::post('products/buyers/allProducts/{id}' , "ProductController@buyerAllProduct")->name('products.allProducts');
        Route::post('products/buyers/productOrder' , "ProductController@productOrder")->name('products.productOrder');

});