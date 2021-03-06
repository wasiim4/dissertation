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
    .header {
    width: 97.2%;
    margin-left:1.5%;
    background-color: #17a2b8;
    color: #ffffff;
    padding: 5px;
    font-size: 5px !important;
    }

    #content{
         width:106.9% !important;
        }
    </style> 
     
</head>
        
@section('content')
<div class="row">
    <div class="header">
        <div class="col-12">
            <h1 style="text-align:center;">List of Transactions</h1>
        </div>
    </div>
</div>

<div class="spacor1"></div>
<div class="row">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tblUsertransaction" class="table table-hover " style="width:100%;">
                <thead>
                    <tr>
                        <th>
                            Transaction ID
                        </th> 
                        <th>
                            Property Id
                         </th> 
                        <th>
                            Contract
                        </th>
                        <th>
                            Uploaded Time
                        </th>
                        
                        <th>
                            Fees()
                        </th>
                        <th>
                            Fees Status
                        </th>
                        <th>
                            Staff Id
                        </th>
                        <th>
                           Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr >
                            <td>    
                                {{$transaction->id}} 
                            </td>
                            <td>    
                                {{$transaction->propertyId}} 
                            </td>
                            <td>
                                {{$transaction->contractName}}
                            </td>
                            <td>
                                {{$transaction->created_at}}
                            </td>
                            <td>
                                {{$transaction->fees}}
                            </td>
                            <td>
                                {{$transaction->feeStatus}}
                            </td>  
                            <td>
                                {{$transaction->staffId}}
                            </td>                 
                            <td>
                                <a href="/storage/images/{{$transaction->contractName}}" download="{{$transaction->contractName}}">
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