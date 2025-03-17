<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

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

// ホームページをTodo一覧にする
Route::get('/', [TodoController::class, 'index'])->name('todos.index');

// ToDo のルートを定義
Route::get('/todos', [TodoController::class, 'index']); // 一覧表示
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store'); // データ登録

// 更新用のルートを追加（ここを追加！）
Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');

// 編集ページのルート
Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');

// ToDo 削除用のルート
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/categories', [CategoryController::class, 'store']);