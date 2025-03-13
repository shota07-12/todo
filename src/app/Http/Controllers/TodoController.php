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
        // バリデーション（必要なら）
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 新しいToDoを作成
        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('todos.index')->with('success', 'ToDoを作成しました！');
    }
}