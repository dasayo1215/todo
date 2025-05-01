@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
@if(session('message'))
    <div class="todo-form__notice--success">{{ session('message') }}</div>
@endif

@if ($errors->any())
    <ul class="todo-form__notice--error">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif


<div class="todo-form__content">
    <div class="new__title">新規作成</div>
    <form class="form1" action="/todos" method="post">
        @csrf
        <div class="form1__input">
            <div class="form1__input--text">
                <input class="form1__input--text-input" type="text" name="content">
            </div>
            <select class="form1__input--category" name="category_id" required>
                <option value="" selected>カテゴリ</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="form1__input--button">
                <button class="form1__input--button-submit" type="submit">作成</button>
            </div>
        </div>
    </form>

    <div class="new__title">Todo検索</div>
    <form class="form1" action="/todos/search" method="get">
        @csrf
        <div class="form1__input">
            <div class="form1__input--text">
                <input class="form1__input--text-input" type="text" name="keyword" value="{{ old('keyword') }}">
            </div>
            <select class="form1__input--category" name="category_id">
                <option value="" selected>カテゴリ</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="form1__input--button">
                <button class="form1__input--button-submit" type="submit">検索</button>
            </div>
        </div>
    </form>

    <div class="todo__title">
        <div class="todo__title-todo">Todo</div>
        <div class="todo__title-category">カテゴリ</div>
    </div>
    @foreach ($todos as $todo)
    <div class="form2">
        <form class="update-form" action="/todos/update" method="post">
            @method('PATCH')
            @csrf
            <input class="update-form__input-text" type="text" name="content" value="{{ $todo['content'] }}" >
            <input type="hidden" name="id" value="{{ $todo['id'] }}">
            <div class="update-form__input-text">{{ $todo->category->name }}</div>
            <button class="update-form--button-submit" type="submit">更新</button>
        </form>
        <form class="delete-form" action="/todos/delete" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $todo['id'] }}">
            <button class="delete-form__button-submit" type="submit">削除</button>
        </form>
    </div>
    @endforeach
</div>
@endsection()
