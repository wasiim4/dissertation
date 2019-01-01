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
        </style>
  </head>      

@section('content')
<h1 class="datatableTitleUsers"> Upload Contract</h1>
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
            <div class="row">
                <div class="col-6">
                    <label>Client Name</label>
                    <select name="inputClientName" id="inputClientName" class="form-control " >
                        <option value="">Select name</option>
                        @foreach($users as $user)
                       <option value="{{ $user->id}}">{{$user->id}}<?php echo"-"?>{{$user->firstname}}<?php echo" "?>{{$user->lastname}}<?php echo"-"?>{{$user->roles}}</option>
                        @endforeach
                       </select>                
                    </div>
                    <div class="col-6">
                        <label>Generated Contract</label>
                        <input type="file" accept=".pdf" id="contract"  name="contract" class="btn  btn-block"  >
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

    <ol>
        @foreach($transactions as $transaction)
    <li><a href="chrome-extension://oemmndcbldboiebfnladdacbdfmadadm/http://127.0.0.1:8000/staff/view/contract/{{$transaction->id}}" style="color:black;" target='_blank'>{{$transaction->name}}</a></li>

    {{-- <li><a href="http://127.0.0.1:8000/staff/view/contract/{{$transaction->id}}" style="color:black;" target='_blank'>{{$transaction->name}}</a></li> --}}
    {{-- <li><a href="/staff/view/contract".{{}} style="color:black;" target='_blank' class="download">{{$transaction->name}}</a></li> --}}

    @endforeach

    </ol>
@endsection