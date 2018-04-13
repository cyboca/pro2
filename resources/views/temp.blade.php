<html>
<head>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/css.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/table.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/menu.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/pagination.css')}}">
    <script type="text/javascript" src="{{URL::asset('/js/clickEvent.js')}}" charset="utf-8"></script>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<div id="floatTop" class="floatTop">
    <div class="shadow"></div>
    <img id="closeButton" onClick="closeWindow()" class="close" src="{{URL::asset('/img/close_black.png')}}"/>
    <div class="signInterface">
        <h1>用户登录</h1>
        <div class="inputGroup">
            <form name="sign" method="post" action="login">
                {{ csrf_field() }}
                <input type="text" value="" name="username" class="Input" placeholder="用户名">
                <input type="password" value="" name="password" class="Input" placeholder="密码">
                <p onClick="signInRegister()" id="signInRegister" class="noAccount">没有账号，点击注册</p>
                <p class="forgetPassword">忘记密码？</p>
                <input type="submit" name="submit" value="登录" class="signInButton"/>
            </form>
        </div>
    </div>
</div>
<div id="floatTopRegister" class="floatTopRegister">
    <div class="shadow"></div>
    <img id="closeButtonImg" onClick="closeWindow()" class="close" src="{{URL::asset('/img/close_black.png')}}"/>
    <div class="signInterface reigsterInterface">
        <h1>用户注册</h1>
        <div class="inputGroup">
            <form name="register" method="post" action="register">
                {{ csrf_field() }}
                <input type="text" value="" id="reg_username" name="username" class="Input" placeholder="姓名">
                <!--
                <input type="text" value="" name="phone" class="Input" placeholder="手机号">
                -->
                <input type="text" value="" id="reg_password" name="password" class="Input" placeholder="密码">
                <input type="submit" value="注册" name="submit" class="signInButton"/>
                <p class="haveAccount">已有账号？<span onClick="registerSignIn()" id="registerSignIn">登录</span></p>
            </form>
        </div>
    </div>
</div>
<div class="main" id="main">
@section('sidebar')
@show
<div>
    @yield('content')
</div>
</div>
</body>
</html>