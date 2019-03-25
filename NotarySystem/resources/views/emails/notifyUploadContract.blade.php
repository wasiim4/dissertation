<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
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
            <strong>Hello {{$firstname}} {{$lastname}},</strong><br><br> 

            Please note that a copy of your contract has been successfully uploaded onto the website. <br> 
            
            You can now download a copy of your contract.<br>
            Fees to be paid: RS{{$Fees}} <br><br> 

            {{-- <a href="http://127.0.0.1:8000/logout">Click to login</a> <br><br> --}}

            Regards,<br>
            NW Team <br><br><br><br>
        </div>
        <small class="userGenEmail">[This is email is generated automatically, please do not reply to this email.]</small>
    </div>
</body>
</html>