@extends('layout')

@section('title', 'Categories')
@include('message')
@yield('message')

@section('content')



    @yield('message')
@foreach($posts as $post)


    <div class="main">
        <div class="main__post">
            <p class="main__post__time">{{ $post->created_at->diffForHumans() }}</p>
            <h1 class="main__post__titel">{{ $post->title }}</h1>
            <div class="main__post__option">
                <form action="/post/{{$post->id}}/edit" method="get">
                    @csrf
                    <div class="main__post__option">
                        <form action="/post/{{$post->id}}/edit" method="get">
                        <input {{-- href="/post/4/edit"--}} type="submit"  class="main__post__button main__post__amend" value="Редактировать"></form>
                <form action="/post/{{$post->id}}/delete" method="get">
                        <input {{--href="/post/4/delete"--}} type="submit"  class="main__post__button main__post__delete" value="Удалить"> </form>
                    </div>

            </div>
            <div class="main__post__category">
                <p class="main__post__category__titel">Category: </p>
                <a href="/post/category/{{$post->category_id}}" class="main__post__category__name">{{$post->category->title}}</a>
            </div>
            <div class="main__post__author">
                <p class="main__post__author__titel">Author: </p>
                <a href="/post/user/{{$post->user_id}}" class="main__post__author__name">{{$post->user->name}}</a>
            </div>
            <div class="main__post__teg">
                <p class="main__post__teg__titel">Teg: </p>
                @foreach($post->tags as $tag)

                <a href="{{route('post.tag',$tag->id)}}" class="main__post__teg__name">{{$tag->title}}</a>
                @endforeach
            </div>
            <p class="main__post__info">
                {{$post->body}}
            </p>
        </div>
    </div>



    {{--<div class="text-white bg-dark info">
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
    </br>--}}
@endforeach


@include('paginator',['pages'=>$posts])

@endsection
