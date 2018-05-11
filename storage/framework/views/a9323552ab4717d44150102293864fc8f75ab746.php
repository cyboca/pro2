<?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p><?php echo e($manager['username']); ?></p>
    <p><?php echo e($manager['id']); ?></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>