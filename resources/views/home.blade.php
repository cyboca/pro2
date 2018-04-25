@extends('temp')

@section('title', 'my home')

@section('divs')
    @parent
    <div id="accounts" class="floatTop">
        <div class="shadow"></div>
        <img id="closeButton" onClick="closeaccounts()" class="close" src="{{URL::asset('/img/close_black.png')}}"/>
        <div class="signInterface">
            <h1>accounts</h1>
            <div class="inputGroup">
                <input readonly="readonly" class="accountUser" id="mysqluser" value="tom">
                <input id="mysqlpass" readonly="readonly" type="password" class="accountPass" value="mysql password">
                <img id="mysqlvisible" class="visible" src="{{URL::asset('/img/visible.png')}}" onclick="mysqlchange()"/>

                <input readonly="readonly" class="accountUser" id="ftpuser" value="tom">
                <input id="ftppass" readonly="readonly" type="password" class="accountPass" value="ftp password">
                <img id="ftpvisible" class="visible" src="{{URL::asset('/img/visible.png')}}" onclick="ftpchange()"/>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @parent

    <div name="sidebar">
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="index">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                @if(Session::get('check') == 1)
                    {{--<a href="home"><li>welcome {{Session::get('username')}}</li></a>--}}
                    <li id="showaccounts">show my accounts</li>
                        @if($space!=0)
                            <a href="decompressFile"><li id="decompressFile">decompress file</li></a>
                            <li id="buildWebsite" onclick="showBuild()">build my website</li>
                            <a href="restartContainer"><li id="restartContainer">restart container</li></a>
                            <a href="deleteContainer"><li id="deleteContainer">delete container</li></a>
                        @else
                            <li id="addspace" onclick="showspaces()">add a space</li>
                        @endif
                    <a href="logout"><li>logout</li></a>
                @else
                    <li>show users</li>
                    <li>manager users</li>
                    <a href="logout"><li>logout</li></a>
                @endif
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>


@endsection

@if(Session::get('status')>-1)
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

    <div id="chosespacediv" class="floatTop">
        <div class="shadow"></div>
        <img id="closeButton" onClick="closespaces()" class="close" src="{{URL::asset('/img/close_black.png')}}"/>
        <div class="signInterface">
            <h1>加入空间</h1>
            <div class="inputGroup">
                <form id="spaces" method="post" action="chosespace">
                    {{csrf_field()}}
                    <select name="chosedspace">
                        @foreach($spaces as $space)
                            <option value="{{$space['id']}}">{{$space['username']}}</option>
                        @endforeach
                    </select>
                    <button type="submit">确定</button>
                </form>
            </div>
        </div>
    </div>

    <div id="buildDiv" class="floatTop">
        <div class="shadow"></div>
        <img id="closeButton" onClick="closeBuild()" class="close" src="{{URL::asset('/img/close_black.png')}}"/>
        <div class="signInterface">
            <h1>构建容器</h1>
            <div class="inputGroup">
                <form id="buildForm" method="post" action="buildContainer">
                    {{csrf_field()}}
                    <select name="choseImg" class="spaceSelect">
                        <option value="1">nginx-fpm7</option>
                        <option value="2">nginx-fpm5</option>
                        <option value="3">tomcat7-jre7</option>
                        <option value="4">tomcat7-jre8</option>
                        <option value="4">tomcat8-jre7</option>
                        <option value="4">tomcat8-jre8</option>
                    </select>
                    <button type="submit">确定</button>
                </form>
            </div>
        </div>
    </div>

@endif

@section('content')
    <div class="iframe-wrapper">
        <iframe id="iframe" src="http://192.168.27.210:{{Session::get('port')?Session::get('port'):'80/websites/404.html'}}" scrolling="auto" frameborder="0">

        </iframe>
    </div>
@endsection

