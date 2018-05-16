@extends('temp')

@section('title', 'my home')

@section('script')
    <script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/my.css')}}">
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
                    <li id="showaccounts" data-toggle="modal" data-target="#showAccounts">show my accounts</li>
                        @if($chosed_space!=0)
                            <a href="decompressFile" class="menua"><li id="decompressFile">decompress file</li></a>
                            <li id="buildWebsite" data-toggle="modal" data-target="#confirmRebuild">build my website</li>
                            <a href="restartContainer" class="menua"><li id="restartContainer">restart container</li></a>
                            <a href="deleteContainer" class="menua"><li id="deleteContainer">delete container</li></a>
                        @else
                            <li id="addspace" data-toggle="modal" data-target="#showChoseSpace">add a space</li>
                        @endif
                    <a href="logout" class="menua"><li>logout</li></a>
                @else
                    <li>welcome {{Session::get('username')}}</li>
                    <a href="logout" class="menua"><li>logout</li></a>
                @endif
            </ul>
        </aside>
        <div id='wrap' class="alertx">
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
@endsection

@if(Session::get('status')>-1)
    <div class="alertx">
        <input class="fire-check" type="checkbox" checked="checked">
        <section>
            <div class="tn-box tn-box-color-1">
                <p>{{Session::get('msg')}}</p>
                <div class="tn-progress"></div>
            </div>
        </section>
    </div>
@else
    <div class="alertx">
        <input class="fire-check" type="checkbox">
        <section>
            <div class="tn-box tn-box-color-1">
            </div>
        </section>
    </div>
@endif

@section('divs')
    <!-- 模态框 显示账号 -->
    <div class="modal fade" id="showAccounts" tabindex="-1" role="dialog" aria-labelledby="showAccountsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="showAccountsLabel">
                        accounts
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="inputGroup">

                            <div class="form-group">
                                <div class="col-md-offset-1">
                                    <label class="col-sm-4" for="mysqluser">mysql user</label>
                                    <div class="col-sm-6">
                                        <input readonly="readonly" type="text" class="form-control" id="mysqluser" value="tom">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-1">
                                    <label class="col-sm-4" for="mysqlpass">mysql password</label>
                                    <div class="col-sm-6">
                                        <input id="mysqlpass" readonly="readonly" type="password" class="form-control inputinline" value="mysql password">
                                        <img id="mysqlvisible" class="visible imgline" src="{{URL::asset('/img/visible.png')}}" onclick="mysqlchange()"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-1">
                                    <label class="col-sm-4" for="ftpuser">ftp user</label>
                                    <div class="col-sm-6">
                                        <input id="ftpuser" readonly="readonly" type="text" class="form-control" value="ftp user">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-1">
                                    <label class="col-sm-4" for="ftppass">ftp password</label>
                                    <div class="col-sm-6">
                                        <input id="ftppass" readonly="readonly" type="password" class="form-control " value="ftp password">
                                        <img id="ftpvisible" class="visible" src="{{URL::asset('/img/visible.png')}}" onclick="ftpchange()"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <!-- 选择空间 -->
    <div class="modal fade" id="showChoseSpace" tabindex="-1" role="dialog" aria-labelledby="showChoseSpaceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="showChoseSpaecLabel">
                        chose space
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="chooseSpace" class="form-horizontal" method="post" action="chosespace">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-3">选择空间</label>
                                <div class="col-md-4">
                                    <select name="chosedspace" class="form-control">
                                        @foreach($spaces as $space)
                                            <option value="{{$space['id']}}">{{$space['username']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="chooseSpace" type="submit" class="btn btn-success">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <!-- 重建容器 -->
    <div class="modal fade" id="showBuildContainer" tabindex="-1" role="dialog" aria-labelledby="showBuildContainerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="showBuildContainerLabel">
                        build container
                    </h4>
                </div>
                <div class="modal-body">

                    <form id="buildForm" class="form-horizontal" method="post" action="buildContainer">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-3">选择镜像</label>
                                <div class="col-md-4">
                                    <select name="choseImg" class="form-control">
                                        <option value="0">nginx</option>
                                        <option value="1">nginx-fpm7</option>
                                        <option value="2">nginx-fpm5</option>
                                        <option value="3">tomcat7-jre7</option>
                                        <option value="4">tomcat7-jre8</option>
                                        <option value="5">tomcat8-jre7</option>
                                        <option value="6">tomcat8-jre8</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="buildForm" class="btn btn-success" type="submit">构建容器</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <!-- 信息删除确认 -->
    <div class="modal fade" id="confirmRebuild">
        <div class="modal-dialog">
            <div class="modal-content message_align">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">提示信息</h4>
                </div>
                <div class="modal-body">
                    <p>您确认要重新构建吗？旧的容器将被删除！</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="url"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target="#showBuildContainer">确定</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @parent
@endsection

@section('content')
    <div class="col-md-6">
        @if(Session::get('check')==1)
            <div class="iframe-wrapper">
                <iframe id=iframeHome" style="width: 1024px;height: 800px;" src="http://{{Session::get('username')?Session::get('username'):'default'}}.synantera.cn" scrolling="auto" onload="changeFrameHeight()" frameborder="0">
                </iframe>
            </div>
        @else
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Deployed Website</th>
                        <th>Image</th>
                        <th>User</th>
                    </tr>
                    @if(isset($users))
                        @foreach($users as $user)
                            <tr>
                                <th>{{$user->user_id}}</th>
                                <th><a href='{{"http://".$user->username.".synantera.cn"}}' target="_blank">{{"http://".$user->username.".synantera.cn"}}</a></th>
                                <th>{{$user->image}}</th>
                                <th>{{$user->username}}</th>
                            </tr>
                        @endforeach
                    @else
                        <p>users not found</p>
                    @endif
                </table>
                {!! $users->render() !!}
            </div>

        @endif
    </div>

@endsection

