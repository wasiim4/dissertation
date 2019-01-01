<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>">
<script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
<?php $__env->startSection('content'); ?>
<body>
<div>
    <h1 style="text-align:center;">Welcome to the notary system</h1>
    <a href="/generateWord" class="btn btn-danger">Genrerate Word Document</a>
</div>
 <?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.userlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>