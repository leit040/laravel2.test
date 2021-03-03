@extends('layout')

@section('title', 'Categories')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
@include('message')

@section('content')
    @forelse($categories as $category)
        @if ($loop->first)
            <div class="conteiner">
                <div  class="table table-striped">
                    <ul class="block__list">
                        <li class="col">#</li>
                        <li class="col">Title</li>
                        <li class="col">Slug</li>
                        <li class="col">Create at</li>
                        <li class="col">Updated at</li>
                        <li class="col col-item">Delete</li>
                        <li class="col col-item">Update</li>
                    </ul>
                    @yield('message')
                    @endif

                    <ul class="block__list block__list-other">
                        <li class="col">{{$category->id}}</li>
                        <li class="col">{{ $category->title }}</li>
                        <li class="col">{{$category->slug}}</li>
                        <li class="col">{{$category->created_at}}</li>
                        <li class="col">{{$category->updated_at}}</li>
                        <li class="col col-item">
                            <form action="/category/{{$category->id}}/" method="post">@csrf @method('DELETE')
                                <input type="submit" class="button" value="удалить">
                            </form>
                        </li>
                        <li class="col col-item">
                            <form action="{{route('category.edit',$category)}}" method="get">
                                <input type="submit" class="button" value="изменить">
                            </form>
                        </li>
                    </ul>




                @if ($loop->last)
                </div>

            </div>
        @endif
    @empty
        <p>no categories</p>
    @endforelse


    @include('paginator',['pages'=>$categories])

@endsection
