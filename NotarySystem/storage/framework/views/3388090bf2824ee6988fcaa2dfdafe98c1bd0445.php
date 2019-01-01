<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .userInvEmailContainer .userInvEmail{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 13px;
            overflow: auto;
            margin-bottom: 6%;
        }
        .userInvEmailContainer .userInvGenEmail{
            font-style: italic;
            font-weight:200;
    
        }
        .userInvEmailContainer .userInvEmail .userInvImgEmail{
            max-width:36.5%;     
        }
        .mainUserInvEmail{
            float:left;
            margin-right: 16%;
        }

    </style>
</head>
<body>
    <div class="userInvEmailContainer">
        <div class="userInvEmail">
            <div class="mainUserInvEmail">
                <strong>Hello <?php echo $firstname; ?> <?php echo $lastname; ?>, </strong> <br><br>

               

                <u>Your Password is:{<?php echo $password; ?>}</u><br><br>


                Thank you for choosing us.<br><br>
                
            </div>
            
        </div>
        <small class="userInvGenEmail">[This is email is generated automatically, please do not reply to this email.]</small>
    </div>
</body>
</html> 
