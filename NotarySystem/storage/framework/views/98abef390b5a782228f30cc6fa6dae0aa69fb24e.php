<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<head>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footer.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style4.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/register.css')); ?>"> 

    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

       <style>
       .header {
        width: 97.2%;
        margin-left:1.5%;
        background-color: #17a2b8;
        color: #ffffff;
        padding: 5px;
        font-size: 5px !important;
    }

       </style> 

</head>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="header">
        <div class="col-12">
            <h1 style="text-align:center;  margin-bottom: -1%;">Add Children</h1>
        </div>
    </div>
</div>
<div class="row">
<form method="POST" action="<?php echo e(route('add.num.children')); ?>" id="frmAddUser" files="true" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <fieldset class="addUserFieldset">
        <legend class="addUserLegend">Children</legend>
        <div class="container">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-6">
                    <label>Client Name</label>
                    <select name="inputParentId" id="inputParentId" class="form-control " >
                        <option value="">Select name</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?><?php echo"-"?><?php echo e($user->roles); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>                
                </div>
                <div class="col-6">
                    <label>Number of Children</label>
                    <input type="number"  id="numOfChildren"  name="numOfChildren" class="form-control" >
                </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Add Children">
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
            
    </fieldset>
    
</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>