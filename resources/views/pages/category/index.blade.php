@extends('layout')

@section('title', 'Categories')
@include('message')
@yield('message')
@section('content')
    @forelse($categories as $category)
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

                <tr><td>{{$category->id}}</td><td>{{ $category->title }}
                    </td><td>{{$category->slug}}</td><td>{{$category->created_at}}</td><td>{{$category->updated_at}}</td><td><form action="/category/{{$category->id}}" method="post"> @csrf @method('DELETE')
                            <input type="submit" value="удалить"></form></td><td><form action="{{route('category.edit',$category)}}" method="get">
                            <input type="submit" value="изменить"></form></td></tr>

                @if ($loop->last)
            </table>
        @endif
    @empty
        <p>no categories</p>
    @endforelse
  {{--  {!! $categories->links() !!}--}}

    @include('paginator',['pages'=>$categories])

@endsection
