@extends('layout')

@section('title', 'Categories')
@include('message')
@yield('message')

@section('content')

<h1 class = "info, info1">pages111</h1>


@foreach($posts as $post)

    <div class="text-white bg-dark info">
        <h1># {{ $post->id }} Created at  {{ $post->created_at->diffForHumans() }}</h1>
        <h1>{{ $post->title }}</h1><a href="/post/{{$post->id}}/edit"  type="submit" >Редактировать</a>
        <a href="/post/{{$post->id}}/delete"  type="submit" >Удалить</a>
    </div>
    <div class="text-info bg-dark info">
        <h3>category: <a href="/post/category/{{$post->category_id}}">{{$post->category->title}}</a></h3>
        <h3>Author: <a href="/post/user/{{$post->user_id}}">{{$post->user->name}}</a></h3>
    </div>
    <div class="text-primary info">
        <p>tags:
            @foreach($post->tags as $tag)
                <a href="/post/tag/{{$tag->id}}">{{$tag->title}}</a>
        @endforeach
    </div>
    </br>
    <p class = "info">{{$post->body}}</p>
    </br>
@endforeach


@include('paginator',['pages'=>$posts])

@endsection
