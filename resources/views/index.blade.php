@extends('temp')

@section('title', 'my index page')

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
                    <li onclick="showSignInWindow()">login</li>
                    <li onclick="showRegisterWindow()">register</li>
                @endif
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
@endsection

@if(Session::get('status')!=0)
    <div class="alert">
        {{Session::get('msg')}}
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
    {!! $users->render() !!}
@endsection
