@extends('temp')

@section('title', 'my home')

@section('sidebar')
    @parent
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="index">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                @if(Session::get('username')!="")
                    {{--<a href="home"><li>welcome {{Session::get('username')}}</li></a>--}}
                    <li id="showaccounts">show my accounts</li>
                    <li id="deploywebsite">deploy my website</li>
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

@section('content')
    <div class="iframe-wrapper">
        <iframe id="iframe" src="http://192.168.27.210/websites/{{Session::get('username')?Session::get('username'):'404.html'}}" scrolling="auto" frameborder="0">

        </iframe>
    </div>
@endsection

