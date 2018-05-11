

<?php $__env->startSection('title','backend'); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.knob.js')); ?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.throttle.js')); ?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.classycountdown.js')); ?>" charset="utf-8"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/my.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/default.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="backend">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <a href="spaces" class="menua"><li id="managers">manage space</li></a>
                <a href="adminlogout" class="menua"><li>logout</li></a>
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="contents">
        <table class="table table-bordered  ">
            <tr>
                <th>id</th>
                <th>租户</th>
                <th>用户数</th>
            </tr>
            <tr>
                <th>0</th>
                <th><?php echo e($managers); ?></th>
                <th><?php echo e($users); ?></th>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th>租户</th>
                <th>磁盘空间占用</th>
                <th>磁盘总空间</th>
                <th>额度</th>
            </tr>

            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($manager['spacename']); ?></th>
                    <th><?php echo e($manager['size']); ?>Mb</th>
                    <th><?php echo e($manager['limit']); ?>Mb</th>
                    <th><?php echo e($manager['size_per']); ?>%</th>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <?php echo $sizes->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('temp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>