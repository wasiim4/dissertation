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
<form method="POST" action="<?php echo e(route('generate.partage')); ?>" id="frmAddUser" files="true" enctype="multipart/form-data">
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
                <div class="col-4">
                    <label>Partageant</label>
                    <select name="inputPartegeantId" id="inputPartegeantId" class="form-control " >
                        <option value="">Select name</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?><?php echo"-"?><?php echo e($user->roles); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>                
                </div>
                <div class="col-4">
                    <label>Main Co-Partageant</label>
                    <select name="inputMPartegeantId" id="inputMPartegeantId" class="form-control "  >
                        <option value="">Select co-partegeants</option>
                        <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($child->id); ?>"><?php echo e($child->id); ?><?php echo"-"?><?php echo e($child->firstname); ?><?php echo" "?><?php echo e($child->lastname); ?><?php echo"-"?><?php echo e($child->roles); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>                  </div>
                <div class="col-4">
                    <label>Co-partegeants</label>
                    <select name="inputCPartegeantId[]" id="inputCPartegeantId" class="form-control "  multiple="multiple" >
                        <option value="">Select co-partegeants</option>
                        <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($child->id); ?>"><?php echo e($child->id); ?><?php echo"-"?><?php echo e($child->firstname); ?><?php echo" "?><?php echo e($child->lastname); ?><?php echo"-"?><?php echo e($child->roles); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>                
                </div>

               
                
                </div>
                <br>
                <div class="row">
                    <div class="col-12" style="text-align:center; text-decoration: underline;">WITNESS 1</div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="inputWitness1FirstName">First Name</label>
                        <input type="text"  class="form-control" name="inputWitness1FirstName" value="<?php echo e(old('inputWitness1FirstName')); ?>"  autofocus  placeholder="First Name">
                       
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputWitness1LastName">Last Name</label>
                        <input type="text"  class="form-control" name="inputWitness1LastName" value="<?php echo e(old('inputWitness1LastName')); ?>"  autofocus  placeholder="First Name">
                       
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputWitness1Title">Title</label>
                        <select  name="inputWitness1Title" class="form-control">
                        <option selected>Madame</option>
                        <option>Monsieur</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputWitness1Address">Address</label>
                        <textarea rows="1" cols="50" type="text"   class="form-control" name="inputAddress" value="<?php echo e(old('inputAddress')); ?>"  ></textarea>
                       
                      </div>  
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="inputWitness1Dob">Date of Birth</label>
                        <input type="date"   class="form-control " name="inputWitness1Dob" value="<?php echo e(old('inputWitness1Dob')); ?>"  autofocus  placeholder="Date of Birth"> 
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputWitness1BcNum">Birth Certificate Number</label>
                        <input type="number"   class="form-control " name="inputWitness1BcNum" value="<?php echo e(old('inputWitness1BcNum')); ?>"  autofocus  placeholder=""> 
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputDistrict">District Issued</label>
                        <select  name="inputWitness1District" class="form-control">
                        <option selected>Port Louis</option>
                        <option>Moka</option>
                        <option>Flacq</option>
                        <option>Grand Port</option>
                        <option>Pamplemousses</option>
                        <option>Plaine Wilhems</option>
                        <option>Rivière du Rempart</option>
                        <option>Rivière Noire</option>
                        <option>Savanne</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputWitness1Profession">Profession</label>
                        <input type="text"   class="form-control" name="inputWitness1Profession" value="<?php echo e(old('inputWitness1Profession')); ?>"  >
                </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12" style="text-align:center; text-decoration: underline;">WITNESS 2</div>                    
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="inputWitness2FirstName">First Name</label>
                        <input type="text"  class="form-control" name="inputWitness2FirstName" value="<?php echo e(old('inputWitness2FirstName')); ?>"  autofocus  placeholder="First Name">
                       
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputWitness2LastName">Last Name</label>
                        <input type="text"  class="form-control" name="inputWitness2LastName" value="<?php echo e(old('inputWitness2LastName')); ?>"  autofocus  placeholder="First Name">
                       
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputWitness2Title">Title</label>
                        <select  name="inputWitness2Title" class="form-control">
                        <option selected>Madame</option>
                        <option>Monsieur</option>
                        </select>
                    </div>  
                    <div class="form-group col-md-3">
                        <label for="inputWitness2Address">Address</label>
                        <textarea rows="1" cols="50" type="text"   class="form-control" name="inputAddress" value="<?php echo e(old('inputAddress')); ?>"  ></textarea>
                       
                      </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="inputWitness2Dob">Date of Birth</label>
                        <input type="date"   class="form-control " name="inputWitness2Dob" value="<?php echo e(old('inputWitness2Dob')); ?>"  autofocus  placeholder="Date of Birth"> 
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputWitness2BcNum">Birth Certificate Number</label>
                        <input type="number"   class="form-control " name="inputWitness2BcNum" value="<?php echo e(old('inputWitness2BcNum')); ?>"  autofocus  placeholder=""> 
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputDistrict">District Issued</label>
                        <select  name="inputWitness2District" class="form-control">
                        <option selected>Port Louis</option>
                        <option>Moka</option>
                        <option>Flacq</option>
                        <option>Grand Port</option>
                        <option>Pamplemousses</option>
                        <option>Plaine Wilhems</option>
                        <option>Rivière du Rempart</option>
                        <option>Rivière Noire</option>
                        <option>Savanne</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputWitness2Profession">Profession</label>
                        <input type="text"   class="form-control" name="inputWitness1Profession" value="<?php echo e(old('inputWitness1Profession')); ?>"  >
                </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Generate Contract">
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