<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all(); // データベースから全てのToDoを取得
        return view('index', compact('todos')); // 'index' に $todos を渡す
    }
}