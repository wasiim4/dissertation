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
                <strong>Hello {!!$firstname!!} {!!$lastname!!}, </strong> <br><br>

                We are sending you this email to confirm your presence for the following meeting.
                  <br><br>

                <u>Meeting Details:</u><br><br>

                Meeting Reason: {!!$meetingReason!!} <br> 
                Starting time: {!!$startTime!!} <br> 
                Ending time: {!!$endTime!!} <br> 
                Durations:{!!$duration!!}
                
                <br> 
            
                Click on either link below whether you are coming  or not.<br><br>
                <a href="http://127.0.0.1:8000/confirm/meeting/{!!$pid!!}{!!$mid!!}/?status=confirmed" class="btn btn-success">Coming</a>&nbsp;&nbsp;&nbsp;&nbsp;<a  class="btn btn-danger" href="http://127.0.0.1:8000/confirm/meeting/{!!$pid!!}{!!$mid!!}/?status=not_going">Not coming</a>
                <br><br>
            </div>
            {{-- <img class="userInvImgEmail" src="{{ $message->embed(('images/'.$image_path)) }}">       --}}
        </div>
        <small class="userInvGenEmail">[This is email is generated automatically, please do not reply to this email.]</small>
    </div>
</body>
</html> 
