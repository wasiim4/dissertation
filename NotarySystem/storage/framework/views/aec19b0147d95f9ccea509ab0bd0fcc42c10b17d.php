<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<head>
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
                <h1 style="text-align:center;">List of Clients</h1>
                </div>
            </div>
            </div>
   
    <div class="spacor1"></div>
<div class="row">
<div class="col-12">
<div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
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
                Role
            </th>
            <th>
                Status
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
                <?php echo e($user->roles); ?>

            </td>
            <td>
                <?php echo e($user->marriageStatus); ?>

            </td>
            <td>
                
                    <a style="color:black;" href="/staff/show/client/<?php echo e($user->id); ?>">
                        <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="More details">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a> 
                
               |
                
                <a class="editbtn" style="color:black;"  data-toggle="modal" data-target="#editusermod" data-mycontactnum="<?php echo e($user->contactnum); ?>" data-myfirstname="<?php echo e($user->firstname); ?>" data-mylastname="<?php echo e($user->lastname); ?>" data-myemail="<?php echo e($user->email); ?>" data-userid="<?php echo e($user->id); ?>" >
                        <span style="border-bottom:none" data-tooltip tabindex="1" title="Edit">
                            <i class="fas fa-pencil-alt font-color"></i> 
                        </span>
                    </a>
                
                |
                
                   
                        <a class="btndelevent" style="color:black;" href="/staff/client/delete/<?php echo e($user->id); ?>">
                            <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                                <i class="fas fa-trash-alt font-color"></i>
                            </span>
                        </a>
                   
                
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
</div>
</div >
    <!-- The Modal -->
  <div class="modal fade" id="editusermod">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Client Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                    <form action="" method="POST"  enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                    <div class="row">
                        
                    <div class="col-6">
                      
                            <label for="staffid">Client ID</label>
                            <input type="text" id="satffId" name="txtid" value="<?php echo e($user->id); ?>" disabled class="form-control"disabled><br>
                
                            <label for="staffrole">Role</label><br>
                            <input type="text" id="satffRole" name="txtrole" value="<?php echo e($user->roles); ?>"disabled class="form-control"disabled><br>
                
                            <label for="staffTitle">Title</label>
                            <select  name="txtTitle" class="form-control" disabled >
                                <option selected><?php echo e($user->title); ?></option>
                                <option>Monsieur</option>
                                <option>Madame</option>
                                <option>Mademoiselle</option>
                             </select>
                
                            <label for="fname">First Name</label>
                            <input type="text" id="staffFname" name="txtfname" disabled value="<?php echo e($user->firstname); ?>"class="form-control">
                        
                            <label for="lname">Last Name</label>
                            <input type="text" id="stafflname" name="txtlname" disabled value="<?php echo e($user->lastname); ?>"class="form-control">
                    </div>
                
                    <div class="col-6">
                              <label for="country">Email-Address</label>
                              <input type="email" id="staffEmail" name="txtemail" disabled class="form-control" value="<?php echo e($user->email); ?>">
                
                              <label for="contactNum">Contact Number</label>
                              <input type="tel" id="staffContactNum" name="txtcnum" disabled class="form-control"value="<?php echo e($user->contactnum); ?>">
                
                              <label for="dob">Date of Birth</label>
                              <input type="date" id="satffDob" name="txtdob"  disabled class="form-control" value="<?php echo e($user->dob); ?>" >
                
                              <label for="nic">National Identity Card Number</label>
                              <input type="text" maxlength="14" id="satffNic" disabled class="form-control"name="txtnic" value="<?php echo e($user->nic); ?>" >
                              
                              <label for="staffTitle">Title</label>
                              <select  name="txtgender" class="form-control" disabled >
                                <option selected><?php echo e($user->gender); ?></option>
                                <option>Female</option>
                                <option>Male</option>
                              </select>
                    </div>
                    
                
                </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
      </div>
      <script>
            $('.editbtn').on('click', function (event) {
                var fname = $(this).attr("data-myfirstname");
                var lname = $(this).attr("data-mylastname");
                var email = $(this).attr("data-myemail");
                var cnum = $(this).attr("data-mycontactnum");
                var userid = $(this).attr("data-userid");
            
                $('#firstname').val(fname);
                $('#email').val(email);
                $('#lastname').val(lname);
                $('#contactnum').val(cnum);
                $('#userid').val(userid);
            });
            </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>