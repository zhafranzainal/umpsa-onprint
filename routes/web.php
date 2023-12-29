<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CampusController;
use Illuminate\Support\Facades\Route;

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
    Route::get('campus', [CampusController::class, 'index'])->name('campuses.index');
    Route::get('campus/{campus}', [CampusController::class, 'show'])->name('campuses.show');

    Route::resource('orders', OrderController::class)->except(['show']);
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('verify.order.campus');
});
