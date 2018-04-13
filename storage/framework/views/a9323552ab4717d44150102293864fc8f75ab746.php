<p><?php echo e(Session::get('username')); ?></p>
<p><?php echo e(Session::get('password')); ?></p>
<p><?php echo e(Session::get('type')); ?></p>
<?php if(Session::get('status')!=0): ?>
    <div class="alert">
        <?php echo e(Session::get('msg')); ?>

    </div>
<?php endif; ?>

<p><?php echo e(session('error')); ?></p>
