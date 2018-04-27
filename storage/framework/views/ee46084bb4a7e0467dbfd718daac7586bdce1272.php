<html>
<head>
    <?php $__env->startSection('script'); ?>
    <?php echo $__env->yieldSection(); ?>
    <?php $__env->startSection('style'); ?>
    <?php echo $__env->yieldSection(); ?>

    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/table.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/menu.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/pagination.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/reset.css')); ?>">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/clickEvent.js')); ?>" charset="utf-8"></script>

</head>
<body>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


<?php $__env->startSection('divs'); ?>
<?php echo $__env->yieldSection(); ?>

<div class="main" id="main">
<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->yieldSection(); ?>
<div>
    <?php echo $__env->yieldContent('content'); ?>
</div>
</div>
</body>
</html>