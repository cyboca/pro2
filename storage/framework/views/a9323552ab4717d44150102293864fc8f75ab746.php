<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 模态框（Modal）插件</title>
    <script src="<?php echo e(URL::asset('/js/jquery.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/my.css')); ?>">
    <script src="<?php echo e(URL::asset('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/clickEvent.js')); ?>"></script>

</head>
<body>
<button class="btn" data-toggle="modal" data-target="#delcfmModel">弹出</button>
<!-- 信息删除确认 -->
<div class="modal fade" id="delcfmModel">
    <div class="modal-dialog">
        <div class="modal-content message_align">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">提示信息</h4>
            </div>
            <div class="modal-body">
                <p>您确认要删除吗？</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="url"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <a  onclick="urlSubmit()" class="btn btn-success" data-toggle="modal" data-target="#showBuildContainer">确定</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

                <form id="buildForm" class="form-horizontal" method="post" action="buildContainer" onsubmit="return confirmBuild()">
                    <?php echo e(csrf_field()); ?>

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
                        <button class="spaceSubmit btn btn-primary" type="submit">确定</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
</html>