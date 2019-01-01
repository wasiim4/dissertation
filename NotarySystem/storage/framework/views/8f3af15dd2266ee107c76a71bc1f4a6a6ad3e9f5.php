
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    

    <title>Notary System</title>

    <!-- Bootstrap CSS CDN -->
    
    <!-- Our Custom CSS -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style4.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>"> 
    <link rel="icon" href="<?php echo e(asset('images/certificate.png')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer.css')); ?>">
    <!-- Font Awesome JS -->
    <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
        $('#tbluser').DataTable(
            {'responsive':'true'}
        );
    } );
    </script>
    <script>
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip();   
            });
            </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
     
    
   <style>
       a{
           color:white;
       }
   </style>
 
</head>



    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3> Notary System</h3>
                <strong>NS</strong>
            </div>
            
            <ul class="list-unstyled components">
                
                <li>
                    <a href="<?php echo e(route('myProfile')); ?>"><i class="fas fa-user-circle"></i> My Profile</a></li>
            </li>
            
                <li>
                    <a href="<?php echo e(route('registernew')); ?>" ><i class="fas fa-user-plus"></i> Add Client</a>
                </li>
                <li>
                    <a href="<?php echo e(route('registerSpouse')); ?>" ><i class="fas fa-user-plus"></i> Add Spouse</a>
                </li>
                <li>
                    <a href="<?php echo e(route('confirm.children')); ?>" ><i class="fas fa-user-plus"></i> Num of Children</a>
                </li>
                <li>
                    <a href="<?php echo e(route('show.children.form')); ?>" ><i class="fas fa-user-plus"></i>Add Children</a>
                </li>

                <li>
                    <a href="<?php echo e(route('propertyRegistration')); ?>" ><i class="fas fa-building"></i> Property Registration</a>
                </li>
                <li>
                    <a href="<?php echo e(route('meetings')); ?>" ><i class="fas fa-calendar-alt"></i> View Meetings</a>
                </li>
                <li>
                <a href="<?php echo e(route('upload.contract')); ?>" ><i class="fas fa-upload"></i> Upload Contract</a>
                </li>
                
                
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-file-alt"></i>
                        Generate Contract
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="<?php echo e(route('generateContract')); ?>" ><i class="fas fa-key"></i> SOIP01</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('show.partage')); ?>" ><i class="fas fa-user-plus"></i>ALOT02</a>
                            </li>
                        
                        
                    </ul>
                </li>
                <li >
                        <a href="#mailSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-envelope"></i>
                            Mails
                        </a>
                        <ul class="collapse list-unstyled" id="mailSubmenu">
                                <li>
                                    <a href="<?php echo e(route('show.mailCompose')); ?>" ><i class="fas fa-edit"></i> Compose Mail</a>
                                </li>
                                <li>
                                    <a href="https://mail.google.com/mail/u/2/#inbox" target='_blank'><i class="fas fa-inbox"></i> Inbox</a>
                                </li>
                                <li>
                                     <a href="https://mail.google.com/mail/u/2/#sent" target='_blank'><i class="fas fa-share-square"></i> Sent Items</a>
                                </li>
                            
                        </ul>
                    </li>
              
                <li>
                    <a href="<?php echo e(route('staff.logout')); ?>">
                        <i class="fa fa-power-off"></i>
                        <b>Log out<b>
                    </a>
                </li>
            </ul>

            
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            
                            <li class="nav-item">
                                <a class="nav-link" style="color:aliceblue;" href="<?php echo e(route('staffdashboard')); ?>">Welcome,<?php echo e(ucfirst(strtolower(Auth::user()->firstname))); ?> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <body>
            <?php echo $__env->yieldContent('content'); ?>
            
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
<footer>
    <img src="<?php echo e(asset('images/certificate.png')); ?>" class="footerlogo" alt="logo notary">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> NW Mauritius.
 </footer>
</html>