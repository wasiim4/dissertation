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
        <h1 style="text-align:center;">{{$users->firstname}} <?php echo(strtoupper($users->lastname));?>-Profile</h1>
    </div>

    <form action="" method="POST"  enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-3">
            <h2 style="text-align:right">Profile Picture</h2>   
            <img src="{{asset('/storage/images/'.$users->img_path)}}" style="width:250px; height:250px;" class="rounded float-right" alt="...">  
            <br><br><br><br><br>
            {{-- <input type="file" id="fpropic" name="fpropic" accept="image/*" style="padding-left: 24%; margin-top:5%;" ><br><br> --}}
        
        </div>

    <div class="col-3">
      {{-- <h2>Details</h2> --}}
            <label for="staffid">Client ID</label>
            <input type="text" id="satffId" name="txtid" value="{{$users->id}}" disabled class="form-control"disabled><br>

            <label for="staffrole">Role</label><br>
            <input type="text" id="satffRole" name="txtrole" value="{{$users->roles}}"disabled class="form-control"disabled><br>

            <label for="staffTitle">Title</label>
            <select  name="txtTitle" class="form-control" disabled >
                <option selected>{{$users->title}}</option>
                <option>Monsieur</option>
                <option>Madame</option>
                <option>Mademoiselle</option>
             </select>

            <label for="fname">First Name</label>
            <input type="text" id="staffFname" name="txtfname" disabled value="{{$users->firstname}}"class="form-control">
        
            <label for="lname">Last Name</label>
            <input type="text" id="stafflname" name="txtlname" disabled value="{{$users->lastname}}"class="form-control">
    </div>

    <div class="col-3">
              <label for="country">Email-Address</label>
              <input type="email" id="staffEmail" name="txtemail" disabled class="form-control" value="{{$users->email}}">

              <label for="contactNum">Contact Number</label>
              <input type="tel" id="staffContactNum" name="txtcnum" disabled class="form-control"value="{{$users->contactnum}}">

              <label for="dob">Date of Birth</label>
              <input type="date" id="satffDob" name="txtdob"  disabled class="form-control" value="{{$users->dob}}" >

              <label for="nic">National Identity Card Number</label>
              <input type="text" maxlength="14" id="satffNic" disabled class="form-control"name="txtnic" value="{{$users->nic}}" >
              
              <label for="staffTitle">Title</label>
              <select  name="txtgender" class="form-control" disabled >
                <option selected>{{$users->gender}}</option>
                <option>Female</option>
                <option>Male</option>
              </select>
    </div>
    <div class="col-3">
        {{-- <input type="submit" value="Save Changes" class="btn btn-info btn-block"  > --}}
    </div>

</div>
</form>


@endsection