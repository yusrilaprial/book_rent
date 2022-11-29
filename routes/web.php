<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
})->middleware('auth');

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('only_admin');

    Route::get('/profile', [UserController::class, 'profile'])->middleware('only_client');

    Route::get('/books', [BookController::class, 'index']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category-add', [CategoryController::class, 'add']);
    Route::post('/category-add', [CategoryController::class, 'store']);
    Route::get('/category-edit/{slug}', [CategoryController::class, 'edit']);
    Route::put('/category-edit/{slug}', [CategoryController::class, 'update']);
    Route::get('/category-delete/{slug}', [CategoryController::class, 'delete']);
    Route::get('/category-destroy/{slug}', [CategoryController::class, 'destroy']);
    Route::get('/category-deleted', [CategoryController::class, 'deletedCategory']);
    Route::get('/category-restore/{slug}', [CategoryController::class, 'restore']);

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/rent-logs', [RentLogController::class, 'index']);
});