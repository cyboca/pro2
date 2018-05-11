<?php $__env->startSection('title', 'my index page'); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/bootstrap.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    ##parent-placeholder-19bd1503d9bad449304cc6b4e977b74bac6cc771##
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="index">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <?php if(Session::get('username')!=""): ?>
                    <a href="home" class="menua"><li><?php echo e(Session::get('username')); ?></li></a>
                    <a href="logout" class="menua"><li>logout</li></a>
                <?php else: ?>
                    <li data-toggle="modal" data-target="#myLogin">login</li>
                    <li data-toggle="modal" data-target="#myRegister">register</li>
                <?php endif; ?>
            </ul>
        </aside>
        <div id='wrap' class="alertx">
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php if(Session::get('status')>-1): ?>
    <div class="alertx">
        <input class="fire-check" type="checkbox" checked="checked">
        <section>
            <div class="tn-box tn-box-color-1">
                <p><?php echo e(Session::get('msg')); ?></p>
                <div class="tn-progress"></div>
            </div>
        </section>
    </div>
    <?php else: ?>
    <div class="alertx">
        <input class="fire-check" type="checkbox">
        <section>
            <div class="tn-box tn-box-color-1">

            </div>
        </section>
    </div>
<?php endif; ?>

<?php $__env->startSection('divs'); ?>
    <!-- 登录 -->
    <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myLoginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myLoginLabel">
                        login
                    </h4>
                </div>
                <div class="modal-body smallModal">
                    <form name="sign" method="post" class="form-horizontal" action="login">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-2" for="username">用户名</label>
                                <div class="col-sm-6">
                                    <input type="text" value="" name="username" class="form-control" placeholder="用户名">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2">
                               <label class="col-sm-2" for="password">密码</label>
                               <div class="col-sm-6">
                                   <input type="password" value="" name="password" class="form-control" placeholder="密码">
                               </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="radio radio-inline col-md-offset-4">
                                <label>
                                    <input type="radio" name="demo-radio" value="1" checked="checked">
                                    <span class="demo-radioInput"></span>用户
                                </label>
                            </div>

                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="demo-radio" value="0">
                                    <span class="demo-radioInput"></span>管理员
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <input type="submit" name="submit" value="登录" class="btn btn-default btn-block"/>
                            </div>
                        </div>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <!-- 注册 -->
    <div class="modal fade" id="myRegister" tabindex="-1" role="dialog" aria-labelledby="myRegisterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myRegisterLabel">
                        register
                    </h4>
                </div>
                <div class="modal-body smallModal">
                    <form name="register" method="post" class="form-horizontal" action="register">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-2" for="username">用户名</label>
                                <div class="col-sm-6">
                                    <input type="text" value="" name="username" class="form-control" placeholder="用户名">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2">
                                <label class="col-sm-2" for="password">密码</label>
                                <div class="col-sm-6">
                                    <input type="password" value="" name="password" class="form-control" placeholder="密码">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="submit" value="注册" class="btn btn-default btn-block"/>
                            </div>
                        </div>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-6 content">
        <div class="title m-b-md">
           Welcome to cyboca virtualhost
        </div>

        
            
                
                
                
            
            
                
                    
                        
                        
                        
                    
                
            
                
            
        
        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('temp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>