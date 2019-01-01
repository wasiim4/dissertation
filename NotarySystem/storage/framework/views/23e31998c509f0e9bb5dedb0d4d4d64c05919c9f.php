<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
     
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/register.css')); ?>"> 
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/addUser.png')); ?>" />
    <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
    <style>
        .header {
            width: 97.2%;
            margin-left:1.5%;
            background-color: #17a2b8;
            color: #ffffff;
            padding: 0px;
            font-size: 5px !important;
        }

    </style> 
</head>
   
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="header">
        <div class="col-12">
        <h1 style="text-align:center;  margin-bottom: -1%;">Contract Generation</h1>
        </div>
    </div>
    </div>

<form method="POST" action="<?php echo e(route('createWord')); ?>" id="frmAddUser">
    <?php echo csrf_field(); ?>
    <fieldset class="addUserFieldset">
        <legend class="addUserLegend">Contract</legend>
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
                    <label for="inputSellerId">Seller ID</label>
                    <select name="inputSellerId" id="inputSellerId" class="form-control input-lg dynamic" >
                        <option value="">Select id</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>                
                    </div>
                <div class="form-group col-md-4">
                        <label for="inputBuyerId">Buyer ID</label>
                        <select name="inputBuyerId" id="inputBuyerId" class="form-control input-lg dynamic" >
                            <option value="">Select id</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>                       
                        </div>

                    <div class="form-group col-md-4">
                            <label for="inputPropertyId">Property ID</label>
                            <select name="inputPropertyId" id="inputPropertyId" class="form-control input-lg dynamic" >
                                <option value="">Select id</option>
                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($property->propertyId); ?>"><?php echo e($property->propertyId); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>                          
                            </div>
                
             </div>

             <div class="form-row">
                
                <div class="form-group col-md-6">
                    <label for="input2ndRegDate">Second Regristration Date</label>
                    <input type="text" required class="form-control" name="input2ndRegDate" value="<?php echo e(old('input2ndRegDate')); ?>"  autofocus>      
                </div>
                <div class="form-group col-md-6">
                        <label for="input2ndTVNum">Second Transcription Volume Number</label>
                        <input type="text" required class="form-control" name="input2ndTVNum" value="<?php echo e(old('input2ndTVNum')); ?>"  autofocus>      
                </div>
             </div>

             <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputSurveyorDescription">Land Surveyor Description(Optional)</label>
                  <textarea rows="5" cols="100" type="text" required  class="form-control" name="inputSurveyorDescription" value="<?php echo e(old('inputSurveyorDescription')); ?>"  ></textarea>                  
                </div>
                 
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputClauses">Clauses</label>
                  <textarea rows="5" cols="100" type="text" required  class="form-control" name="inputClauses" value="<?php echo e(old('inputClauses')); ?>"  ></textarea>                  
                </div>
                 
            </div>
      

           <div class="form-row">
            <div class="col-4">
            
            
            

        </div>
            <div class="col-4">
            <input type="submit" name="btnSubmit" class="btn btn-success btn-block " value="Download Contract">
            </div>
            <div class="col-4"></div>
           </div>
        </div>
    </fieldset>
</form>
<?php $__env->stopSection(); ?>

</html>
<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>