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
        input[type=file]:hover {
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }

        .header {
        background-color: #17a2b8;
        color: #ffffff;
        padding: 1px;
        font-size: 5px !important;
        padding-bottom: 0% !important;
        }

        #content {
        width: 115.7% !important;
        }

        .designBtn span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
            }

            .designBtn span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
            }

            .designBtn:hover span {
            padding-right: 25px;
            }

            .designBtn:hover span:after {
            opacity: 1;
            right: 0;
            }
    </style>
</head>      

@section('content')
<div class="row">
    <div class="col-12">
        <div class="header">
            <h1 style="text-align:center;">Upload Contract</h1>
        </div>
    </div>
</div>
{{-- <h1 class="datatableTitleUsers"> Upload Contract</h1> --}}
<form method="POST" action="{{ route('upload.contract.submit') }}" id="frmAddUser" files="true" enctype="multipart/form-data">
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
            @if (Session::has('message'))
	            <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="row">
                <div class="col-4">
                    <label>Client Name</label>
                    <select name="inputClientName" id="inputClientName" class="form-control " >
                        <option value="">Select name</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id}}">{{$user->id}}<?php echo"-"?>{{$user->firstname}}<?php echo" "?>{{$user->lastname}}<?php echo"-"?>{{$user->roles}}</option>
                        @endforeach
                    </select>                
                </div>
                <div class="col-4">
                    <label>Property ID</label>
                    <select name="inputProperty" id="inputProperty" class="form-control " >
                        <option value="">Select property</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->propertyId}}">{{$property->propertyId}}<?php echo"-"?>{{$property->pinNum}}</option>
                        @endforeach
                    </select>                
                </div>
                <div class="col-4">
                    <label>Generated Contract</label>
                    <input type="file" accept=".pdf" id="contract"  name="contract" class="btn  btn-block"  >
                    {{-- <input type="file"  id="contract"  name="contract" class="btn  btn-block"  > --}}
                </div>
                
            </div>
            <div class="row">
                <div class="col-4">
                    <label>Transaction Type</label>
                    <select name="inputTransaction" id="inputTransaction" class="form-control " >
                        <option value="">Select type</option>
                        <option >SOIP1</option>
                        <option>ALOT02</option>             
                    </select>                
                </div>
                <div class="col-4">
                    <label>Stamp Duty Fees(RS)</label>
                    <input type="text" id='stampDuty' name='inputStampDuty'class="form-control">
                </div>
                <div class="col-4">
                    <label>Administrative Fees(RS)</label>
                    <input type="text" id='adminFees' name='inputAdministrativeFees'class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Upload Contract">
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </fieldset>
</form>
<div class="row">
    <div class="col-5"></div>
    <div class="col-3">
        <a href="/staff/transactions/list" class="btn btn-success btn-info designBtn"><span>Uploaded Contracts</span></a>
    </div>
    <div class="c0l-4"></div>
</div>
@endsection