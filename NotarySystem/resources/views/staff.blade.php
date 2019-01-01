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
<div class="row">
<div class="col-12">
<div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
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
                    <a style="color:black;" href="/staff/show/client/{{$user->id}}">
                        <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="More details">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a> 
                {{-- /Show Button --}}
               |
                {{-- Edit User Button --}}
                <a class="editbtn" style="color:black;"  data-toggle="modal" data-target="#editusermod" data-mycontactnum="{{$user->contactnum}}" data-myfirstname="{{$user->firstname}}" data-mylastname="{{$user->lastname}}" data-myemail="{{$user->email}}" data-userid="{{$user->id}}" >
                        <span style="border-bottom:none" data-tooltip tabindex="1" title="Edit">
                            <i class="fas fa-pencil-alt font-color"></i> 
                        </span>
                    </a>
                {{-- /Edit User Button --}}
                |
                {{-- Delete User Button --}}
                   
                        <a class="btndelevent" style="color:black;" href="/staff/client/delete/{{$user->id}}">
                            <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                                <i class="fas fa-trash-alt font-color"></i>
                            </span>
                        </a>
                   
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
</div >
    <!-- The Modal -->
  <div class="modal fade" id="editusermod">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Client Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                    <form action="" method="POST"  enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        
                    <div class="col-6">
                      {{-- <h2>Details</h2> --}}
                            <label for="staffid">Client ID</label>
                            <input type="text" id="satffId" name="txtid" value="{{$user->id}}" disabled class="form-control"disabled><br>
                
                            <label for="staffrole">Role</label><br>
                            <input type="text" id="satffRole" name="txtrole" value="{{$user->roles}}"disabled class="form-control"disabled><br>
                
                            <label for="staffTitle">Title</label>
                            <select  name="txtTitle" class="form-control" disabled >
                                <option selected>{{$user->title}}</option>
                                <option>Monsieur</option>
                                <option>Madame</option>
                                <option>Mademoiselle</option>
                             </select>
                
                            <label for="fname">First Name</label>
                            <input type="text" id="staffFname" name="txtfname" disabled value="{{$user->firstname}}"class="form-control">
                        
                            <label for="lname">Last Name</label>
                            <input type="text" id="stafflname" name="txtlname" disabled value="{{$user->lastname}}"class="form-control">
                    </div>
                
                    <div class="col-6">
                              <label for="country">Email-Address</label>
                              <input type="email" id="staffEmail" name="txtemail" disabled class="form-control" value="{{$user->email}}">
                
                              <label for="contactNum">Contact Number</label>
                              <input type="tel" id="staffContactNum" name="txtcnum" disabled class="form-control"value="{{$user->contactnum}}">
                
                              <label for="dob">Date of Birth</label>
                              <input type="date" id="satffDob" name="txtdob"  disabled class="form-control" value="{{$user->dob}}" >
                
                              <label for="nic">National Identity Card Number</label>
                              <input type="text" maxlength="14" id="satffNic" disabled class="form-control"name="txtnic" value="{{$user->nic}}" >
                              
                              <label for="staffTitle">Title</label>
                              <select  name="txtgender" class="form-control" disabled >
                                <option selected>{{$user->gender}}</option>
                                <option>Female</option>
                                <option>Male</option>
                              </select>
                    </div>
                    
                
                </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
      </div>
      <script>
            $('.editbtn').on('click', function (event) {
                var fname = $(this).attr("data-myfirstname");
                var lname = $(this).attr("data-mylastname");
                var email = $(this).attr("data-myemail");
                var cnum = $(this).attr("data-mycontactnum");
                var userid = $(this).attr("data-userid");
            
                $('#firstname').val(fname);
                $('#email').val(email);
                $('#lastname').val(lname);
                $('#contactnum').val(cnum);
                $('#userid').val(userid);
            });
            </script>
{{-- <footer>
    <img src="{{ asset('images/certificate.png') }}" class="footerlogo" alt="logo notary">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> NW Mauritius.
 </footer> --}}
@endsection

