@extends('layout')

@section('title', 'tags')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
@include('message')

@section('content')
    @forelse($tags as $tag)
        @if ($loop->first)
            <div class="conteiner">
                <div class="table table-striped">
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
                        <li class="col">{{$tag->id}}</li>
                        <li class="col">{{ $tag->title }}</li>
                        <li class="col">{{$tag->slug}}</li>
                        <li class="col">{{$tag->created_at}}</li>
                        <li class="col">{{$tag->updated_at}}</li>
                        <li class="col col-item">
                            <form action="/tag/{{$tag->id}}/" method="post">@csrf @method('DELETE')
                                <input type="submit" class="button" value="удалить">
                            </form>
                        </li>
                        <li class="col col-item">
                            <form action="{{route('tag.edit',$tag)}}" method="get">
                                <input type="submit" class="button" value="изменить">
                            </form>
                        </li>
                    </ul>


                    @if ($loop->last)
                </div>

            </div>
        @endif
    @empty
        <p>no tags</p>
    @endforelse


    @include('paginator',['pages'=>$tags])

@endsection
