<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

// ✨ 編集ページのルートを追加
Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');

// ToDo 削除用のルートを追加
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
