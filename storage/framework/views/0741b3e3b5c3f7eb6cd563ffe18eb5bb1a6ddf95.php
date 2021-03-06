<?php $__env->startSection('title', 'my home'); ?>

<?php $__env->startSection('divs'); ?>
    ##parent-placeholder-abfaae277dbc0dfd1cc0a2fa0033f2ebab3bcb4c##
    <div id="accounts" class="floatTop">
        <div class="shadow"></div>
        <img id="closeButton" onClick="closeaccounts()" class="close" src="<?php echo e(URL::asset('/img/close_black.png')); ?>"/>
        <div class="signInterface">
            <h1>accounts</h1>
            <div class="inputGroup">
                <input readonly="readonly" class="accountUser" id="mysqluser" value="tom">
                <input id="mysqlpass" readonly="readonly" type="password" class="accountPass" value="mysql password">
                <img id="mysqlvisible" class="visible" src="<?php echo e(URL::asset('/img/visible.png')); ?>" onclick="mysqlchange()"/>

                <input readonly="readonly" class="accountUser" id="ftpuser" value="tom">
                <input id="ftppass" readonly="readonly" type="password" class="accountPass" value="ftp password">
                <img id="ftpvisible" class="visible" src="<?php echo e(URL::asset('/img/visible.png')); ?>" onclick="ftpchange()"/>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    ##parent-placeholder-19bd1503d9bad449304cc6b4e977b74bac6cc771##

    <div name="sidebar">
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="index">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <?php if(Session::get('check') == 1): ?>
                    
                    <li id="showaccounts">show my accounts</li>
                        <?php if($space!=0): ?>
                            <a href="decompressFile"><li id="decompressFile">decompress file</li></a>
                            <li id="buildWebsite" onclick="showBuild()">build my website</li>
                            <a href="restartContainer"><li id="restartContainer">restart container</li></a>
                            <a href="deleteContainer"><li id="deleteContainer">delete container</li></a>
                        <?php else: ?>
                            <li id="addspace" onclick="showspaces()">add a space</li>
                        <?php endif; ?>
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

<?php if(Session::get('status')>-1): ?>
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

    <div id="chosespacediv" class="floatTop">
        <div class="shadow"></div>
        <img id="closeButton" onClick="closespaces()" class="close" src="<?php echo e(URL::asset('/img/close_black.png')); ?>"/>
        <div class="signInterface">
            <h1>加入空间</h1>
            <div class="inputGroup">
                <form id="spaces" method="post" action="chosespace">
                    <?php echo e(csrf_field()); ?>

                    <select name="chosedspace">
                        <?php $__currentLoopData = $spaces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($space['id']); ?>"><?php echo e($space['username']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="submit">确定</button>
                </form>
            </div>
        </div>
    </div>

    <div id="buildDiv" class="floatTop">
        <div class="shadow"></div>
        <img id="closeButton" onClick="closeBuild()" class="close" src="<?php echo e(URL::asset('/img/close_black.png')); ?>"/>
        <div class="signInterface">
            <h1>构建容器</h1>
            <div class="inputGroup">
                <form id="buildForm" method="post" action="buildContainer">
                    <?php echo e(csrf_field()); ?>

                    <select name="choseImg" class="spaceSelect">
                        <option value="1">nginx-fpm7</option>
                        <option value="2">nginx-fpm5</option>
                        <option value="3">tomcat7-jre7</option>
                        <option value="4">tomcat7-jre8</option>
                        <option value="4">tomcat8-jre7</option>
                        <option value="4">tomcat8-jre8</option>
                    </select>
                    <button type="submit">确定</button>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <div class="iframe-wrapper">
        <iframe id="iframe" src="http://192.168.27.210:<?php echo e(Session::get('port')?Session::get('port'):'80/websites/404.html'); ?>" scrolling="auto" frameborder="0">

        </iframe>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('temp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>