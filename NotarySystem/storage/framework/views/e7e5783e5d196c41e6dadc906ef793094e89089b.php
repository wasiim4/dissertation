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
            <h1 style="text-align:center;">Add Children</h1>
        </div>
    </div>
</div>
<form method="POST" action="<?php echo e(route('add.children')); ?>" id="frmAddUser">
    <?php echo csrf_field(); ?>
    <fieldset class="addUserFieldset">
        <legend class="addUserLegend">Registration</legend>
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

        </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputChildrenFirstName">First Name</label>
            <input type="text" required class="form-control" name="inputChildrenFirstName" value="<?php echo e(old('inputChildrenFirstName')); ?>"  autofocus  placeholder="First Name">
           
          </div>
        <div class="form-group col-md-4">
            <label for="inputChildrenLastName">Last Name</label>
            <input type="text" required  class="form-control" name="inputChildrenLastName" value="<?php echo e(old('inputChildrenLastName')); ?>" autofocus placeholder="Last Name">
        </div>

        <div class="form-group col-md-4">
            <label for="inputChildrenTitle">Title</label>
            <select  name="inputChildrenTitle" class="form-control">
            <option selected>Monsieur</option>
            <option>Madame</option>
            <option>Mademoiselle</option>
            </select>
        </div>
        
     </div>

    <div class="form-row">  
    <div class="form-group col-md-4">
      <label for="inputChildrenDob">Date of Birth</label>
      <input type="date"  required class="form-control " name="inputChildrenDob" value="<?php echo e(old('inputChildrentDob')); ?>"  autofocus  placeholder="Date of Birth"> 
    </div>

    <div class="form-group col-md-4">
            <label for="inputChildrenBcNum">Birth Certificate Number</label>
            <input type="number"  required class="form-control " name="inputChildrenBcNum" value="<?php echo e(old('inputChildrenBcNum')); ?>"  autofocus  placeholder=""> 
          </div>
   

    <div class="form-group col-md-4">
            <label for="inputChildrenDistrict">District Issued</label>
            <select  name="inputChildrenDistrict" class="form-control">
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
    </div>
    <div class="form-row">
            <div class="form-group col-md-4">
                    <label for="inputEmail4">Email</label>
                    <input type="email" required class="form-control " name="inputChildrenEmail" value="<?php echo e(old('inputChildrenEmail')); ?>"  autofocus  placeholder="someone@example.com"> 
                  </div>
              <div class="form-group col-md-4">
                <label for="inputChildrenContactNum4">Contact Number</label>
                <input type="tel" required  value="<?php echo e(old('inputChildrenContactNum')); ?>"  title="8 digits code only and starting with number '5'." class="form-control" name="inputChildrenContactNum"  >
              </div>

            <div class="form-group col-md-4">
                <label for="inputChildrenGender">Gender</label>
                <select  name="inputChildrenGender" class="form-control">
                <option selected>Male</option>
                <option>Female</option>
                </select>
            </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputChildrenNIC1">NIC Number</label>
          <input type="text" required maxlength="14" class="form-control" name="inputChildrenNIC1" value="<?php echo e(old('inputNIC1')); ?>"  >
          
        </div>
        <div class="form-group col-md-4">
            <label for="inputChildrenAddress">Address</label>
            <textarea rows="1" cols="50" type="text" required  class="form-control" name="inputChildrenAddress" value="<?php echo e(old('inputChildrenAddress')); ?>"  ></textarea>
           
          </div>
          <div class="form-group col-md-4">
            <label for="inputChildrenPlaceOfBirth">Place of Birth</label>
            <select  name="inputChildrenPlaceOfBirth" class="form-control">
            <option selected>Dr Jeetoo Hospital</option>
            <option>Flacq Hospital</option>
            <option>J. Nehru Hospital </option>
            <option>Long Mountain Hospital </option>
            <option>Mahebourg Hospital</option>
            <option>Sir Seewoosagur Ramgoolam National Hospital</option>
            <option>Souillac Hospital</option>
            <option>City Clinic</option>
            <option>ABC Medi Clinic</option>
            <option>Chisty Shifa Clinic </option>
            <option>Clinique Darné </option>
            <option>Clinique Muller</option>
            <option>Clinique de Lorette</option>
            <option>Clinique du Centre</option>
            <option>Clinique du Nord</option>
            <option>Clinique Ferriere</option>
            <option>Clinique Medisave </option>
            <option>La Clinique Mauricienne </option>
            <option>Medicare Clinic</option>
            <option>Clinique du Bon Pasteur</option>
            <option>St Esprit Clinic</option>
            <option>St Jean Clinic</option>
            <option>Apollo Bramwell Hospital</option>
            <option>Wellkin Hospital</option>
            </select>
        </div>
         
</div>

<div class="form-row">
    <div class="form-group col-md-3">
            <label for="inputChildrenProfession">Profession</label>
            <input type="text" required  class="form-control" name="inputChildrenProfession" value="<?php echo e(old('inputChildrenProfession')); ?>"  >
    </div>

    <div class="form-group col-md-3">
        <label for="inputChildrenRoles">Roles</label>
        <select  name="inputChildrenRoles" class="form-control">
            <option>Children</option>
            
        </select>
    </div>
    
    <div class="form-group col-md-3">
        <label for="inputChildrenMarriageStatus">Marriage Status</label>
        <select  name="inputChildrenMarriageStatus" class="form-control">
            <option selected>Célibataire</option>
            <option>Mariés</option>
            <option >Divorcés</option>
            <option>Veuve</option>
            <option>Veuf</option>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label for="inputParentId">Parent ID</label>
        <select name="inputParentId" id="inputParentId" class="form-control input-lg dynamic" >
            <option value="">Select id</option>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </select>                       
        </div>
</div>
    
   <div class="row">
       <div class="col-4"></div>
       <div class="col-4">
    <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Register">
       </div>
       <div class="col-4"></div>
   </div>
    
    </fieldset>
  </form>
  
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>