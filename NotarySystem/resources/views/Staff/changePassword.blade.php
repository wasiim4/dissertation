@include('flashy::message')
@extends('layouts.stafflayout')
<head>
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}"> --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="{{asset('/css/register.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
        <link rel="icon" href="{{asset('images/addUser.png')}}" />
        <script src="{{url('js/bootstrap.min.js')}}"></script>
    <style>
        #content {
    width: 116.8% !important;
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

    input[type=text], input[type=date], input[type=tel], input[type=email],select {
    width: 100%;
    padding: 4px 10px;
    margin: 5px 0;
    display: inline-block;
    border: 2px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }

    /* input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    } */

    input[type=submit]:hover {
        background-color:#044c14;
    }

    /* div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    } */
    
    </style>
    <script>
        function showPassword() {                      
            var old = document.getElementById("txtOldpassword");
                if (old.type === "password") {
                old.type = "text";
            } 
            else {
                old.type = "password";
            }
        }           
    </script>
    <script>
        function showNewPassword() {            
            var newPass = document.getElementById("txtpassword");
                if (newPass.type === "password") {
                newPass.type = "text";
            } 
            else {
                newPass.type = "password";
            }
                       
        }
    </script>
    <script>
        function showConfirmPassword() {            
            var confirmPass = document.getElementById("txtpassword_confirmation");
                if (confirmPass.type === "password") {
                confirmPass.type = "text";
            } 
            else {
                confirmPass.type = "password";
            }
                       
        }
    </script>
</head>      

@section('content')
{{-- <button class="button" style="vertical-align:middle"><span>Back </span> --}}
<a class="back-btn hvr-icon-pulse" href="/staff"><i class="fa fa-home hvr-icon"></i> Back</a>
<br><br>
<div class="row">
    <div class="col-12">
        <div class="header">
            <h1 style="text-align:center;">Password Change</h1>
        </div>
    </div>
</div>

<form action="{{route('staff.change.pass')}}" method="POST"  enctype="multipart/form-data">
    @csrf
     
            <fieldset class="addUserFieldset">
                <legend class="addUserLegend">Contract</legend>
                <div class="container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <label>Old Password</label>&nbsp;&nbsp;
                            <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="Show Password" class="input-group-label">
                                <i class="fas fa-eye-slash" onclick="showPassword()"></i>
                            </span>
                            <input class="form-control" type="password" placeholder="Old Password" id="txtOldpassword" name="txtOldpassword">               
                            
                        </div>
                        <div class="col-4">
                            <label>New Password</label>&nbsp;&nbsp;
                            <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="Show New Password" class="input-group-label">
                                <i class="fas fa-eye-slash" onclick="showNewPassword()"></i>
                            </span>
                            <input class="form-control" type="password" placeholder="New Password" id="txtpassword" name="txtpassword">
                        </div>
                        <div class="col-4">
                            <label>Confirm Password</label>&nbsp;&nbsp;
                            <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="Show Confirm Password" class="input-group-label">
                                <i class="fas fa-eye-slash" onclick="showConfirmPassword()"></i>
                            </span>
                            <input class="form-control" type="password" placeholder="Confirm Password" id="txtpassword_confirmation"  name="txtpassword_confirmation">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Change Password">
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
            </fieldset>
   
    
</form>
@endsection