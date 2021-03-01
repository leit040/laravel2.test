@extends('layout')

@section('title', 'Category Edit')

@section('content')


</br></br></br>
</br>

    <h1>Categories </h1>




 <form class="form-text" action="/category/{{$category->id }}" method="post">

            @csrf

     @method($method)

        <p>Category name <input name="title" size="40" value="{{old('title')?? $category->title}}"><br>


        @if ($errors->has('title'))
        @foreach($errors->get('title') as $error)

                <div class="alert alert-warning" role="alert">
                    <p style="color: brown">{{$error}}</p>
                </div>
            @endforeach

        @endif

        <p>Category slug <input name="slug" size="40" value="{{old('slug')?? $category->slug}}"><br>
     @if ($errors->has('slug'))
         @foreach($errors->get('title') as $error)

             <div class="alert alert-warning" role="alert">
                 <p style="color: brown">{{$error}}</p>
             </div>
         @endforeach

     @endif
                <p><input name ="submit" type="submit" value="save category">
    </form>

        @endsection
