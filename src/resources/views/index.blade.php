@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection

@section('content')
<div class="todo__alert">
    @if(session('success'))
    <div class="todo__alert--success">
        {{ session('success') }}
    </div>
    @endif

    <!-- ✅ バリデーションエラーのメッセージを追加 -->
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
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="title" placeholder="タイトルを入力">
            <input class="create-form__item-input" type="text" name="content" placeholder="内容を入力">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>

    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">タイトル</th> <!-- ✅ 「Todo」→「タイトル」に変更 -->
                <th class="todo-table__header">内容</th>
                <th class="todo-table__header">操作</th>
            </tr>

            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <p class="update-form__item-input">{{ $todo->title }}</p> <!-- ✅ title を追加 -->
                </td>
                <td class="todo-table__item">
                    <form class="update-form" action="{{ route('todos.update', $todo->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <!-- ✅ タイトルの入力フィールドを追加 -->
                            <input class="update-form__item-input" type="text" name="title" value="{{ $todo->title }}">
                            <!-- ✅ 内容の入力フィールド -->
                            <input class="update-form__item-input" type="text" name="content" value="{{ $todo->content }}">
                            <input type="hidden" name="id" value="{{ $todo->id }}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>

                <td class="todo-table__item">
                    <form class="delete-form" action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-form__button-submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection