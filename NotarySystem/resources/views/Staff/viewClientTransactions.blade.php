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
             html {
             scroll-behavior: smooth;
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
                <table id="clientTransactionList" class="table table-hover " style="width:100%;">
                    <thead>
                        <tr>
                            <th>
                            Transaction ID
                            </th> 
                            <th>
                            Contract
                            </th>
                            <th>
                            Uploaded Time
                            </th>
                            
                            <th>
                                Fees(RS)
                            </th>
                            <th>
                                Fees Status
                            </th>
                            <th>
                                Type
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
                                    {{$transaction->transactionType}}
                                </td>                 
                                <td>
                                    <a  style="color:blue;" href="/storage/images/{{$transaction->contractName}}" download="{{$transaction->contractName}}">
                                        {{-- <button type="button" class="btn btn-primary"> --}}
                                                <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Download Contract">
    
                                            <i class="fas fa-arrow-circle-down"></i>
                                            {{-- Download --}}
                                        {{-- </i> --}}
                                        {{-- </button> --}}
                                    </a> |
                                    <a class="btndelevent" style="color:red;" href="/staff/transaction/delete/{{$transaction->id}}">
                                        <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                                          <i class="fas fa-trash-alt font-color"></i>
                                        </span>
                                      </a>
                                     |
                                    <a class="btndelevent" style="color:green;font-size: x-large;" href="/staff/transaction/update/{{$transaction->id}}">
                                        <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Update payment">
                                                <i class="fas fa-hand-holding-usd"></i>
                                        </span>
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