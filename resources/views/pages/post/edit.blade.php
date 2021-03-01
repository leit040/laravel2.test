@extends('layout')

@section('title', 'Post')

@section('content')




<div class="container">
    <div class="row justify-content-start">
        <div class="col title">
            <h1>Добавить новый пост</h1>
        </div>
        <div class="col-4,info1" class ="container-form">
            <form action="" name="main" method="post" class="form">
                @csrf
                <h2 class="col-4,info1 title">Title</h2>
                <input name="title"  class ="input-titel display-form" value="{{old('title')?? $post->title}}">
                @if ($errors->has('title'))
                    @foreach($errors->get('title') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach

                @endif

                <h2 class="col-4,info1 title">Post</h2>
                <textarea name="body" class="form-textarea display-form">{{old('body')?? $post->body}}</textarea>
                @if ($errors->has('body'))
                    @foreach($errors->get('body') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach

                @endif
                <select name="category_id" class ="select-form">
                    @if((old('category_id')))
                    {{$select_id=old('category_id')}}
                    @else {{$select_id=$post->category_id}}
                    @endif


                    @foreach($categories as $categoryforID)



                        <option @if ($categoryforID->id==old('category_id')) selected @endif value="{{$categoryforID->id}}">{{$categoryforID->title}}</option>


                            @endforeach
                </select>
                @if ($errors->has('category_id'))
                    @foreach($errors->get('category_id') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach

                @endif

                    <select name="user_id" class ="select-form">
                        @if(old('user_id'))
                            {{$select_id=old('user_id')}}
                        @else {{$select_id=$post->user_id}}
                        @endif


                        @foreach($users as $userforID)



                            <option @if ($userforID->id==$select_id): selected @endif value="{{$userforID->id}}">{{$userforID->name}}</option>


                        @endforeach
                    </select>
                @if ($errors->has('user_id'))
                    @foreach($errors->get('user_id') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach

                @endif




                <div class="chackbox">
                    @foreach($tags as $tag)
                        <div class="input-group">
                         @if(old('tags_id'))
                                <input @if(array_search($tag->id,old('tags_id'))!==false) checked @endif class = "input-checkbox" type="checkbox" name="tags_id[]" value={{$tag->id}}>{{$tag->title}}
                            @else
                                <input @if(array_search($tag->id,$post->tags->pluck('id')->toArray())!==false) checked @endif class = "input-checkbox" type="checkbox" name="tags_id[]" value={{$tag->id}}>{{$tag->title}}
                        @endif

                        </div>
                    @endforeach
                </div>
                <div class="submit">
                    <input class = "input-checkbox submit-save" type="submit" name="save" value="Save">
                </div>
                @if ($errors->has('tags_id'))
                    @foreach($errors->get('tags_id') as $error)

                        <div class="alert alert-warning" role="alert">
                            <p style="color: brown">{{$error}}</p>
                        </div>
                    @endforeach

                @endif
            </form>
        </div>
    </div>
</div>




@endsection
