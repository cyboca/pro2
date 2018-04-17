<html>
<head>
    <title>this is managers page</title>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/css.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/table.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/menu.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/gh-buttons.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/prettify.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/reset.css')); ?>">
    <script src="<?php echo e(URL::asset('js/prettify.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/clickEvent.js')); ?>"></script>
</head>
<body>
<div id="addUser" class="floatTopRegister">
    <div class="shadow"></div>
    <img id="closeButtonImg" onClick="managerCloseWindow()" class="close" src="<?php echo e(URL::asset('/img/close_black.png')); ?>"/>
    <div class="managerRegisterInterface reigsterInterface">
        <h1>添加租户</h1>
        <div class="inputGroup">
            <form name="register" method="post" action="managerregister">
                <?php echo e(csrf_field()); ?>

                <input type="text" value="" id="reg_username" name="username" class="Input" placeholder="姓名">
                <!--
                <input type="text" value="" name="phone" class="Input" placeholder="手机号">
                -->
                <input type="text" value="" id="reg_password" name="password" class="Input" placeholder="密码">
                <input type="text" value="" id="reg_space" name="space" class="Input" onkeypress="return event.keyCode>=48&&event.keyCode<=57" placeholder="空间 默认1000Mb">
                <input type="submit" value="添加" name="submit" class="signInButton"/>
            </form>
        </div>
    </div>
</div>
<?php if(Session::get('status')!=0): ?>
    <div class="alert">
        <input class="fire-check" type="checkbox" checked="checked">
        <section>
            <div class="tn-box tn-box-color-1">
                <p><?php echo e(Session::get('msg')); ?></p>
                <div class="tn-progress"></div>
            </div>
        </section>
    </div>
<?php else: ?>
    <div class="alert">
        <input class="fire-check" type="checkbox">
        <section>
            <div class="tn-box tn-box-color-1">

            </div>
        </section>
    </div>
<?php endif; ?>
<div id="main">
    <div>
            <input type='checkbox' id='sidemenu'>
            <aside>
                <h2><a class="menua" href="backend">Main Page</a></h2>
                <br/>
                <ul id="sideul">
                    <li onclick="showAddUser()">create manager</li>
                    <li onclick="showDeleteUser">delete managers</li>
                    <li onclick="showModifyUser">modify maangers</li>
                    <a href="adminlogout"><li>logout</li></a>
                </ul>
            </aside>
            <div id='wrap'>
                <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
                <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
            </div>
        </div>
    <div>
            <table class="bordered">
                <tr>
                    <th>id</th>
                    <th>租户</th>
                    <th>用户数</th>
                </tr>
                <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e($manager['id']); ?></th>
                        <th><?php echo e($manager['username']); ?></th>
                        <th><?php echo e($manager['users']); ?></th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <button name="adduser" class="button" type="button" onclick="showAddUser()">添加租户</button>
        </div>
</div>
</body>
</html>