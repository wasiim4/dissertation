@include('flashy::message')
@extends('layouts.banklayout')
<head>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/register.css')}}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style4.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <style>
       .header {
        width: 97.2%;
        margin-left:1.5%;
        background-color: #17a2b8;
        color: #ffffff;
        padding: 5px;
        font-size: 5px !important;
        }
    </style> 
</head>

@section('content')
<div class="row">
    <div class="header">
        <div class="col-12">
            <h1 style="text-align:center;  margin-bottom: -1%;">Compose Mail</h1>
        </div>
    </div>
</div>
<br>
@if (Session::has('message'))
	<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<form method="POST" action="{{ route('Rgd.send.party.mail') }}" id="frmAddUser"  files="true" enctype="multipart/form-data">
    @csrf
    <fieldset class="addUserFieldset">
        <legend class="addUserLegend">Send Mail</legend>
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
            
            <br><br>
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    {{-- @foreach($rgds as $rgd) --}}
                        <label for="inputSender">From</label>
                        <input type="email" required class="form-control" disabled name="inputSender" value="{{Auth::user()->email}}"  autofocus>                         
                    {{-- @endforeach --}}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputRecipient">To</label>
                    <select name="inputRecipient" id="inputRecipient" class="form-control input-lg dynamic" >
                        <option value="">Select recipient</option>
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id}}">{{$staff->id}}<?php echo"-"?>{{$staff->firstname}}<?php echo" "?>{{$staff->lastname}}<?php echo"-"?>{{$staff->roles}}</option>
                        @endforeach
                        @foreach($clients as $client)
                            <option value="{{ $client->id}}">{{$client->id}}<?php echo"-"?>{{$client->firstname}}<?php echo" "?>{{$client->lastname}}<?php echo"-"?>{{$client->roles}}</option>
                        @endforeach
                        @foreach($rgds as $rgd)
                            <option value="{{$rgd->id}}">{{$rgd->id}}<?php echo"-"?>{{$rgd->name}}</option>
                         @endforeach
                    </select>                       
                </div>
                <div class="form-group col-md-4">
                    <label for="inputSubject">Subject</label>
                    <input type="text" required class="form-control" name="inputSubject" value="{{ old('inputSubject') }}"  autofocus>                         
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
            <div class="col-8">

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio2" value="Notary/Notary Assistant">
                    <label class="form-check-label" for="inlineRadio2">Notary/Notary Assistant</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio3" value="Client" >
                    <label class="form-check-label" for="inlineRadio3">Client </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="party" id="inlineRadio3" value="RGD" >
                    <label class="form-check-label" for="inlineRadio3">RGD </label>
                </div>

            </div>
            <div class="col-2"></div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputBody">Body</label>
                <textarea rows="5" cols="100" type="text" required  class="form-control" name="inputBody" value="{{ old('inputBody') }}"  ></textarea>                  
            </div>        
        </div>
  
        <div class="row">
            <div class="col-5"></div>
            <div class="col-4">
                <label for="inputFiles" style="text-align:center !important;"><i class="fas fa-paperclip"></i> Attach File</label>
                <input type="file" name="inputAttachment" >
            </div>
            <div class="col-3"></div>
        </div>
        {{-- <a href="/generateWord" class="btn btn-danger">Genrerate Word Document</a> --}}
        <br>
        
        <div class="form-row">
            <div class="col-4">
        </div>
        
        <div class="col-4">
            <input type="submit" name="btnSubmit" class="btn btn-success btn-block " value="Send Mail">
        </div>
        
        <div class="col-4"></div>
       
    </fieldset>
</form>
@endsection