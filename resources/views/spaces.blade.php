@extends('temp')

@section('title','spaces')

@section('script')
    <script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/my.css')}}">
@endsection

@section('sidebar')
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="backend">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <li data-toggle="modal" data-target="#createSpace">create space</li>
                <li data-toggle="modal" data-target="#confirmDelete">delete space</li>
                <li data-toggle="modal" data-target="#modifySpace">modify space</li>
                <a href="adminlogout"><li>logout</li></a>
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
    <!-- 添加空间 -->
    <div class="modal fade" id="createSpace">
        <div class="modal-dialog">
            <div class="modal-content message_align">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myLoginLabel">
                        create space
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="createSpaceForm" method="post" class="form-horizontal" action="managerregister">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-2" for="username">用户名</label>
                                <div class="col-sm-6">
                                    <input type="text" value="" name="username" class="form-control" placeholder="用户名" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-2" for="password">密码</label>
                                <div class="col-sm-6">
                                    <input type="text" value="" name="password" class="form-control" placeholder="密码">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-2" for="username">空间</label>
                                <div class="col-sm-6">
                                    <input type="text" value="" name="space" class="form-control" placeholder="空间 默认1000Mb">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="createSpaceForm" value="submit" class="btn btn-success">添加</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- 删除空间 -->
    <div class="modal fade" id="deleteSpace">
        <div class="modal-dialog">
            <div class="modal-content message_align">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myLoginLabel">
                        delete space
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="deleteSpaceForm" method="post" class="form-horizontal" action="deletespace">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-3">删除空间</label>
                                <div class="col-md-4">
                                    <select name="deleteSpaceSelect" class="form-control">
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
                    <button type="submit" form="deleteSpaceForm" class="btn btn-warning">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- 修改空间 -->
    <div class="modal fade" id="modifySpace">
        <div class="modal-dialog">
            <div class="modal-content message_align">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myLoginLabel">
                        modify space
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="modifySpaceForm" method="post" class="form-horizontal" action="modifyspace">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-3">修改空间</label>
                                <div class="col-md-4">
                                    <select name="modifySpaceSelect" class="form-control">
                                        @foreach($spaces as $space)
                                            <option value="{{$space['id']}}">{{$space['username']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-3">设置空间大小</label>
                                <div class="col-md-4">
                                    <input type="text" value="" id="modifyLimit" name="modifyLimit" class="form-control" onkeypress="return event.keyCode>=48&&event.keyCode<=57" placeholder="空间 默认1000Mb">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="modifySpaceForm" class="btn btn-success">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- 删除确认 -->
    <div class="modal fade" id="confirmDelete">
        <div class="modal-dialog">
            <div class="modal-content message_align">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">提示信息</h4>
                </div>
                <div class="modal-body">
                    <p>您确认要删除该空间吗？所有该空间下部署的容器将被删除！</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="url"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target="#deleteSpace">确定</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('content')
    <div>
        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>租户</th>
                <th>用户数</th>
            </tr>
            @foreach($spaces as $space)
                <tr>
                    <th>{{$space['id']}}</th>
                    <th>{{$space['username']}}</th>
                    <th>{{$space['users']}}</th>
                </tr>
            @endforeach
        </table>
        {!! $spaces->links() !!}
    </div>
@endsection