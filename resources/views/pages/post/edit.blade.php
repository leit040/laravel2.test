@extends('layout')

@section('title', 'Post')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush

@section('content')

    <div class="conteiner">
        <h1 class="titel">Добавить пост</h1>

        <form action="#" class="form-add" method="post">
            @csrf
            <label for="titel" class="replace">Headline</label>
            <input type="text" class="form-add__titel style__all" id="titel" placeholder="headline" name="title" value="{{old('title')?? $post->title}}">

            @if ($errors->has('title'))
                @foreach($errors->get('title') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif
            <label for="category" class="replace">Option Category</label>
            <select name="category_id" id="category" class="form-add__category  style__all">
                @if((old('category_id')))
                    {{$select_id=old('category_id')}}
                @else {{$select_id=$post->category_id}}
                @endif


                @foreach($categories as $categoryforID)
                    <option class="form-add__category__inner" @if ($categoryforID->id==old('category_id')) selected @endif value="{{$categoryforID->id}}">{{$categoryforID->title}}</option>

                @endforeach
            </select>
            @if ($errors->has('category_id'))
                @foreach($errors->get('category_id') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif
            <label for="author" class="replace">Option Author</label>
            <select name="user_id" id="author" class="form-add__author style__all">
                @if(old('user_id'))
                    {{$select_id=old('user_id')}}
                @else {{$select_id=$post->user_id}}
                @endif


                @foreach($users as $userforID)
                    <option class="form-add__author__inner" @if ($userforID->id==$select_id): selected @endif value="{{$userforID->id}}">{{$userforID->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('user_id'))
                @foreach($errors->get('user_id') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif




            <label for="post" class="replace">Write text</label>
            <textarea class="style__all" name="body" id="post" cols="30" rows="10" placeholder="Write text">{{old('body')?? $post->body}}</textarea>

            @if ($errors->has('body'))
                @foreach($errors->get('body') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif
            <p class="titel__tag">Option Tag</p>
            <div class="checkbox">
                @foreach($tags as $tag)
                    <div class="checkbox-inner">
                    @if(old('tags_id'))
                        <input type="checkbox" class="checkbox__input check" @if(array_search($tag->id,old('tags_id'))!==false) checked @endif name="tags_id[]" value={{$tag->id}}>
                    @else
                        <input type="checkbox" class="checkbox__input check" @if(array_search($tag->id,$post->tags->pluck('id')->toArray())!==false) checked @endif name="tags_id[]" value={{$tag->id}}>
                    @endif
                    <label for="checkbox__input"class="check">{{$tag->title}}</label>   </div>
                @endforeach
            </div>
            @if ($errors->has('tags_id'))
                @foreach($errors->get('tags_id') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach

            @endif
            <div class="block__button">
                <button type="submit" class="block__button__inner">Save</button>
            </div>
        </form>
    </div>







@endsection



