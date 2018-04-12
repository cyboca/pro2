

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
            <?php echo Form::open(['method'=>'POST','url'=>'/user/login']); ?>

            <!--- Email Field --->
                <div class="form-group">
                    <?php echo Form::label('email', 'Email:'); ?>

                    <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

                </div>
                <!--- Password Field --->
                <div class="form-group">
                    <?php echo Form::label('password', 'Password:'); ?>

                    <?php echo Form::password('password', ['class' => 'form-control']); ?>

                </div>
                <!-- 提交 -->
                <?php echo Form::submit('登录',['class' => 'btn btn-primary form-control']); ?>

                <div>
                    <?php if($errors->any()): ?>
                        <ul class="list-group">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item list-group-item-danger"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>