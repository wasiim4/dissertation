<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<head>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/register.css')); ?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footer.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style4.css')); ?>">

    
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
            <h1 style="text-align:center;  margin-bottom: -1%;">Compose Mail</h1>
        </div>
    </div>
</div>
<br>
<?php if(Session::has('message')): ?>
	<div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<form method="POST" action="<?php echo e(route('send.party.mail')); ?>" id="frmAddUser"  files="true" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <fieldset class="addUserFieldset">
            <legend class="addUserLegend">Send Mail</legend>
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
               
                        <br><br>
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="inputSender">From</label>
                            <input type="email" required class="form-control" disabled name="inputSender" value="ptnk123456@gmail.com"  autofocus>                         
                        </div>
                    <div class="form-group col-md-4">
                            <label for="inputRecipient">To</label>
                            <select name="inputRecipient" id="inputRecipient" class="form-control input-lg dynamic" >
                                    <option value="">Select recipient</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?><?php echo"-"?><?php echo e($user->roles); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $rgds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rgd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($rgd->id); ?>"><?php echo e($rgd->id); ?><?php echo"-"?><?php echo e($rgd->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>                       
                            </div>
    
                        <div class="form-group col-md-4">
                                <label for="inputSubject">Subject</label>
                                <input type="text" required class="form-control" name="inputSubject" value="<?php echo e(old('inputSubject')); ?>"  autofocus>                         
                         
                                </div>
                    
                 </div>
    
                 
    
                 <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="inputBody">Body</label>
                      <textarea rows="5" cols="100" type="text" required  class="form-control" name="inputBody" value="<?php echo e(old('inputBody')); ?>"  ></textarea>                  
                    </div>
                     
                </div>
                
    
                <div class="row">
                        <div class="col-5">
                        </div>
                        <div class="col-4">
                        <label for="inputFiles" style="text-align:center !important;"><i class="fas fa-paperclip"></i> Attach File</label>
                        <input type="file" name="inputAttachment" >
                        </div>
                        <div class="col-3"></div>
                       </div>
          
    <br>
               <div class="form-row">
                <div class="col-4">
                </div>
                <div class="col-4">
                <input type="submit" name="btnSubmit" class="btn btn-success btn-block " value="Send Mail">
                </div>
                <div class="col-4"></div>
               </div>
            
        </fieldset>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>