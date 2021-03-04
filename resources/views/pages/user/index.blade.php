@extends('layout')

@section('title', 'tags')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
@include('message')

@section('content')
    <h1>users</h1>
    @if(isset($_SESSION['message']))
        <div class="alert alert-{{$_SESSION['message']['status']}}" role="alert">
            {{$_SESSION['message']['message']}}
        </div>
        @unset($_SESSION['message'])
    @endif
    @forelse($users as $user)
        @if ($loop->first)
            <div class="conteiner">
                <div class="table table-striped">
                    <ul class="block__list">
                        <li class="col">#</li>
                        <li class="col">Name</li>
                        <li class="col">email</li>
                        <li class="col">Create at</li>
                        <li class="col">Updated at</li>
                        <li class="col col-item">Delete</li>
                        <li class="col col-item">Update</li>
                    </ul>
                    @yield('message')
                    @endif
                    <ul class="block__list block__list-other">
                        <li class="col">{{$user->id}}</li>
                        <li class="col">{{$user->name}}</li>
                        <li class="col">{{$user->email}}</li>
                        <li class="col">{{$user->created_at}}</li>
                        <li class="col">{{$user->updated_at}}</li>
                        <li class="col col-item">
                            <form action="/user/{{$user->id}}" method="post"> @csrf @method('DELETE')
                                <input type="submit" class="button" value="удалить">
                            </form>
                        </li>
                        <li class="col col-item">
                            <form action="{{route('user.edit',$user)}}" method="get">@csrf
                                <input type="submit" class="button" value="изменить">
                            </form>
                        </li>
                    </ul>


                    @if ($loop->last)
                </div>
            </div>
        @endif
    @empty
        <p>no users</p>
    @endforelse

    @include('paginator',['pages'=>$users])

@endsection
