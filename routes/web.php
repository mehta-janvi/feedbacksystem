<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.app');
// });


Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');


 Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('dashboard', [AuthController::class, 'index'])->name('admin.index');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
});


Route::get('index', [FeedbackController::class, 'index'])->name('feedback.index');
Route::get('create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('feedback/fetch', [FeedbackController::class, 'fetchFeedback'])->name('feedback.fetch');
