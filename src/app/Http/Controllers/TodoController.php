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

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:20', // content に変更
        ]);

        // 新しいToDoを作成
        Todo::create([
            'title' => $request->input('title'),
            'content' => $request->input('content') ?? '(未設定)', // description → content に変更
        ]);

        return redirect()->route('todos.index')->with('success', 'ToDoを作成しました！');
    }
}