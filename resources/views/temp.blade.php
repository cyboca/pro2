<html>
<head>
    @section('script')
    @show
    @section('style')
    @show
    {{--<link type="text/css" rel="stylesheet" href="{{URL::asset('/css/css.css')}}"/>--}}
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/table.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/menu.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/pagination.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/reset.css')}}">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('/js/clickEvent.js')}}" charset="utf-8"></script>

</head>
<body>

@section('divs')
@show

<div class="main" id="main">
@section('sidebar')
@show
<div>
    @yield('content')
</div>
</div>
</body>
</html>