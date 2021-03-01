@section ('paginator')

    @if($pages->currentPage()!==1)   {{--больше одной страницы--}}
    <a href="{{$link_main ?? '' ?? ''}}{{$pages->previousPageUrl()}}" class="link-dark">@php echo"<<" @endphp Prev...</a>
    @endif

    {{--особый случай 1 - только одна страница--}}
    @if($pages->currentPage()===$pages->lastPage()&& $pages->onFirstPage())
        <a href="">1</a>

    @else
        @if($pages->lastPage()-1==1)


            @foreach($pages->getUrlRange(1,  2) as $num=>$link)
                @if($num==$pages->currentPage())
                    <a href="{{$link_main ?? '' }}{{$link}}" class="link-danger"><b>{{$num}}</b></a>
                @else
                    <a href="{{$link_main ?? '' }}{{$link}}">{{$num}}</a>
                @endif

            @endforeach

        @else

                    @if($pages->currentPage()>3)  {{--дальше 3 страницы показываем ссылку на 1--}}
                    <a href="{{$link_main ?? ''}}{{$pages->url(1)}}">1...</a>
                    @endif


                    @if($pages->currentPage()!=1 && $pages->currentPage()!=$pages->lastPage()  )  {{--текущая страница не первая и не последняя--}}
                    @foreach($pages->getUrlRange($pages->currentPage()-1, $pages->currentPage() + 1) as $num=>$link)
                        @if($num==$pages->currentPage())
                            <a href="{{$link_main ?? '' }}{{$link}}" class="link-danger"><b>{{$num}}</b></a>
                        @else
                            <a href="{{$link_main ?? '' }}{{$link}}">{{$num}}</a>
                        @endif

                    @endforeach

                    @else
                        @if($pages->currentPage()==1   )  {{--текущая страница первая,выводим с первой по третью--}}
                        @foreach($pages->getUrlRange(1, $pages->currentPage() + 2) as $num=>$link)
                            @if($num==$pages->currentPage())
                                <a href="{{$link_main ?? '' }}{{$link}}" class="link-danger"><b>{{$num}}</b></a>
                            @else
                                <a href="{{$link_main ?? '' }}{{$link}}">{{$num}}</a>
                            @endif


                        @endforeach
                        @else  {{--иначе она значит последняя и от нее выводим  --}}
                        @foreach($pages->getUrlRange($pages->lastPage()-2, $pages->lastPage()) as $num=>$link)
                            @if($num==$pages->currentPage())
                                <a href="{{$link_main ?? '' }}{{$link}}" class="link-danger"><b>{{$num}}</b></a>
                            @else
                                <a href="{{$link_main ?? '' }}{{$link}}">{{$num}}</a>
                            @endif

                        @endforeach
                    @endif

        @endif
    @endif
        @if($pages->currentPage()!==$pages->lastPage())
            @if($pages->currentPage()!=$pages->lastPage()-1 && $pages->currentPage()!=1)
            <a href="{{$link_main ?? '' }}{{$pages->url($pages->lastPage())}}">...{{$pages->lastPage()}}</a>
            @endif
            <a href="{{$link_main ?? ''}}{{$pages->nextPageUrl()}}" class="link-dark">...Next>></a>

           @endif
    @endif
@endsection
