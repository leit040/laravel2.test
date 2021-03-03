@extends('layout')

@section('title', 'Users')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    @endpush
@section('content')




<div class="conteiner">
    <h1 class="titel">Регестрация</h1>
    <form action="/user/{{$user->id }}" class="form-add" method="post">
        @csrf
        @method($method)
        <label for="name" class="replace">User name</label>
        <input type="text" class="form-add__titel style__all" id="name" placeholder="User name" name="name" value="{{old('name')?? $user->name}}">
        @if ($errors->has('name'))
            @foreach($errors->get('name') as $error)

                <div class="alert alert-warning" role="alert">
                    <p style="color: brown">{{$error}}</p>
                </div>
            @endforeach
        @endif
        <label for="slug" class="replace">User email</label>
        <input type="email" class="form-add__titel style__all" id="email" placeholder="User email" name="email" value="{{old('email')?? $user->email}}">
         @if ($errors->has('email'))
        @foreach($errors->get('email') as $error)

            <div class="alert alert-warning" role="alert">
        <p style="color: brown">{{$error}}</p>
</div>
@endforeach
@endif
        <label for="slug" class="replace">User password</label>
        <input type="password" class="form-add__titel style__all" id="password" placeholder="User password" name="password" value="{{old('password')?? $user->password}}">
@if ($errors->has('password'))
    @foreach($errors->get('password') as $error)

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

 {{--<form action="/user/{{$user->id }}" class="form-text" method="post">


            @csrf
     @method($method)
            <p>user name <input name="name" size="40" value="{{old('name')?? $user->name}}"><br>



     @if ($errors->has('name'))
         @foreach($errors->get('name') as $error)

             <div class="alert alert-warning" role="alert">
                 <p style="color: brown">{{$error}}</p>
             </div>
         @endforeach
     @endif

            <p>user email <input name="email" size="40" value="{{old('email')?? $user->email}}"><br>
             @if ($errors->has('email'))
                 @foreach($errors->get('email') as $error)

                     <div class="alert alert-warning" role="alert">
                         <p style="color: brown">{{$error}}</p>
                     </div>
                 @endforeach
     @endif
            <p>user password <input name="password" size="40" value="{{old('password')?? $user->password}}"><br>
                     @if ($errors->has('password'))
                         @foreach($errors->get('password') as $error)

                             <div class="alert alert-warning" role="alert">
                                 <p style="color: brown">{{$error}}</p>
                             </div>
                         @endforeach
     @endif
            <p><input name ="submit" type="submit" value="save user">
        </form>--}}

@endsection
