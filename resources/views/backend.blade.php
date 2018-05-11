@extends('temp')

@section('title','backend')

@section('script')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.knob.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.throttle.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.classycountdown.js')}}" charset="utf-8"></script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/my.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/default.css')}}"/>
@endsection

@section('sidebar')
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="backend">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <a href="spaces" class="menua"><li id="managers">manage space</li></a>
                <a href="adminlogout" class="menua"><li>logout</li></a>
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
@endsection

@section('content')
    <div id="contents">
        <table class="table table-bordered  ">
            <tr>
                <th>id</th>
                <th>租户</th>
                <th>用户数</th>
            </tr>
            <tr>
                <th>0</th>
                <th>{{$managers}}</th>
                <th>{{$users}}</th>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th>租户</th>
                <th>磁盘空间占用</th>
                <th>磁盘总空间</th>
                <th>额度</th>
            </tr>

            @foreach($sizes as $manager)
                <tr>
                    <th>{{$manager['spacename']}}</th>
                    <th>{{$manager['size']}}Mb</th>
                    <th>{{$manager['limit']}}Mb</th>
                    <th>{{$manager['size_per']}}%</th>
                </tr>
            @endforeach
        </table>
        {!! $sizes->links() !!}
    </div>
@endsection