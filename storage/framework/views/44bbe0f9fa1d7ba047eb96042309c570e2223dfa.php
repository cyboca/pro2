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
                    <a href="home"><li>welcome <?php echo e(Session::get('username')); ?></li></a>
                    <a href="logout"><li>logout</li></a>
                <?php else: ?>
                    <li data-toggle="modal" data-target="#myLogin"">login</li>
                    <li onclick="showRegisterWindow()">register</li>
                <?php endif; ?>
            </ul>
        </aside>
        <div id='wrap' class="alert">
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

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
<?php $__env->startSection('content'); ?>
    <table class="bordered">
        <tr>
            <th>#</th>
            <th>Deployed Website</th>
            <th>User</th>
        </tr>
        <?php if(isset($users)): ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e($user->id); ?></th>
                <th><a href='<?php echo e("http://192.168.27.210/websites/".$user->username); ?>' target="_blank"><?php echo e("http://192.168.27.210/websites/".$user->username); ?></a></th>
                <th><?php echo e($user->username); ?></th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <p>users not found</p>
        <?php endif; ?>
    </table>
    <div class="paginationdiv">
        <?php echo $users->render(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('temp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>