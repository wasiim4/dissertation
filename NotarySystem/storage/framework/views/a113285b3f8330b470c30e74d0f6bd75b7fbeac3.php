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
            <h1 style="text-align:center;  margin-bottom: -1%;">Immovable Property Registration</h1>
            </div>
        </div>
        </div>

<form method="POST" action="" id="frmAddUser">
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
           
                    
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputPropertyType">Property Type</label>
                    <select  name="inputPropertyType" class="form-control">
                        <option selected>Land</option>
                        <option>Company</option>
                        <option>Hotel</option>
                        <option>House</option>
                    </select>
                </div>
                

                <div class="form-group col-md-4">
                        <label for="inputClientID">Buyer/Seller</label>
                    <select name="inputClientID" id="inputClientID" class="form-control input-lg dynamic" data-dependent="firstname">
                     <option value="">Select id</option>
                     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                   </div>

                <div class="form-group col-md-4">
                    <label for="inputAddress">Address</label>
                    <textarea rows="1" cols="50" type="text" required  class="form-control" name="inputAddress" value="<?php echo e(old('inputAddress')); ?>"  ></textarea>
               </div>

               
                
             </div>

            <div class="form-row">  
            <div class="form-group col-md-4">
              <label for="inputSizeMsF">Size In Meter Squares(Figures)</label>
              <input type="number"  required class="form-control " name="inputSizeMsF" value="<?php echo e(old('inputSizeMsF')); ?>"  > 
            </div>

            <div class="form-group col-md-4">
                <label for="inputSizeMsW">Size In Meter Squares(Words)</label>
                <input type="text"  required class="form-control " name="inputSizeMsW" value="<?php echo e(old('inputSizeMsW')); ?>"  autofocus  placeholder=""> 
            </div>
           

            <div class="form-group col-md-4">
                <label for="inputSizeInPerch">Size In Perch(Words)</label>
                <input type="text"  required class="form-control " name="inputSizeInPerch" value="<?php echo e(old('inputSizeInPerch')); ?>"  autofocus  placeholder=""> 
            </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputTranscriptionVolume">Transcription Volume(If any)</label>
                    <input type="text"  class="form-control " name="inputTranscriptionVolume" value="<?php echo e(old('inputTranscriptionVolume')); ?>"  autofocus > 
                </div>

                <div class="form-group col-md-4">
                    <label for="inputPinNum">Pin Number</label>
                    <input type="number"  value="<?php echo e(old('inputPinNum')); ?>"   class="form-control" name="inputPinNum"  >
                </div>

                    <div class="form-group col-md-4">
                        <label for="inputRegNum">Reg no. In Surveyor's Report</label>
                        <input type="text" class="form-control " name="inputRegNum" value="<?php echo e(old('inputRegNum')); ?>"  autofocus > 
                    </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputLsFn">Land Surveyor First Name</label>
                  <input type="text"  class="form-control" name="inputLsFn" value="<?php echo e(old('inputLsFn')); ?>"  >
                  
                </div>
                <div class="form-group col-md-4">
                    <label for="inputLsLn">Land Surveyor Last Name</label>
                    <input type="text"  class="form-control" name="inputLsLn" value="<?php echo e(old('inputLsLn')); ?>"  > 
                </div>

                <div class="form-group col-md-4">
                    <label for="inputSurveyingDate">Surveying Date</label>
                    <input type="date"  class="form-control" name="inputSurveyingDate" value="<?php echo e(old('inputSurveyingDate')); ?>"  > 
                </div>
                 
      </div>
      <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputPriceFigures">Price(In words)</label>
            <input type="number"  class="form-control" name="inputPriceFigures" value="<?php echo e(old('inputPriceFigures')); ?>"  >
            
            </div>
            <div class="form-group col-md-6">
                <label for="inputPriceWords">Price(In Figures)</label>
                <input type="text"  class="form-control" name="inputPriceWords" value="<?php echo e(old('inputPriceWords')); ?>"  > 
            </div>
         
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="inputFirstDeedReg">First Deed Registration</label>
            <input type="date"  class="form-control" name="inputFirstDeedReg" value="<?php echo e(old('inputFirstDeedReg')); ?>"  >
            
            </div>
            <div class="form-group col-md-4">
                <label for="inputFirstDeedGeneration">First Deed Generation</label>
                <input type="date"  class="form-control" name="inputFirstDeedGeneration" value="<?php echo e(old('inputFirstDeedGeneration')); ?>"  > 
            </div>

            <div class="form-group col-md-4">
                <label for="inputDistrict">District Situated</label>
                <select  name="inputDistrict" class="form-control">
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
              <label for="inputPreviousNotaryTitle">Previous Notary Title</label>
              <select  name="inputPreviousNotaryTitle" class="form-control">
                <option selected>Monsieur</option>
                <option>Madame</option>
                <option>Mademoiselle</option>
                </select>
                </div>

            <div class="form-group col-md-4">
                <label for="inputPreviousNotaryFN">Previous Notary Firstname</label>
                <input type="text"  required class="form-control " name="inputPreviousNotaryFN" value="<?php echo e(old('inputPreviousNotaryFN')); ?>"  autofocus  placeholder=""> 
            </div>
           

            <div class="form-group col-md-4">
                <label for="inputPreviousNotaryLN">Previous Notary Lastname</label>
                <input type="text"  required class="form-control " name="inputPreviousNotaryLN" value="<?php echo e(old('inputPreviousNotaryLN')); ?>"  autofocus  placeholder=""> 
            </div>

            </div>
            <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Add Property">
        </div>
        <div class="col-4"></div>
    </div>
        </div>
    </fieldset>
</form>

<script>
    $(document).ready(function(){
    
     $('.dynamic').change(function(){
      if($(this).val() != '')
      {
       var select = $(this).attr("id");
       var value = $(this).val();
       var dependent = $(this).data('dependent');
       var _token = $('input[name="_token"]').val();
       $.ajax({
        url:"<?php echo e(route('dynamicdependent.fetch')); ?>",
        method:"POST",
        data:{select:select, value:value, _token:_token, dependent:dependent},
        success:function(result)
        {
         $('#'+dependent).html(result);
        }
    
       })
      }
     });
    
     $('#inputClientID').change(function(){
      $('#firstname').val('');
     
     });

     
    });
    </script>
<?php $__env->stopSection(); ?>

</html>
<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>