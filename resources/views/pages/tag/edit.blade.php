@extends('layout')

@section('title', 'Tag Edit')

@section('content')


</br></br></br>
</br>

    <h1>Tags </h1>




 <form class="form-text" action="" method="post">

            @csrf

        <p>tag name <input name="title" size="40" value="{{old('title')?? $tag->title}}"><br>


        @if ($errors->has('title'))
        @foreach($errors->get('title') as $error)

                <div class="alert alert-warning" role="alert">
                    <p style="color: brown">{{$error}}</p>
                </div>
            @endforeach

        @endif

        <p>tag slug <input name="slug" size="40" value="{{old('slug')?? $tag->slug}}"><br>
     @if ($errors->has('slug'))
         @foreach($errors->get('title') as $error)

             <div class="alert alert-warning" role="alert">
                 <p style="color: brown">{{$error}}</p>
             </div>
         @endforeach

     @endif
                <p><input name ="submit" type="submit" value="save tag">
    </form>

        @endsection
