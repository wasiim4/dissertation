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

fieldset{
  background-color:#CCC;
  max-width:93%;
  padding:16px;	
}
.legend1{
  margin-bottom:0px;
  margin-left:16px;
}

* {
        box-sizing: border-box;
    }
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    [class*="col-"] {
        float: left !important;
        padding: 15px!important;
    }
    .col-1 {width: 8.33% !important;}
    .col-2 {width: 16.66% !important;}
    .col-3 {width: 25% !important;}
    .col-4 {width: 33.33% !important;}
    .col-5 {width: 41.66% !important;}
    .col-6 {width: 50% !important;}
    .col-7 {width: 58.33% !important;}
    .col-8 {width: 66.66% !important;}
    .col-9 {width: 75% !important;}
    .col-10 {width: 83.33% !important;}
    .col-11 {width: 91.66% !important;}
    .col-12 {width: 100% !important;}
    html {
        font-family: "Lucida Sans", sans-serif;
    }
    .header {
        background-color: #17a2b8;
        color: #ffffff;
        padding: 1px;
        font-size: 5px !important;
    }
    .menu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .menu li {
        padding: 8px;
        margin-bottom: 7px;
        background-color: #33b5e5;
        color: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }
    .menu li:hover {
        background-color: #0099cc;
    }
</style> 

</head>

@section('content')

<div class="row" style="width:93% !important; margin-left:8% !important;">
    <div class="col-3">
      <div class="container" >
          <a href="/staff/meeting/add/del/up" class="btn btn-success btn-lg" id="addMeeting"  >Add Meeting</a><br>
      </div>
    </div>
  
  
  <div class="col-3">
    {{-- <div class="container" style="width:93% !important;"> --}}
      <button class="btn btn-primary btn-lg" id="updateMeeting">Update Meeting</button>
    {{-- </div> --}}
  </div>
  <div class="col-3">
    {{-- <div class="container" style="width:93% !important;"> --}}
      <button class="btn btn-danger btn-lg" id="delMeeting">Delete Meeting</button>
    {{-- </div> --}}
  </div>
  <div class="col-3">
    {{-- <div class="container"> --}}
      <a class="btn btn-info btn-lg" href="/staff"><i class="fa fa-home hvr-icon"></i> Back</a>   
    {{-- </div> --}}
  </div>
</div>
<br><br>
<div class="row" >
  <div class="col-12"></div>
</div>
<div class="panel panel-primary" style="width: 93%;  margin-left:3.5%; ">
  <div class="panel-heading"style="background-color:#17a2b8;border-color:#17a2b8; text-align:center; font-size: 34px;">Meeting Details</div>
  <div class="panel-body" >
    {!! $calendar_details->calendar() !!}
  </div>
</div>
   
@endsection