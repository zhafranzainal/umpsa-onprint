<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DeliveryOptionController;
use App\Models\Category;

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

Route::get('/', function () {
    $categories = Category::All();
    return view('welcome', compact('categories'));
});

Route::prefix('/')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('categories', CategoryController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('delivery-options', DeliveryOptionController::class);
    Route::resource('feedbacks', FeedbackController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('outlets', OutletController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('riders', RiderController::class);
    Route::resource('users', UserController::class);

    Route::get('orders/campus', [OrderController::class, 'indexCampus'])->name('orders.index-campus');
    Route::get('orders/campus/{campus}', [OrderController::class, 'showCampus'])->name('orders.show-campus');
    Route::resource('orders', OrderController::class);

    Route::resource('transactions', TransactionController::class);
    Route::resource('complaints', ComplaintController::class);
});
