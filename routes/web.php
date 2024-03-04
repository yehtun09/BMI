<?php

use App\Models\Permission;
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
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // User
    Route::delete('users/destroy', 'UserController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UserController');

    //Profile
    Route::get('user_info/index', function () { return view('admin.usersetting.index'); })->name('user_info.index');
    Route::put('user_info/edit/profile/{id}', 'ProfileController@updateProfile')->name('user_info.updateProfile');
    Route::put('user_info/updatePassword/{id}','ProfileController@updatePassword')->name('user_info.updatePassword');

    // Permission
    Route::delete('permissions/destroy', 'PermissionController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionController');

    // Roles
    Route::delete('roles/destroy', 'RoleController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RoleController');

    // AuditLogs
    Route::delete('audit_logs/destroy', 'AuditLogsController@massDestroy')->name('audit_logs.massDestroy');
    Route::get('export/audit_logs', 'AuditLogsController@exportCsv')->name('audit_logs.export');
    Route::resource('audit_logs', 'AuditLogsController');

    // Buyer 
    Route::get('buyers/showTrash', 'BuyerController@showTrash')->name('buyers.showTrash');
    Route::get('buyers/restore/trash/{id}','BuyerController@restoreTrash')->name('buyers.restore.trash');
    Route::delete('buyers/trashDelete/{id}','BuyerController@trashDelete')->name('buyers.trashDelete');
    Route::get('export/buyers', 'BuyerController@exportCsv')->name('buyers.export');
    Route::resource('buyers',"BuyerController");

    // Product Category
    // Route::delete('roles/destroy', 'RoleController@massDestroy')->name('roles.massDestroy');
    Route::get('product-category/showTrash', 'ProductCategoryController@showTrash')->name('product-category.showTrash');
    Route::get('product-category/restore/trash/{id}','ProductCategoryController@restoreTrash')->name('product-category.restore.trash');
    Route::delete('product-category/trashDelete/{id}','ProductCategoryController@trashDelete')->name('product-category.trashDelete');
    Route::resource('product-category', 'ProductCategoryController');


    // Measurement
    Route::resource('measurement', 'MeasurementController');

    // Product Order
    Route::get('product-order/showTrash', 'ProductOrderController@showTrash')->name('product-order.showTrash');
    Route::get('product-order/restore/trash/{id}','ProductOrderController@restoreTrash')->name('product-order.restore.trash');
    Route::delete('product-order/trashDelete/{id}','ProductOrderController@trashDelete')->name('product-order.trashDelete');
    Route::resource('product-order', 'ProductOrderController');

    // Product 
    Route::get('product/showTrash', 'ProductController@showTrash')->name('product.showTrash');
    Route::get('product/restore/trash/{id}','ProductController@restoreTrash')->name('product.restore.trash');
    Route::delete('product/trashDelete/{id}','ProductController@trashDelete')->name('product.trashDelete');
    Route::get('product/getmeasurement/{id}','ProductController@getmeasurement')->name('product.getmeasurement');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::resource('products','ProductController');

    // ProductOrderStatus
    Route::get('product-order-status/showTrash', 'ProductOrderStatusController@showTrash')->name('product-order-status.showTrash');
    Route::get('product-order-status/restore/trash/{id}','ProductOrderStatusController@restoreTrash')->name('product-order-status.restore.trash');
    Route::delete('product-order-status/trashDelete/{id}','ProductOrderStatusController@trashDelete')->name('product-order-status.trashDelete');
    Route::resource('product-order-status','ProductOrderStatusController');

    // Status
    Route::resource('status' ,'StatusController');

    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::resource('posts', 'PostController');

    Route::get('product-order-details/showTrash', 'ProductOrderStatusController@showTrash')->name('product-order-details.showTrash');
    Route::get('product-order-details/restore/trash/{id}','ProductOrderStatusController@restoreTrash')->name('product-order-details.restore.trash');
    Route::delete('product-order-details/trashDelete/{id}','ProductOrderStatusController@trashDelete')->name('product-order-details.trashDelete');
    Route::resource('product-order-details','ProductOrderDetailController');


    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
