@include('flashy::message')
@extends('layouts.userlayout')
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
<a class="back-btn hvr-icon-pulse" href="/dashboard"><i class="fa fa-home hvr-icon"></i> Back</a>
<br><br>
<div class="header">
    <h1 style="text-align:center;">{{Auth::user()->firstname}} <?php echo(strtoupper(Auth::user()->lastname));?>-Profile</h1>
</div>

<form action="{{route('client.profileUpdate')}}" method="POST"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-4">
            <h2 style="text-align:right">Profile Picture</h2>   
            <img src="{{asset('/storage/images/'.$client_detail->img_path)}}" style="width:250px; height:250px;" class="rounded float-right" alt="...">  
            <br><br><br><br><br>
            <input type="file" id="fpropic" name="fpropic" accept="image/*" style="padding-left: 24%; margin-top:5%;" ><br><br>
        </div>

        <div class="col-4">
            {{-- <h2>Details</h2> --}}
            <label for="clientid">client ID</label>
            <input type="text" id="clientid" name="txtid" value="{{$client_detail->id}}" class="form-control"disabled><br>

            <label for="clientrole">Role</label><br>
            <input type="text" id="clientRole" name="txtrole" value="{{$client_detail->roles}}" class="form-control"disabled><br>

            

            <label for="fname">First Name</label>
            <input type="text" id="clientFname" name="txtfname" value="{{$client_detail->firstname}}"class="form-control">
        
            <label for="lname">Last Name</label>
            <input type="text" id="clientlname" name="txtlname" value="{{$client_detail->lastname}}"class="form-control">
        
            <label for="clientTitle">Gender</label>
            <select  name="txtgender" class="form-control">
                <option selected>{{$client_detail->gender}}</option>
                <option>Female</option>
                <option>Male</option>
            </select>
        
        </div>

        <div class="col-4">
            <label for="country">Email-Address</label>
            <input type="email" id="clientEmail" name="txtemail"class="form-control" value="{{$client_detail->email}}">

            <label for="contactNum">Contact Number</label>
            <input type="tel" id="clientContactNum" name="txtcnum" class="form-control"value="{{$client_detail->contactnum}}">

            <label for="dob">Date of Birth</label>
            <input type="date" id="clientDob" name="txtdob"class="form-control" value="{{$client_detail->dob}}" >

            <label for="nic">National Identity Card Number</label>
            <input type="text" maxlength="14" id="clientNic" class="form-control"name="txtnic" value="{{$client_detail->nic}}" >
            
            <label for="clientProfession">Profession</label>
            <input type="text"  id="clientProfession" class="form-control"name="txtprofession" value="{{$client_detail->profession}}" >
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <label for="clientTitle">Title</label>
            <select  name="txtTitle" class="form-control">
                <option selected>{{$client_detail->title}}</option>
                <option>Monsieur</option>
                <option>Madame</option>
                <option>Mademoiselle</option>
            </select>

            <label for="clientBCNum">Birth Certificate Number</label>
            <input type="text"  id="clientBCNum" class="form-control"name="txtBcNum" value="{{$client_detail->birthCertificateNumber}}" >
        </div>

        <div class="col-4">
            <label for="clientAddress">Address</label>
            <input type="text"  id="clientAddress" class="form-control"name="txtaddress" value="{{$client_detail->address}}" >
        
            <label for="inputDistrict">District Issued</label>
            <select  name="inputDistrict" class="form-control">
                <option selected>Port Louis</option>
                <option>Moka</option>
                <option>Flacq</option>
                <option>Grand Port</option>
                <option>Pamplemousses</option>
                <option>Plaine Wilhems</option>
                <option>Rivière du Rempart</option>
                <option>Rivière Noire</option>
                <option>Savanne</option>
            </select>
        </div>

        <div class="col-4">
            <label for="clientMarriageStatus">Status</label>
            <select  name="inputStatus" class="form-control">
                <option selected>{{$client_detail->marriageStatus}}</option>
                <option>Célibataire</option>
                <option>Mariés</option>
                <option >Divorcés</option>
                <option>Veuve</option>
                <option>Veuf</option>
            </select>

            <label for="inputPlaceOfBirth">Place of Birth</label>
            <select  name="inputPlaceOfBirth" class="form-control">
                <option selected>Dr Jeetoo Hospital</option>
                <option>Flacq Hospital</option>
                <option>J. Nehru Hospital </option>
                <option>Long Mountain Hospital </option>
                <option>Mahebourg Hospital</option>
                <option>Sir Seewoosagur Ramgoolam National Hospital</option>
                <option>Souillac Hospital</option>
                <option>City Clinic</option>
                <option>ABC Medi Clinic</option>
                <option>Chisty Shifa Clinic </option>
                <option>Clinique Darné </option>
                <option>Clinique Muller</option>
                <option>Clinique de Lorette</option>
                <option>Clinique du Centre</option>
                <option>Clinique du Nord</option>
                <option>Clinique Ferriere</option>
                <option>Clinique Medisave </option>
                <option>La Clinique Mauricienne </option>
                <option>Medicare Clinic</option>
                <option>Clinique du Bon Pasteur</option>
                <option>St Esprit Clinic</option>
                <option>St Jean Clinic</option>
                <option>Apollo Bramwell Hospital</option>
                <option>Wellkin Hospital</option>
            </select>
        </div>
    </div>
    <br>
    {{-- IF CLIENT IS MARRIED/DIVORCED/WIDOWER/WIDOW --}}
    @if($client_detail->marriageStatus=="Mariés" || $client_detail->marriageStatus=="Divorcés"|| $client_detail->marriageStatus=="Veuf"|| $client_detail->marriageStatus=="Veuve")
    <div class="header">
        <h1 style="text-align:center;">Spouse Details</h1>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
           
            <label for="clientSpouseFN"> First Name</label>
            <input type="text" id="clientSpouseFN" name="txtspousefn" value="{{$client_detail->spouseFirstname}}" class="form-control"><br>

            <label for="clientSpouseLN"> Last Name</label>
            <input type="text" id="clientSpouseLN" name="txtspouseln" value="{{$client_detail->spouseLastname}}" class="form-control"><br>

            <label for="spouseTitle">  Title</label>
            <select  name="txtspouseTitle" class="form-control">
                <option selected>{{$client_detail->spouseTitle}}</option>
                <option>Monsieur</option>
                <option>Madame</option>
            </select>

            <label for="clientTitle">Gender</label>
            <select  name="txtSpousegender" class="form-control">
                <option selected>{{$client_detail->spouseGender}}</option>
                <option>Female</option>
                <option>Male</option>
            </select>            
        
            <label for="inputDistrict"> District Issued(Marriage Certificate)</label>
            <select  name="inputMDistrict" class="form-control">
                <option selected>{{$client_detail->MCdistrictIssued}}</option>
                <option>Port Louis</option>
                <option>Moka</option>
                <option>Flacq</option>
                <option>Grand Port</option>
                <option>Pamplemousses</option>
                <option>Plaine Wilhems</option>
                <option>Rivière du Rempart</option>
                <option>Rivière Noire</option>
                <option>Savanne</option>
            </select>

            @if($client_detail->marriageStatus=="Divorcés")            
            <label for="inputDistrict"> District Issued(Divorce Certificate)</label>
            <select  name="inputDivDistrict" class="form-control">
                <option selected>{{$client_detail->MCdistrictIssued}}</option>
                <option>Port Louis</option>
                <option>Moka</option>
                <option>Flacq</option>
                <option>Grand Port</option>
                <option>Pamplemousses</option>
                <option>Plaine Wilhems</option>
                <option>Rivière du Rempart</option>
                <option>Rivière Noire</option>
                <option>Savanne</option>
            </select>
            @endif

            

            @if($client_detail->marriageStatus=="Veuf"||$client_detail->marriageStatus=="Veuve")            
            <label for="inputDistrict"> District Issued(Death Certificate)</label>
            <select  name="inputDeathDistrict" class="form-control">
                <option selected>{{$client_detail->MCdistrictIssued}}</option>
                <option>Port Louis</option>
                <option>Moka</option>
                <option>Flacq</option>
                <option>Grand Port</option>
                <option>Pamplemousses</option>
                <option>Plaine Wilhems</option>
                <option>Rivière du Rempart</option>
                <option>Rivière Noire</option>
                <option>Savanne</option>
            </select>
            @endif
        </div>
    
        <div class="col-4">

            <label for="dob">Date of Birth</label>
            <input type="date" id="clientDob" name="txtSpousedob"class="form-control" value="{{$client_detail->spouseDob}}" >

            <label for="nic">National Identity Card Number</label>
            <input type="text" maxlength="14" id="clientNic" class="form-control"name="txtSpousenic" value="{{$client_detail->spouseNic}}" >
            
            <label for="clientProfession">Profession</label>
            <input type="text"  id="clientProfession" class="form-control"name="txtSpouseProfession" value="{{$client_detail->spouseProfession}}" >
        
            <label for="clientBCNum">Marriage Certificate Number</label>
            <input type="text"  id="clientMCNum" class="form-control"name="txtMcNum" value="{{$client_detail->MCNumber}}" >
    
            {{-- <label for="dob">Account Creation</label>
            <input type="text" id="cerateDate" name="txtCrreateDate"class="form-control" value="{{$client_detail->created_at}}" disabled > --}}
        
            @if($client_detail->marriageStatus=="Divorcés")            
                <label for="clientDivCNum">Divorce Certificate Number</label>
                <input type="text"  id="clientDivCNum" class="form-control"name="txtDivCNum" value="{{$client_detail->birthCertificateNumber}}" >            
            
                <label for="dob">Account Creation</label>
                <input type="text" id="createDate" name="txtCreateDate"class="form-control" value="{{$client_detail->created_at}}" disabled >
            
                @elseif($client_detail->marriageStatus=="Mariés")
            
            {{-- <label for="dob">Account Creation</label> --}}
            {{-- <input type="text" id="cerateDate" name="txtCrreateDate"class="form-control" value="{{$client_detail->created_at}}" disabled > --}}
            
            @endif   
            
            @if($client_detail->marriageStatus=="Veuf" || $client_detail->marriageStatus=="Veuve")            
                <label for="clientDivCNum">Death Certificate Number</label>
                <input type="text"  id="clientDivCNum" class="form-control"name="txtDeathCNum" value="{{$client_detail->birthCertificateNumber}}" >            
            
                <label for="dob">Account Creation</label>
                <input type="text" id="cerateDate" name="txtCrreateDate"class="form-control" value="{{$client_detail->created_at}}" disabled >
            
                @elseif($client_detail->marriageStatus=="Mariés")
            
            <label for="dob">Account Creation</label>
            <input type="text" id="cerateDate" name="txtCrreateDate"class="form-control" value="{{$client_detail->created_at}}" disabled >
            
            @endif      
        </div>

        <div class="col-4">
            <label for="clientBCNum">Birth Certificate Number</label>
            <input type="text"  id="clientBCNum" class="form-control"name="txtSpouseBcNum" value="{{$client_detail->spouseBCNum}}" >

            <label for="inputDistrict">District Issued</label>
            <select  name="inputSpouseDistrict" class="form-control">
                <option selected>{{$client_detail->spouseBCdistrictIssued}}</option>
                <option>Port Louis</option>
                <option>Moka</option>
                <option>Flacq</option>
                <option>Grand Port</option>
                <option>Pamplemousses</option>
                <option>Plaine Wilhems</option>
                <option>Rivière du Rempart</option>
                <option>Rivière Noire</option>
                <option>Savanne</option>
            </select>

            <label for="inputPlaceOfBirth">Place of Birth</label>
            <select  name="inputSpousePlaceOfBirth" class="form-control">
                <option selected>{{$client_detail->spousePlaceOfBirth}}</option>
                <option >Dr Jeetoo Hospital</option>
                <option>Flacq Hospital</option>
                <option>J. Nehru Hospital </option>
                <option>Long Mountain Hospital </option>
                <option>Mahebourg Hospital</option>
                <option>Sir Seewoosagur Ramgoolam National Hospital</option>
                <option>Souillac Hospital</option>
                <option>City Clinic</option>
                <option>ABC Medi Clinic</option>
                <option>Chisty Shifa Clinic </option>
                <option>Clinique Darné </option>
                <option>Clinique Muller</option>
                <option>Clinique de Lorette</option>
                <option>Clinique du Centre</option>
                <option>Clinique du Nord</option>
                <option>Clinique Ferriere</option>
                <option>Clinique Medisave </option>
                <option>La Clinique Mauricienne </option>
                <option>Medicare Clinic</option>
                <option>Clinique du Bon Pasteur</option>
                <option>St Esprit Clinic</option>
                <option>St Jean Clinic</option>
                <option>Apollo Bramwell Hospital</option>
                <option>Wellkin Hospital</option>
            </select>

            <label for="dob">Marriage Date</label>
            <input type="date" id="clientMarriageDate" name="txtMarriageDate"class="form-control" value="{{$client_detail->marriageDate}}" >
        
            {{-- <br><br>
            <input type="submit" value="Save Changes" class="btn btn-info btn-block"> --}}
            @if($client_detail->marriageStatus=="Divorcés")            
                <label for="clientDivCNum">Divorce Date</label>
                <input type="date"  id="clientDivDate" class="form-control"name="txtDivDate" value="{{$client_detail->birthCertificateNumber}}" >            
            @endif 

            @if($client_detail->marriageStatus=="Veuf" || $client_detail->marriageStatus=="Veuve" )            
            <label for="clientDivCNum">Death Date</label>
            <input type="date"  id="clientSpouseDeathDate" class="form-control"name="txtSpouseDeathDate" value="{{$client_detail->birthCertificateNumber}}" >            
        @endif 
        </div>
    </div>
     @endif

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <input type="submit" value="Save Changes" class="btn btn-info btn-block">
        </div>
        <div class="col-4"></div>
    </div>
</form>
@endsection