<?php $__env->startSection('title', 'my home'); ?>

<?php $__env->startSection('sidebar'); ?>
    ##parent-placeholder-19bd1503d9bad449304cc6b4e977b74bac6cc771##
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="index">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <?php if(Session::get('check') == 1): ?>
                    
                    <li id="showaccounts">show my accounts</li>
                    <li id="deploywebsite">deploy my website</li>
                    <a href="logout"><li>logout</li></a>
                <?php else: ?>
                    <li>show users</li>
                    <li>manager users</li>
                    <a href="logout"><li>logout</li></a>
                <?php endif; ?>
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="iframe-wrapper">
        <iframe id="iframe" src="http://192.168.27.210/websites/<?php echo e(Session::get('username')?Session::get('username'):'404.html'); ?>" scrolling="auto" frameborder="0">

        </iframe>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('temp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>