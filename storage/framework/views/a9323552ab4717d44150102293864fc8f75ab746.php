<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 模态框（Modal）插件</title>
    <script src="<?php echo e(URL::asset('/js/jquery.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/bootstrap.css')); ?>">
    <script src="<?php echo e(URL::asset('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/clickEvent.js')); ?>"></script>

</head>
<body>

<h2>创建模态框（Modal）</h2>
<!-- 按钮触发模态框 -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    开始演示模态框
</button>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    login
                </h4>
            </div>
            <div class="modal-body">
                <form name="sign" method="post" class="form-horizontal" action="login">
                    <?php echo e(csrf_field()); ?>

                    <div class="control-group col-md-6">
                        <label class="control-label" for="username">用户名</label>
                        <div class="controls">
                            <input type="text" value="" name="username" class="Input" placeholder="用户名">
                        </div>
                    </div>

                    <div class="control-group col-md-6">
                        <label class="control-label" for="password">密码</label>
                        <div class="controls">
                            <input type="password" value="" name="password" class="Input" placeholder="密码">
                        </div>
                    </div>

                    <div class="control-group span4 offset2">
                        <label class="radio inline">
                            <input type="radio" name="demo-radio" value="1" checked="checked">
                            <span class="demo-radioInput"></span>用户
                        </label>

                        <label class="radio inline">
                            <input type="radio" name="demo-radio" value="0" checked="checked">
                            <span class="demo-radioInput"></span>管理员
                        </label>
                    </div>

                    <div class="control-group span4 offset2">
                        <input type="submit" name="submit" value="登录" class="btn"/>
                        <p id="signInRegister" class="btn btn-link">没有账号，点击注册</p>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
</html>