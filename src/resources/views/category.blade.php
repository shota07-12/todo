@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
    @if (session('message'))
    <div class="category__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="category__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="category__content">
    <!-- ✅ カテゴリ新規作成フォーム -->
    <form class="create-form" action="/categories" method="POST">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="name" placeholder="カテゴリ名を入力">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>


    <!-- ✅ カテゴリ一覧表示 -->
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">カテゴリ</th>
                <th class="category-table__header">操作</th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <!-- ✅ 更新フォーム -->
                <td class="category-table__item">
                    <form class="update-form" action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" name="name" value="{{ $category->name }}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>

                <!-- ✅ 削除フォーム -->
                <td class="category-table__item">
                    <form class="delete-form" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection