@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
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
    <form class="form1" action="/categories" method="post">
        @csrf
        <div class="form1__input">
            <div class="form1__input--text">
                <input class="form1__input--text-input" type="text" name="name" value="{{old('name')}}">
            </div>
            <div class="form1__input--button">
                <button class="form1__input--button-submit" type="submit">作成</button>
            </div>
        </div>
    </form>

    <div class="todo__title">category</div>
    @foreach ($categories as $category)
    <div class="form2">
        <form class="update-form" action="/categories/update" method="post">
            @method('PATCH')
            @csrf
            <input class="update-form__input-text" type="text" name="name" value="{{ $category['name'] }}" >
            <input type="hidden" name="id" value="{{ $category['id'] }}">
            <button class="update-form--button-submit" type="submit">更新</button>
        </form>
        <form class="delete-form" action="/categories/delete" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $category['id'] }}">
            <button class="delete-form__button-submit" type="submit">削除</button>
        </form>
    </div>
    @endforeach
</div>
@endsection()
