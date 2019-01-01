<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
    <title>User Email</title>
    <style>
        .userEmailContainer .userEmail{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 13px;
        }
        .userEmailContainer .userGenEmail{
            font-style: italic;
            font-weight:200;
        }
    </style>
</head>
<body>
    <div class="userEmailContainer">
        <div class="userEmail">
            <strong>Hello <?php echo e($fname); ?>,</strong><br><br> 

            Welcome to Notary System. <br> 
            
            Your generated password is: <?php echo e($genPass); ?><br>
            Kindly click on the link below to proceed. <br><br> 

            

            Regards,<br>
            NW Team <br><br><br><br>
        </div>
        <small class="userGenEmail">[This is email is generated automatically, please do not reply to this email.]</small>
    </div>
</body>
</html>