<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(Request $request)
    {

        die('ここまで来た'); // ← ここで処理が止まるか確認

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $request->only(['name']);
        Category::create($category);

        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }
}
