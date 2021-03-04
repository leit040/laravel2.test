@extends('layout')

@section('title', 'Categories')
@include('message')
@yield('message')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
@section('content')



    @yield('message')
    Fined {{$posts->count()}} posts
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
                                @auth <input type="submit" class="main__post__button main__post__amend"
                                             value="Редактировать"></form>@endauth
                            <form action="/post/{{$post->id}}/delete" method="get">
                                @auth<input type="submit" class="main__post__button main__post__delete" value="Удалить">
                            </form>@endauth
                        </div>

                </div>
                <div class="main__post__category">
                    <p class="main__post__category__titel">Category: </p>
                    <a href="/post/category/{{$post->category_id}}"
                       class="main__post__category__name">{{$post->category->title}}</a>
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




    @endforeach


    @include('paginator',['pages'=>$posts])

@endsection
