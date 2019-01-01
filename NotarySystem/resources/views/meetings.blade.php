@include('flashy::message')
@extends('layouts.meetinglayout')
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 
    <link rel="stylesheet" type="text/css" href="{{asset('/css/register.css')}}"> 
    <!-- Scripts -->
    {{-- <script src="http://code.jquery.com/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
      .header {
      width: 97.2%;
      margin-left:1.5%;
      background-color: #17a2b8;
      color: #ffffff;
      padding: 5px;
      font-size: 5px !important;
      }

      fieldset
{
  background-color:#CCC;
  max-width:93%;
  padding:16px;	
}
.legend1
{
  margin-bottom:0px;
  margin-left:16px;
}
    </style> 
  <script>
    $(document).ready(function(){
     $("#demo1").hide();
      $("#demo2").hide();
       $("#demo3").hide();
     
      $("#addMeeting").click(function(){
        $("#demo1").show();
         $("#demo2").hide();
       $("#demo3").hide();
        
      });
      
      $("#updateMeeting").click(function(){
        $("#demo2").show();
         $("#demo1").hide();
       $("#demo3").hide();
        
      });
      $("#delMeeting").click(function(){
        $("#demo3").show();
         $("#demo1").hide();
       $("#demo2").hide();
        
      });

      $("#cancel").click(function(){
       
         $("#demo1").hide();
       
        
      });
    });
    </script>
</head>

@section('content')

<div class="row" style="width:93% !important;">
    <div class="col-3">
      <div class="container" >
        <a href="/staff/meeting/add/del/up" class="btn btn-success btn-lg" id="addMeeting"  >Add Meeting</a><br>
            </div>
          </div>
      
  
  
    <div class="col-3">
      <div class="container" style="width:93% !important;">
        <button class="btn btn-primary btn-lg" id="updateMeeting">Update Meeting</button>
        
      </div>
    </div>
    <div class="col-3">
      <div class="container" style="width:93% !important;">
        <button class="btn btn-danger btn-lg" id="delMeeting">Delete Meeting</button>
       
      </div>
    </div>

      <div class="col-3">
          <div class="container">
            <a class="btn btn-info btn-lg" href="/staff"><i class="fa fa-home hvr-icon"></i> Back</a>
            
          </div>
    </div>
    </div>
  <br><br>
  <div class="row" >
    <div class="col-12">
      
      
    
    </div>
  </div>
   

    <div class="panel panel-primary" style="width: 93%;">
      <div class="panel-heading"style="background-color:#17a2b8; border-color:#17a2b8; text-align:center; font-size: 34px;">Meeting Details</div>
      <div class="panel-body" >
          {!! $calendar_details->calendar() !!}
      </div>
    </div>

    
   
@endsection