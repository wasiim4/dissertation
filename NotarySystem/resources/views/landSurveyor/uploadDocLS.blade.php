@include('flashy::message')
@extends('layouts.landSurveyorlayout')
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

        #content {
            width: 117% !important;
        }
    </style>
</head>      

@section('content')
<div class="row">
        <div class="col-12">
            <div class="header">
                <h1 style="text-align:center; margin-bottom:-1%;">Upload Document</h1>
            </div>
        </div>
</div>
<form method="POST" action="{{ route('ls.show.UploadDocs') }}" id="frmAddUser" files="true" enctype="multipart/form-data">
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
            <br>
            <div class="row">
                <div class="col-6">
                    <label>Document Type</label>
                    <select name="inputDocType" id="inputDocType" class="form-control " >
                        <option value="">Select type</option> 
                        <option >Birth Certificate</option>
                        <option>Spouse Birth Certificate</option>
                        <option >Marriage Certificate</option>
                        <option>Divorce Certificate</option>
                        <option >NIC</option>
                        <option>Spouse NIC</option>
                        <option>Site Plan</option>
                        <option>Title Deed</option>
                        <option>Surveyor Report</option>
                    </select>                
                </div>
                <div class="col-6">
                    <label>Document</label>
                    <input type="file"  id="document"  name="document" class="btn  btn-block"  >
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
@endsection