<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RiderController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\OutletOrdersController;
use App\Http\Controllers\Api\PackageOrdersController;
use App\Http\Controllers\Api\DeliveryOptionController;
use App\Http\Controllers\Api\CategoryPackagesController;
use App\Http\Controllers\Api\InventoryOutletsController;
use App\Http\Controllers\Api\UserTransactionsController;
use App\Http\Controllers\Api\OutletInventoriesController;
use App\Http\Controllers\Api\TransactionOrdersController;
use App\Http\Controllers\Api\ComplaintFeedbacksController;
use App\Http\Controllers\Api\DeliveryOptionOrdersController;
use App\Http\Controllers\Api\TransactionDeliveriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('categories', CategoryController::class);

        // Category Packages
        Route::get('/categories/{category}/packages', [
            CategoryPackagesController::class,
            'index',
        ])->name('categories.packages.index');
        Route::post('/categories/{category}/packages', [
            CategoryPackagesController::class,
            'store',
        ])->name('categories.packages.store');

        Route::apiResource('deliveries', DeliveryController::class);

        Route::apiResource('delivery-options', DeliveryOptionController::class);

        // DeliveryOption Orders
        Route::get('/delivery-options/{deliveryOption}/orders', [
            DeliveryOptionOrdersController::class,
            'index',
        ])->name('delivery-options.orders.index');
        Route::post('/delivery-options/{deliveryOption}/orders', [
            DeliveryOptionOrdersController::class,
            'store',
        ])->name('delivery-options.orders.store');

        Route::apiResource('feedbacks', FeedbackController::class);

        Route::apiResource('inventories', InventoryController::class);

        // Inventory Outlets
        Route::get('/inventories/{inventory}/outlets', [
            InventoryOutletsController::class,
            'index',
        ])->name('inventories.outlets.index');
        Route::post('/inventories/{inventory}/outlets/{outlet}', [
            InventoryOutletsController::class,
            'store',
        ])->name('inventories.outlets.store');
        Route::delete('/inventories/{inventory}/outlets/{outlet}', [
            InventoryOutletsController::class,
            'destroy',
        ])->name('inventories.outlets.destroy');

        Route::apiResource('outlets', OutletController::class);

        // Outlet Orders
        Route::get('/outlets/{outlet}/orders', [
            OutletOrdersController::class,
            'index',
        ])->name('outlets.orders.index');
        Route::post('/outlets/{outlet}/orders', [
            OutletOrdersController::class,
            'store',
        ])->name('outlets.orders.store');

        // Outlet Inventories
        Route::get('/outlets/{outlet}/inventories', [
            OutletInventoriesController::class,
            'index',
        ])->name('outlets.inventories.index');
        Route::post('/outlets/{outlet}/inventories/{inventory}', [
            OutletInventoriesController::class,
            'store',
        ])->name('outlets.inventories.store');
        Route::delete('/outlets/{outlet}/inventories/{inventory}', [
            OutletInventoriesController::class,
            'destroy',
        ])->name('outlets.inventories.destroy');

        Route::apiResource('packages', PackageController::class);

        // Package Orders
        Route::get('/packages/{package}/orders', [
            PackageOrdersController::class,
            'index',
        ])->name('packages.orders.index');
        Route::post('/packages/{package}/orders', [
            PackageOrdersController::class,
            'store',
        ])->name('packages.orders.store');

        Route::apiResource('riders', RiderController::class);

        Route::apiResource('users', UserController::class);

        // User Transactions
        Route::get('/users/{user}/transactions', [
            UserTransactionsController::class,
            'index',
        ])->name('users.transactions.index');
        Route::post('/users/{user}/transactions', [
            UserTransactionsController::class,
            'store',
        ])->name('users.transactions.store');

        Route::apiResource('orders', OrderController::class);

        Route::apiResource('transactions', TransactionController::class);

        // Transaction Deliveries
        Route::get('/transactions/{transaction}/deliveries', [
            TransactionDeliveriesController::class,
            'index',
        ])->name('transactions.deliveries.index');
        Route::post('/transactions/{transaction}/deliveries', [
            TransactionDeliveriesController::class,
            'store',
        ])->name('transactions.deliveries.store');

        // Transaction Orders
        Route::get('/transactions/{transaction}/orders', [
            TransactionOrdersController::class,
            'index',
        ])->name('transactions.orders.index');
        Route::post('/transactions/{transaction}/orders', [
            TransactionOrdersController::class,
            'store',
        ])->name('transactions.orders.store');

        Route::apiResource('complaints', ComplaintController::class);

        // Complaint Feedbacks
        Route::get('/complaints/{complaint}/feedbacks', [
            ComplaintFeedbacksController::class,
            'index',
        ])->name('complaints.feedbacks.index');
        Route::post('/complaints/{complaint}/feedbacks', [
            ComplaintFeedbacksController::class,
            'store',
        ])->name('complaints.feedbacks.store');
    });
