<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footer.css')); ?>">

    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footer.css')); ?>">
        
<?php $__env->startSection('content'); ?>

    <a class="back-btn hvr-icon-pulse" href="/dashboard"><i class="fa fa-home hvr-icon"></i> Back</a>
    <h4 class="datatableTitleUsers" style="text-align:center;">Client List</h4>
    <div class="spacor1"></div>
<div class="container tableSpacor" style="border: 4mm ridge #212529;">
<table id="tbluser" class="table table-hover " style="width:100%;">
    <thead>
        <tr>
            <th>
                First Name
            </th> 
            <th>
                Last Name
            </th>
            <th>
                Date of Birth
            </th>
            <th>
                Email-Address
            </th> 
            <th>
                Contact Number
            </th> 
            <th>
               Gender
            </th> 
            <th>
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr >
            <td>    
                <?php echo e($user->firstname); ?> 
            </td>
            <td>
                <?php echo e($user->lastname); ?>

            </td>
            <td>
                <?php echo e($user->dob); ?>

            </td>
            <td>
                <?php echo e($user->email); ?>

            </td>
            <td>
                <?php echo e($user->contactnum); ?>

            </td>
            <td>
                <?php echo e($user->gender); ?>

            </td>
            <td>
                
                    
                        <span data-toggle="tooltip" data-placement="top" style="border-bottom:none" title="show">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a> 
                
               |
                
                    
                        <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"  title="Edit">
                            <i class="fas fa-pencil-alt font-color"></i> 
                        </span>
                    </a>
                
               |
                
                
                    <?php if($user->id== Auth::id()): ?> 
                        <a class="btndelevent not-active-link disabled" href="/usersfound/delete/<?php echo e($user->id); ?>">
                            <span style="border-bottom:none" data-toggle="tooltip" data-placement="top" tabindex="1" title="Delete">
                                <i class="fas fa-trash-alt font-color"></i>
                            </span>
                        </a>
                    <?php else: ?>
                        <a class="btndelevent" href="/usersfound/delete/<?php echo e($user->id); ?>">
                            <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                                <i class="fas fa-trash-alt font-color"></i>
                            </span>
                        </a>
                    <?php endif; ?>
                
              |
                
                    
                        <span data-toggle="tooltip" data-placement="top" tabindex="1" style="border-bottom:none" title="Transactions">
                            <i class="fas fa-handshake"></i>
                        </span>
                    </a> 
                
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.userlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>