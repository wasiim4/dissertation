@include('flashy::message')
@extends('layouts.rgdlayout')
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
        width: 97.2%;
        margin-left:1.5%;
        background-color: #17a2b8;
        color: #ffffff;
        padding: 5px;
        font-size: 5px !important;
        }
        html {
        scroll-behavior: smooth;
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

    #content{
        width:105% !important;
    }
    </style>
</head>      

@section('content')
@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<br>
<div class="row">
        <div class="col-12">
            <div class="header">
                <h1 style="text-align:center; margin-bottom:-1%;">My Uploaded Documents</h1>
            </div>
        </div>
</div><br>
{{-- By RGD --}}
<div class="row">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tblMyDoc" class="table table-hover " style="width:100%;">
                <thead>
                    <th>
                        Document ID
                    </th>
                    <th>
                        Document Name
                    </th>
                    <th>
                        Document Type
                    </th>
                    <th>
                        Upload Date
                    </th>
                    <th>
                        Receiver Role
                    </th>
                    <th>
                        Receiver ID
                    </th>
                    <th>
                        Action
                    </th>
                </thead>
                <tbody>
                    @foreach($uploads as $upload)
                        <tr>
                            <td>
                                {{$upload->id}}
                            </td>
                            <td>
                                {{$upload->docName}}
                            </td>
                            <td>
                                {{$upload->docType}}
                            </td>
                            <td>
                                {{$upload->created_at}}
                            </td>
                            <td>
                                {{$upload->receiverRole}}
                            </td>
                            <td>
                                {{$upload->receiverId}}
                            </td>
                            <td>
                                <a href="/storage/images/{{$upload->docName}}" download="{{$upload->docName}}">
                                    <button type="button" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-download">
                                            Download
                                        </i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- BY EXTERNAL PARTIES --}}
<div class="row">
        <div class="col-12">
            <div class="header">
                <h1 style="text-align:center; margin-bottom:-1%;">Documents Uploaded By External Parties</h1>
            </div>
        </div>
</div><br>
<div class="row">
        <div class="col-12">
            <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
                <table id="tblExtParties" class="table table-hover " style="width:100%;">
                    <thead>
                        <th>
                            Document ID
                        </th>
                        <th>
                            Document Name
                        </th>
                        <th>
                            Document Type
                        </th>
                        <th>
                            Upload Date
                        </th>
                        <th>
                            Sender Role
                        </th>
                        <th>
                            Sender ID
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach($uploadExtParty as $uploadExtParties)
                         <tr>
                            <td>
                                {{$uploadExtParties->id}}
                            </td>
                            <td>
                                {{$uploadExtParties->docName}}
                            </td>
                            <td>
                                {{$uploadExtParties->docType}}
                            </td>
                            <td>
                                {{$uploadExtParties->created_at}}
                            </td>
                            <td>
                                {{$uploadExtParties->senderRole}}
                            </td>
                            <td>
                                {{$uploadExtParties->senderId}}
                            </td>
                            <td>
                                <a href="/storage/images/{{$uploadExtParties->docName}}" download="{{$uploadExtParties->docName}}">
                                    <button type="button" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-download">
                                            Download
                                        </i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection