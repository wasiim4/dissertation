<html>
<head>
<title>Login</title>
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/login.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer.css')); ?>">
    
</head>
   

<body>
       <h1  style="color:white; padding-top:2%;"> <img src="<?php echo e(asset('images/mru1.png')); ?>" height="10%" width="5%" alt="Mauritius">Welcome to Mauritius e-Notary</h1>
    <div class="loginbox">
            <?php echo $__env->yieldContent('content'); ?>
            <marquee style="color:#a9a9a9; font-size:14px;">*** For security reasons, please Log Out and Exit your web browser when you are done accessing services that require authentication!***</marquee>

    </div>