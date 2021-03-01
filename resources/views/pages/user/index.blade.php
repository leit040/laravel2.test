@extends('layout')

@section('title', 'tags')
@include('message')
@yield('message')
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
            <table  class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">Create at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
                </thead>
                @endif

                <tr><td>{{$user->id}}</td><td>{{ $user->name }}
                    </td><td>{{$user->email}}</td><td>{{$user->created_at}}</td><td>{{$user->updated_at}}</td><td><form action="/user/{{$user->id}}/delete" method="get">@csrf
                            <input type="submit" value="удалить"></form></td><td><form action="/user/{{$user->id}}/update" method="get">@csrf
                            <input type="submit" value="изменить"></form></td></tr>

                @if ($loop->last)
            </table>
        @endif
    @empty
        <p>no users</p>
    @endforelse

    @include('paginator',['pages'=>$users])

@endsection
