@section('message')
@if(isset($_SESSION['message']))
    <div class="alert alert-{{$_SESSION['message']['status']}}" role="alert">
        {{$_SESSION['message']['message']}}
    </div>
    @unset($_SESSION['message'])
    @endif
@endsection
