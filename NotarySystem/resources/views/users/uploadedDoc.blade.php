@include('flashy::message')
@extends('layouts.userlayout')
<head>
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
        #content{
         width:105% !important;
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
    </style> 

</head>
@section('content')
<div class="row">
    <div class="col-12">
        <div class="header">
            <h1 style="text-align:center;">My Uploaded Document</h1>
        </div>
    </div>
</div>
{{-- BY CLIENT --}}
<div class="row">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tbluser" class="table table-hover " style="width:100%;">
                <thead>
                    <tr>
                        <th>
                            Doc ID
                        </th> 
                        <th>
                            Sender Id
                        </th>
                        <th>
                           Sender Role
                        </th>
                        <th>
                            Doc Type
                        </th> 
                        <th>
                            Doc Name
                        </th> 
                        <th>
                            Uploaded At
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploads as $upload)
                        <tr >
                            <td>    
                                {{$upload->id}} 
                            </td>
                            <td>
                                {{$upload->senderId}}
                            </td>
                            <td>
                                {{$upload->senderRole}}
                            </td>
                            <td>
                                {{$upload->docType}}
                            </td>
                            <td>
                                {{$upload->docName}}
                            </td>
                            <td>
                                {{$upload->created_at}}
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
</div >
<br>
<div class="row">
    <div class="col-12">
        <div class="header">
            <h1 style="text-align:center;">Documents uploaded by Notary</h1>
        </div>
    </div>
</div>      
{{-- BY Notary/Notary Assistant --}}
<div class="row ">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tblUsertransaction" class="table table-hover " style="width:100%;">
                <thead>
                    <tr>
                        <th>
                            Doc ID
                        </th> 
                        <th>
                            Party Id
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            Doc Type
                        </th> 
                        <th>
                            Doc Name
                        </th> 
                        <th>
                            Uploaded At
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploadsByNotary as $uploadsByNotaries)
                        <tr >
                            <td>    
                                {{$uploadsByNotaries->id}} 
                            </td>
                            <td>
                                {{$uploadsByNotaries->receiverId}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->senderRole}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->docType}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->docName}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->created_at}}
                            </td>
                            <td>
                                <a href="/storage/images/{{$uploadsByNotaries->docName}}" download="{{$uploadsByNotaries->docName}}">
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
</div >
@endsection