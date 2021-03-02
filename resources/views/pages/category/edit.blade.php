@extends('layout')

@section('title', 'Category Edit')

@section('content')




<div class="conteiner">
    <h1 class="titel">Добавить категорию</h1>
    <form action="/category/{{$category->id }}" method="post" class="form-add">
    @csrf
    @method($method)
        <label for="name" class="replace">Category name</label>
        <input type="text" class="form-add__titel style__all" id="name" name="title" placeholder="Category name" value="{{old('title')?? $category->title}}">
        @if ($errors->has('title'))
        @foreach($errors->get('title') as $error)

            <div class="alert alert-warning" role="alert">
    <p style="color: brown">{{$error}}</p>
</div>
@endforeach

@endif
        <label for="slug" class="replace">Category slug</label>
        <input type="text" class="form-add__titel style__all" id="slug" name="slug" placeholder="Category slug" value="{{old('slug')?? $category->slug}}">
@if ($errors->has('slug'))
    @foreach($errors->get('title') as $error)

        <div class="alert alert-warning" role="alert">
            <p style="color: brown">{{$error}}</p>
        </div>
    @endforeach

@endif
        <div class="block__button">
            <button type="submit" class="block__button__inner">Save Category</button>
        </div>
    </form>
</div>





        @endsection
