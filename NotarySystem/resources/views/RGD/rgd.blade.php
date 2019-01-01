@include('flashy::message')
@extends('layouts.rgdlayout')
<head>
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
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
{{-- <button class="button" style="vertical-align:middle"><span>Back </span> --}}
    {{-- <a class="back-btn hvr-icon-pulse" href="/dashboard"><i class="fa fa-home hvr-icon"></i> Back</a> --}}
    {{-- <h4 class="datatableTitleUsers" style="text-align:center;">Client List</h4> --}}
    <div class="row">
            <div class="header">
                <div class="col-12">
                <h1 style="text-align:center;">List of Clients</h1>
                </div>
            </div>
            </div>
   
    <div class="spacor1"></div>
<div class="row>"
<div class="col-12">
<div class="container tableSpacor" style="border: 2mm ridge #212529;">
<table id="tbluser" class="table table-hover " style="width:100%;">
    <thead>
        <tr>
            <th>
                First Name
            </th> 
            <th>
                Last Name
            </th>
            <th>
                Date of Birth
            </th>
            <th>
                Email-Address
            </th> 
            <th>
                Contact Number
            </th> 
            <th>
             Role
            </th>
            <th>
                Status
            </th>
            <th>
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr >
            <td>    
                {{$user->firstname}} 
            </td>
            <td>
                {{$user->lastname}}
            </td>
            <td>
                {{$user->dob}}
            </td>
            <td>
                {{$user->email}}
            </td>
            <td>
                {{$user->contactnum}}
            </td>
            <td>
                {{$user->roles}}
            </td>
            <td>
                    {{$user->marriageStatus}}
                </td>
            <td>
                {{-- Show Event Button --}}
                    {{-- <a href="/usersfound/show/{{$user->id}}"> --}}
                        <span data-toggle="tooltip" data-placement="top" style="border-bottom:none" title="More details">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a> 
                {{-- /Show Button --}}
               |
                {{-- Edit User Button --}}
                    {{-- <a class="editbtn" data-open="editusermod" data-mycontactnum="{{$user->contactnum}}" data-myfirstname="{{$user->firstname}}" data-mylastname="{{$user->lastname}}" data-myemail="{{$user->email}}" data-userid="{{$user->id}}" data-target="#editusermod"> --}}
                        <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"  title="Edit">
                            <i class="fas fa-pencil-alt font-color"></i> 
                        </span>
                    </a>
                {{-- /Edit User Button --}}
               |
                
                {{-- Delete User Button --}}
                    @if ($user->id== Auth::id()) 
                        <a style="color:black;" class="btndelevent not-active-link disabled" href="/usersfound/delete/{{$user->id}}">
                            <span style="border-bottom:none" data-toggle="tooltip" data-placement="top" tabindex="1" title="Delete">
                                <i class="fas fa-trash-alt font-color"></i>
                            </span>
                        </a>
                    @else
                        <a class="btndelevent" href="/usersfound/delete/{{$user->id}}">
                            <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                                <i class="fas fa-trash-alt font-color"></i>
                            </span>
                        </a>
                    @endif
                {{-- /Delete User Button --}}
              |
                {{-- Show transactions Button --}}
                    {{-- <a href="/usersfound/show/{{$user->id}}"> --}}
                        <span data-toggle="tooltip" data-placement="top" tabindex="1" style="border-bottom:none" title="Transactions">
                            <i class="fas fa-handshake"></i>
                        </span>
                    </a> 
                {{-- /Show Button --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
<div >
{{-- <footer>
    <img src="{{ asset('images/certificate.png') }}" class="footerlogo" alt="logo notary">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> NW Mauritius.
 </footer> --}}
@endsection

