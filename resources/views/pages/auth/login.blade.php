@extends('layout')

@section('title', 'Users')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
@section('content')




    <div class="conteiner">
        <h1 class="titel">Регистрация</h1>
        <form action="" class="form-add" method="post">
            @csrf
            <label for="slug" class="replace">User email</label>
            <input type="email" class="form-add__titel style__all" id="email" placeholder="User email" name="email"
                   value="{{old('email')}}">
            @if ($errors->has('email'))
                @foreach($errors->get('email') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <label for="slug" class="replace">User password</label>
            <input type="password" class="form-add__titel style__all" id="password" placeholder="User password"
                   name="password" value="{{old('password')}}">
            @if ($errors->has('password'))
                @foreach($errors->get('password') as $error)

                    <div class="alert alert-warning" role="alert">
                        <p style="color: brown">{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <div class="block__button">
                <button type="submit" class="block__button__inner">Login</button>


            </div>
        </form>
        <div><a href="{{$gitHubLink}}">Login via GitHub</a></div>
        <div><a href="{{$yahooLink}}">Login via Yahoo</a></div>

    </div>


@endsection
