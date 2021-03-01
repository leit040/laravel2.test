@extends('index')

@section('title', 'tags')
@include('message')
@yield('message')
@section('content')
    @forelse($tags as $tag)
        @if ($loop->first)
            <table  class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Create at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
                </thead>
                @endif

                <tr><td>{{$tag->id}}</td><td>{{ $tag->title }}
                    </td><td>{{$tag->slug}}</td><td>{{$tag->created_at}}</td><td>{{$tag->updated_at}}</td><td><form action="/tag/{{$tag->id}}/delete" method="get">
                            <input type="submit" value="удалить"></form></td><td><form action="/tag/{{$tag->id}}/update" method="get">
                            <input type="submit" value="изменить"></form></td></tr>

                @if ($loop->last)
            </table>
        @endif
    @empty
        <p>no tags</p>
    @endforelse
    @include('paginator',['pages'=>$tags])

@endsection
