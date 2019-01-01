@include('flashy::message')
@extends('layouts.stafflayout')
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
    <div class="col-12">
    <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
    <table id="tbluser" class="table table-hover " style="width:100%;">
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
            @foreach($documents as $document)
            <tr >
                <td>    
                    {{$document->id}} 
                </td>
                <td>
                    {{$document->partyId}}
                </td>
                <td>
                    {{$document->partyRole}}
                </td>
                <td>
                    {{$document->docType}}
                </td>
                <td>
                    {{$document->docName}}
                </td>
                <td>
                    {{$document->created_at}}
                </td>
                <td>
                    <a href="/storage/images/{{$document->docName}}" download="{{$document->docName}}">
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