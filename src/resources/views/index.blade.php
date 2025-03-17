@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="todo__alert">
    @if (session('message'))
    <div class="todo__alert--success">{{ session('message') }}</div>
    @endif
    @if ($errors->any())
    <div class="todo__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="todo__content">
    <!-- ✅ 新規作成フォーム -->
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}" />

            <!-- ✅ カテゴリ選択を追加 -->
            <select class="create-form__item-select" name="category_id">
                <option value="">カテゴリ</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>

    <!-- ✅ Todo一覧表示 -->
    <div class="section__title">
        <h2>Todo一覧</h2>
    </div>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th class="todo-table__header">カテゴリ</th>
                <th class="todo-table__header">操作</th>
            </tr>

            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form" action="/todos/update" method="post">
                        @method('PATCH')<form class="update-form" action="{{ route('todos.update', $todo->id) }}" method="post">
                            @csrf
                            <div class="update-form__item">
                                <input class="update-form__item-input" type="text" name="content" value="{{ $todo->content }}" />
                                <input type="hidden" name="id" value="{{ $todo->id }}" />
                            </div>
                </td>

                <!-- ✅ カテゴリ表示 -->
                <td class="todo-table__item">
                    <p class="update-form__item-p">{{ optional($todo->category)->name ?? '未分類' }}</p>
                </td>

                <!-- ✅ 更新・削除ボタンを追加 -->
                <td class="todo-table__item">
                    <div class="update-form__button">
                        <button class="update-form__button-submit btn btn-primary" type="submit">更新</button>
                    </div>
                    </form>

                    <form class="delete-form" action="{{ route('todos.destroy', $todo->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit btn btn-danger" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection