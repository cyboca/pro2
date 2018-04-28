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