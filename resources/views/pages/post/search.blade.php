@extends('layout')

@section('title', 'Categories')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush

@section('content')



    <div class="conteiner">
        <h1 class="titel">Поиск поста</h1>
        <form action="/post/search" class="form-add" method="post">
            @csrf

            <label for="author" class="replace">Option Author</label>
            <select name="user_id" id="author" class="form-add__author style__all">
                @foreach($users as $user)
                <option class="form-add__author__inner" value={{ $user->id }}>{{ $user->name }},({{ $user->posts_count }} posts)</option>
                @endforeach
            </select>
            @if (isset($_SESSION['errors']['user_id']))
                @foreach($_SESSION['errors']['user_id'] as $error)

                    <div class="alert alert-warning" role="alert">
                        {{$error}}
                    </div>
                @endforeach

            @endif

            <label for="category" class="replace">Option Category</label>
            <select name="category_id" id="category" class="form-add__category  style__all">
                @forelse($categories as $category)
                <option class="form-add__category__inner" value={{ $category->id }}>{{ $category->title }},({{ $category->posts_count }} posts)</option>
                @empty
                    <p>no categories</p>
                @endforelse
            </select>





                </select>
                @if (isset($_SESSION['errors']['category_id']))
                    @foreach($_SESSION['errors']['category_id'] as $error)

                        <div class="alert alert-warning" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                        <label for="tag" class="replace">Option Tag</label>
                        <select name="tags_id[]" id="tag" class="form-add__category  style__all" multiple>
                            @foreach($tags as $tag)
                            <option class="form-add__category__inner" value={{ $tag->id }}>{{ $tag->title }},({{ $tag->posts_count }} posts)</option>
                            @endforeach
                        </select>

                        @if (isset($_SESSION['errors']['category_id']))
                            @foreach($_SESSION['errors']['category_id'] as $error)

                                <div class="alert alert-warning" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach

                        @endif

                        <div class="block__button">
                            <button type="submit" class="block__button__inner">Search</button>
                        </div>
        </form>
    </div>

    @php unset($_SESSION['errors']);
     unset($_SESSION['data']);

    @endphp

@endsection
