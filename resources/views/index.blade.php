@extends('temp')

@section('title', 'my index page')

@section('script')
    <script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
@endsection

@section('sidebar')
    @parent
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="index">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                @if(Session::get('username')!="")
                    <a href="home"><li>welcome {{Session::get('username')}}</li></a>
                    <a href="logout"><li>logout</li></a>
                @else
                    <li data-toggle="modal" data-target="#myLogin"">login</li>
                    <li onclick="showRegisterWindow()">register</li>
                @endif
            </ul>
        </aside>
        <div id='wrap' class="alert">
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
@endsection

@if(Session::get('status')!=0)
    <div class="alert">
        <input class="fire-check" type="checkbox" checked="checked">
        <section>
            <div class="tn-box tn-box-color-1">
                <p>{{Session::get('msg')}}</p>
                <div class="tn-progress"></div>
            </div>
        </section>
    </div>
    @else
    <div class="alert">
        <input class="fire-check" type="checkbox">
        <section>
            <div class="tn-box tn-box-color-1">

            </div>
        </section>
    </div>
@endif
@section('content')
    <table class="bordered">
        <tr>
            <th>#</th>
            <th>Deployed Website</th>
            <th>User</th>
        </tr>
        @if(isset($users))
        @foreach($users as $user)
            <tr>
                <th>{{$user->id}}</th>
                <th><a href='{{"http://192.168.27.210/websites/".$user->username}}' target="_blank">{{"http://192.168.27.210/websites/".$user->username}}</a></th>
                <th>{{$user->username}}</th>
            </tr>
        @endforeach
        @else
        <p>users not found</p>
        @endif
    </table>
    <div class="paginationdiv">
        {!! $users->render() !!}
    </div>
@endsection
