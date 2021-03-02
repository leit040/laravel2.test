@extends('layout')

@section('title', 'tag Edit')

@section('content')


    <div class="conteiner">
        <h1 class="titel">Добавить категорию</h1>
        <form action="/tag/{{$tag->id }}" method="post" class="form-add">
            @csrf
            @method($method)
            <label for="name" class="replace">tag name</label>
            <input type="text" class="form-add__titel style__all" id="name" name="title" placeholder="tag name" value="{{old('title')?? $tag->title}}">
            @if ($errors->has('title'))
                @foreach($errors->get('title') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif
            <label for="slug" class="replace">tag slug</label>
            <input type="text" class="form-add__titel style__all" id="slug" name="slug" placeholder="tag slug" value="{{old('slug')?? $tag->slug}}">
            @if ($errors->has('slug'))
                @foreach($errors->get('title') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif
            <div class="block__button">
                <button type="submit" class="block__button__inner">Save tag</button>
            </div>
        </form>
    </div>

@endsection
