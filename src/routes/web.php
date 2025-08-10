<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');;
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/send', [ContactController::class, 'send'])->name('contacts.send');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

Route::get('/login', function () {
    return view('auth.login');  // resources/views/login.blade.php
})->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');             // お問い合わせ一覧
    Route::get('/users', [AdminController::class, 'users']);       // ユーザー一覧
    Route::get('/export', [AdminController::class, 'export']);      // CSVエクスポートなど
    Route::delete('/{contact}', [AdminController::class, 'destroy']); // 削除処理
    Route::post('/store', [AdminController::class, 'store']);       // 管理画面での保存など
});
Route::get('/admin/contacts/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
