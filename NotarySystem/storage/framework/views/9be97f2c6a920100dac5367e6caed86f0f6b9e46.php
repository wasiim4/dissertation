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
  <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
  </script>
</head>

<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="card">
    <div class="card-header card bg-success text-white" style=" text-align:center;">Add Meeting</div>
      <div class="card-body">
          <?php if(Session::has('message')): ?>
            <div class="alert alert-success"><?php echo e(Session::get('message')); ?>

              <a href="http://127.0.0.1:8000/staff/meetings" style="color:#155724; text-decoration:underline;" target="_blank">View in Calendar</a>
            </div>
          <?php endif; ?>

          <form action="<?php echo e(route('meetings.add')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-3">
                <label for="partyId">Party ID</label>
                  <select name="partyId" id="partyId" class="form-control " >
                    <option value="">Select name</option>
                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->id); ?><?php echo"-"?><?php echo e($user->firstname); ?><?php echo" "?><?php echo e($user->lastname); ?><?php echo"-"?><?php echo e($user->roles); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>   
              </div>

              <div class="col-3">
                <label for="meetingReason">Meeting Reason</label><br>
                <input type="text" id="meetingReason" name="meetingReason" value="" class="form-control"><br>
              </div>

              <div class="col-3">
                <label for="startTime">Start Time</label>
                <input type="datetime-local" id="startTime" name="startTime" value=""class="form-control"><br>
              </div>

              <div class="col-3">
                <label for="endTime">Start Time</label>
                <input type="datetime-local" id="endTime" name="endTime" value=""class="form-control"><br>
              </div>
            </div>

            <div class="row">
              <div class="col-4"></div>
                <div class="col-6">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio1" value="Client">
                    <label class="form-check-label" for="inlineRadio1">Client</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio2" value="RGD">
                    <label class="form-check-label" for="inlineRadio2">RGD</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio3" value="Bank" >
                    <label class="form-check-label" for="inlineRadio3">Bank </label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio3" value="Bank" >
                    <label class="form-check-label" for="inlineRadio3">Land Surveyor </label>
                  </div>

                </div>
                <div class="col-2"></div>
            </div>
            <br>

            <div class="row">
              <div class="col-4"></div>

              <div class="col-4">
               <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Add Meeting">
              </div>

              <div class="col-4"></div>
            </div>
          </form> 
    </div>  
  </div>
</div>
<br>

<div class="container">
 <div class="card">
  <div class="card-header card bg-primary text-white" style=" text-align:center;" >Edit Meeting & Cancel Meeting</div>
    <div class="card-body">
      <?php if(Session::has('message')): ?>
        <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
      <?php endif; ?>
      <div class="row">
        <div class="col-12">
          <div class="container tableSpacor table-responsive "  style="width:100%;">
            <table id="tbluser" class="table table-hover " style="width:100%;">
              <thead>
                <tr>
                  <th>
                    ID
                  </th> 
                  <th>
                    Meeting Reason
                  </th>
                  <th>
                    Start Time
                  </th>
                  <th>
                    End Time
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
                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>    
                      <?php echo e($meeting->id); ?> 
                    </td>
                    <td>
                      <?php echo e($meeting->meetingReason); ?>

                    </td>
                    <td>
                      <?php echo e($meeting->startTime); ?>

                    </td>
                    <td>
                      <?php echo e($meeting->endTime); ?>

                    </td>
                    <td>
                      <?php echo e($meeting->meetingStatus); ?>

                    </td>
                    <td>
                      
                        <a style="color:#007bff;" href="/staff/show/client/<?php echo e($meeting->id); ?>">
                          <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="Edit">
                            <i class="fas fa-pencil-alt font-color"></i>
                          </span>
                        </a> 
                      
                        |
                      
                        <a class="btndelevent" style="color:red;" href="/staff/client/delete/<?php echo e($meeting->id); ?>">
                          <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                            <i class="fas fa-trash-alt font-color"></i>
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
      </div> 
    </div>
  </div>
<br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.stafflayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>