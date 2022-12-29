<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Service;
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

Route::get('/', function () {
    return redirect('/login');
});

// Route Grouping used prefix admin for authntication
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Master Users Controller
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');

    // Service Controller
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::patch('/service/{id}/update', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{id}/delete', [ServiceController::class, 'destroy'])->name('service.delete');

    // Service Repair
    Route::get('/service/{id}/repair', [ServiceController::class, 'repair'])->name('service.repair');

    // Service Repair Activity
    Route::get('/service/{id}/create/activity', [ServiceController::class, 'create_activity'])->name('create.activity');
    Route::post('/service/{id}/store/activity', [ServiceController::class, 'store_activity'])->name('store.activity');

    // Service Additional Items
    Route::get('/service/{id}/create/additional-item', [ServiceController::class, 'create_additional_item'])->name('create.additional.item');
    Route::post('/service/{id}/store/additional-item', [ServiceController::class, 'store_additional_item'])->name('store.additional.item');

    // Page Resi Service
    Route::get('/service/{service}/resi', [ServiceController::class, 'resiView'])->name('resi.view');

    // Transaction
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/{id}/show', [TransactionController::class, 'show'])->name('transaction.show');
    Route::post('/transaction/{id}/store', [TransactionController::class, 'store'])->name('transaction.store');
    // Page Nota Transaction
    Route::get('/transaction/{id}/cetak', [TransactionController::class, 'cetakView'])->name('transaction.cetak');
});