@include('flashy::message')
@extends('layouts.stafflayout')
<head>
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    * {
        box-sizing: border-box;
    }
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    [class*="col-"] {
        float: left;
        padding: 15px;
    }
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}
    html {
        font-family: "Lucida Sans", sans-serif;
    }
    .header {
        background-color: #17a2b8;
        color: #ffffff;
        padding: 5px;
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
        background-color:#17a2b887;
    }

    /* div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    } */
    
    </style>
</head>      

@section('content')
{{-- <button class="button" style="vertical-align:middle"><span>Back </span> --}}
<a class="back-btn hvr-icon-pulse" href="/staff"><i class="fa fa-home hvr-icon"></i> Back</a>
<br><br>
<div class="header">
    <h1 style="text-align:center;">Immovable Property Details</h1>
</div>
<br>
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

@foreach($property as $properties)
<form action="{{route('propertyUpdate')}}" method="POST"  enctype="multipart/form-data">
    @csrf
  
    <div class="row">
        <div class="col-4">
            <label for="staffid">Property ID</label> 
            <input type="number" id="propId" name="propid" value="{{$properties->propertyId}}" class="form-control">
            
            <label for="staffrole">Client Id</label><br>
            <input type="number" id="clientId" name="clientId" value="{{$properties->clientId}}" class="form-control">

            <label for="staffrole">Property Address</label><br>
            <input type="text" id="address" name="address" value="{{$properties->address}}" class="form-control">
           
            <label for="staffrole">Price(RS)</label><br>
            <input type="number" id="price" name="price" value="{{$properties->priceInFigures}}" class="form-control">

            <label for="propTYpe">Property Type</label>
            <select  name="propType" class="form-control">
                <option selected>{{$properties->propertyType}}</option>
                <option>Land</option>
                <option>Company</option>
                <option>Hotel</option>
                <option>House</option>
            </select>
            
            <label for="staffrole">Size(Meter Squares)</label>
            <input type="number" id="sizeMS" name="sizeMS" value="{{$properties->sizeInMSFigures}}" class="form-control">

            <label for="staffrole">Size(Perch)</label>
            <input type="number" id="sizePerch" name="sizePerch" value="{{$properties->sizeInPerchFigures}}" class="form-control">

            <label for="taxDuty">Tax Duty</label><br>
            <input type="number" id="taxDuty" name="taxDuty" value="{{$properties->taxDuty}}" class="form-control">

            <label for="surveyorDate">Surveyor Date(Land Surveyor Report)</label>
            <input type="date" id="surveyorDate" name="surveyorDate" value="{{$properties->surveyorDate}}"class="form-control">
        
        </div>

        <div class="col-4">
            {{-- <h2>Details</h2> --}}
            <label for="tv">Transcription Volume</label>
            <input type="text" id="tv" name="tv" value="{{$properties->transcriptionVol}}" class="form-control">

            <label for="tv2">Second Transcription Volume </label>
            <input type="text" id="tv2" name="tv2" value="{{$properties->secTranscriptionVol}}" class="form-control">

            <label for="pinNum">PIN Number</label>
            <input type="number" id="pinNum" name="pinNum" value="{{$properties->pinNum}}"class="form-control">
        
            <label for="regLsNum">Reg Number(Land Surveyor Report)</label>
            <input type="text" id="regLsNum" name="regLsNum" value="{{$properties->regNumLSReport}}"class="form-control">


            <label for="surveyorTitle">Title(Land Surveyor)</label>
            <select  name="surveyorTitle" class="form-control">
                <option selected>{{$properties->surveyorTitle}}</option>
                <option>Monsieur</option>
                <option>Madame</option>
                <option>Mademoiselle</option>
            </select>

            <label for="surveyorFN">First Name(Land Surveyor)</label>
            <input type="text" id="surveyorFN" name="surveyorFN" value="{{$properties->surveyorFN}}"class="form-control">

            <label for="surveyorLN">Last Name(Land Surveyor)</label>
            <input type="text" id="surveyorLN" name="surveyorLN" value="{{$properties->surveyorLN}}"class="form-control">

            
        </div>

        <div class="col-4">
            
            <label for="firstDeedReg">1st Deed Registration</label>
            <input type="date" id="firstDeedReg" name="firstDeedReg" value="{{$properties->firstDeedRegistration}}"class="form-control">
            
            <label for="secDeedReg">2nd Deed Registration</label>
            <input type="date" id="secDeedReg" name="secDeedReg" value="{{$properties->secDeedRegistration}}"class="form-control">
            
            <label for="firstDeedGen">1st Deed Generation</label>
            <input type="date" id="firstDeedGen" name="firstDeedGen" value="{{$properties->firstDeedGeneration}}"class="form-control">

            <label for="prevNotaryFN">Previous Notary First Name</label>
            <input type="text" id="prevNotaryFN" class="form-control" name="prevNotaryFN" value="{{$properties->previousNotaryFN}}" >

            <label for="prevNotaryLN">Previous Notary Last Name</label>
            <input type="text" id="prevNotaryLN" class="form-control" name="prevNotaryLN" value="{{$properties->previousNotaryLN}}" >
            
            <label for="prevNotaryTitle">Previous Notary Title</label>
            <select  name="prevNotaryTitle" class="form-control">
                <option selected>{{$properties->previousNotaryTitle}}</option>
                <option>Monsieur</option>
                <option>Madame</option>
                <option>Mademoiselle</option>
            </select>

            <label for="distrctSituated">District Situated</label>
            <select  name="distrctSituated" class="form-control">
                <option selected>{{$properties->districtSituated}}</option>
                <option>Port Louis</option>
                <option>Moka</option>
                <option>Flacq</option>
                <option>Grand Port</option>
                <option>Pamplemousses</option>
                <option>Plaine Wilhems</option>
                <option>Rivière du Rempart</option>
                <option>Rivière Noire</option>
                <option>Savanne</option>
                </select>

                
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <input type="submit" value="Save Changes" class="btn btn-info btn-block">
        </div>
        <div class="col-4"></div>
    </div>
</form>
@endforeach
@endsection