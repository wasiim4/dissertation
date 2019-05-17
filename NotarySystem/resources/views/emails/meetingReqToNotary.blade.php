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
               
                @if($requestFrom=="Land Surveyor" ||$requestFrom=="Bank" ||$requestFrom=="RGD"  )
                <strong>Hello  {!!$name!!}, </strong> <br><br>
                @else
                <strong>Hello {!!$firstname!!} {!!$lastname!!}, </strong> <br><br>
                @endif
                
                @if($meetingStatus=="Unavailable")
                    Please note that the i will not be available for the meeting on for the day you requested for. 
                    However i shall communincate a date to you as soon as possible.
                @endif
                @if($meetingStatus=="Available")
                    Please note that the i will  be available for the meeting on for the day you requested for. 
                    Therefore we shall meet on the requested day to discuss about the progress. 
                @endif
                <br><br>
               Kind Regards,<br>
               Notary Team
               
            </div>
            {{-- <img class="userInvImgEmail" src="{{ $message->embed(('images/'.$image_path)) }}">       --}}
        </div>
        {{-- <small class="userInvGenEmail">[This is email is generated automatically, please do not reply to this email.]</small> --}}
    </div>
</body>
</html> 
