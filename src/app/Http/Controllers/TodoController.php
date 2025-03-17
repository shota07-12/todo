<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

use App\Models\Category;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->get(); // ✅ カテゴリも一緒に取得
        $categories = Category::all(); // ✅ カテゴリのリストを取得
        return view('index', compact('todos', 'categories'));
    }


    public function store(TodoRequest $request)
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

    public function update(TodoRequest $request, $id)
    {
        // ✅ 指定された ID の ToDo を取得
        $todo = Todo::findOrFail($id);

        // ✅ 入力値を取得（title と content）
        $todo->update([
            'title' => $request->input('title') ?? $todo->title, // ✅ 空なら元のタイトルを維持
            'content' => $request->input('content'),
        ]);

        // ✅ 更新完了メッセージを表示
        return redirect()->route('todos.index')->with('success', 'ToDoを更新しました！');
    }


    public function destroy($id)
    {
        $todo = Todo::findOrFail($id); // IDに該当するToDoを取得
        $todo->delete(); // 削除

        return redirect()->route('todos.index')->with('success', 'ToDoを削除しました！');
    }
}