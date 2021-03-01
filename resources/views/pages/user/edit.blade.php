@extends('layout')

@section('title', 'Users')

@section('content')


</br></br></br>
</br>

 <form class="form-text" method="post">


            @csrf
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
        </form>

@endsection
