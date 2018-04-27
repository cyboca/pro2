@extends('temp')

@section('title', 'my home')

@section('script')
    <script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
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
                    <li id="showaccounts" data-toggle="modal" data-target="#myModal">show my accounts</li>
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
                    <li>welcome {{Session::get('username')}}</li>
                    {{--<li>show users</li>--}}
                    {{--<li>manager users</li>--}}
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
@endif

@section('divs')

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        accounts
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="inputGroup">

                            <div class="control-group">
                                <label class="control-label" for="mysqluser">mysql user</label>
                                <div class="controls">
                                    <input readonly="readonly" type="text" class="span2" id="mysqluser" value="tom">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="mysqlpass">mysql password</label>
                                <div class="controls">
                                    <input id="mysqlpass" readonly="readonly" type="password" class="span2" value="mysql password">
                                    <img id="mysqlvisible" class="visible" src="{{URL::asset('/img/visible.png')}}" onclick="mysqlchange()"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ftpuser">ftp user</label>
                                <div class="controls">
                                    <input id="ftpuser" readonly="readonly" type="text" class="span2" value="ftp user">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="ftppass">ftp password</label>
                                <div class="controls">
                                    <input id="ftppass" readonly="readonly" type="password" class="span2 " value="ftp password">
                                    <img id="ftpvisible" class="visible" src="{{URL::asset('/img/visible.png')}}" onclick="ftpchange()"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    @parent
@endsection

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
                <form id="buildForm" method="post" action="buildContainer" onsubmit="return confirmBuild()">
                    {{csrf_field()}}
                    <div class="form-group">
                        <select name="choseImg" class="spaceSelect form-control">
                            <option value="0">nginx</option>
                            <option value="1">nginx-fpm7</option>
                            <option value="2">nginx-fpm5</option>
                            <option value="3">tomcat7-jre7</option>
                            <option value="4">tomcat7-jre8</option>
                            <option value="5">tomcat8-jre7</option>
                            <option value="6">tomcat8-jre8</option>
                        </select>
                    </div>
                    <button class="spaceSubmit btn btn-primary" type="submit">确定</button>
                </form>
            </div>
        </div>
    </div>


@section('content')
    @if(Session::get('check')==1)
        <div class="iframe-wrapper">
            <iframe id="iframe" src="http://192.168.27.210:{{Session::get('port')?Session::get('port'):'80/websites/404.html'}}" scrolling="auto" frameborder="0">
            </iframe>
        </div>
    @else
        <table class="bordered">
            <tr>
                <th>#</th>
                <th>Deployed Website</th>
                <th>Image</th>
                <th>User</th>
            </tr>
            @if(isset($users))
                @foreach($users as $user)
                    <tr>
                        <th>{{$user->id}}</th>
                        <th><a href='{{"http://192.168.27.210:".$user->port}}' target="_blank">{{"http://192.168.27.210:".$user->port}}</a></th>
                        <th>{{$user->image}}</th>
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
    @endif
@endsection

