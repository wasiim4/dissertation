@include('flashy::message')
@extends('layouts.stafflayout')
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
     {{-- <link rel="stylesheet" type="text/css" href="login.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('/css/register.css')}}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="icon" href="{{asset('images/addUser.png')}}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
        .header {
            width: 97.2%;
            margin-left:1.5%;
            background-color: #17a2b8;
            color: #ffffff;
            padding: 0px;
            font-size: 5px !important;
        }

    </style> 
</head>
   
@section('content')
    {{-- <div class="registerBox"> --}}
    {{-- <img src="{{ asset('images/avatar.png') }}" class="avatar"> --}}
    {{-- <a class="centerLink" href="{{ route('loginnew') }}">Already have an account?Login here!</a> --}}
    <div class="row">
            <div class="header">
                <div class="col-12">
                <h1 style="text-align:center;  margin-bottom: -1%;">Spouse Registration</h1>
                </div>
            </div>
            </div>
        {{-- <div class="container tableSpacor" style="border: 1mm ridge #212529;">
            <table id="tbluser" class="table table-hover " style="width:100%;">
                    <thead>
                        <tr>
                            <th>
                                ID
                             </th> 
                             <th>
                                NIC
                             </th>
                            <th>
                                First Name
                            </th> 
                            <th>
                                Last Name
                            </th>
                            <th>
                               Gender
                            </th> 
                            <th>
                                Roles
                            </th> 
                                 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr >
                            <td>    
                                {{$user->id}} 
                            </td>
                            <td>    
                                {{$user->nic}} 
                            </td>
                            <td>    
                                {{$user->firstname}} 
                            </td>
                            <td>
                                {{$user->lastname}}
                            </td>
                            
                            <td>
                                {{$user->gender}}
                            </td>

                            <td>
                                {{$user->roles}}
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
        <form method="POST" action="{{ route('add_spouse') }}" id="frmAddUser">
            @csrf
            <fieldset class="addUserFieldset">
                <legend class="addUserLegend"> Registration</legend>
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

                </div>
                
                
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputSpouseFirstName">First Name</label>
                    <input type="text" required class="form-control" name="inputSpouseFirstName" value="{{ old('inputSpouseFirstName') }}"  autofocus  placeholder="First Name">
                   
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputSpouseLastName">Last Name</label>
                    <input type="text" required class="form-control" name="inputSpouseLastName" value="{{ old('inputSpouseLastName') }}"  autofocus  placeholder="First Name">
                   
                  </div>
                  <div class="form-group col-md-1">
                    <label for="inputSpouseTitle">Title</label>
                    <select  name="inputSpouseTitle" class="form-control">
                    <option selected>Madame</option>
                    <option>Monsieur</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                        <label for="inputSpouseNIC">NIC Number</label>
                        <input type="text" required maxlength="14" class="form-control" name="inputSpouseNIC" value="{{ old('inputSpouseNIC') }}"  >
                        
                </div>
                {{-- <div class="form-group col-md-2">
                    <label for="inputClientID">Buyer/Seller ID</label>
                    <input type="number" required class="form-control" name="inputClientID" value="{{ old('inputClientID') }}"  autofocus>
                       
                </div> --}}
                <div class="form-group col-md-2">
                <label for="inputClientID">Buyer/Seller</label>
                <select name="inputClientID" id="inputClientID" class="form-control input-lg dynamic" data-dependent="firstname">
                 <option value="">Select id</option>
                 @foreach($users as $user)
                <option value="{{ $user->id}}">{{$user->id}}<?php echo"-"?>{{$user->firstname}}<?php echo" "?>{{$user->lastname}}</option>
                 @endforeach
                </select>
               </div>
          </div>

            <div class="form-row">
              <div class="form-group col-md-4">
              <label for="inputSpouseDob">Date of Birth</label>
              <input type="date"  required class="form-control " name="inputSpouseDob" value="{{ old('inputSpouseDob') }}"  autofocus  placeholder="Date of Birth"> 
            </div>
              
            
            <div class="form-group col-md-4">
                <label for="inputSpouseBcNum">Birth Certificate Number</label>
                <input type="number"  required class="form-control " name="inputSpouseBcNum" value="{{ old('inputSpouseBcNum') }}"  autofocus  placeholder=""> 
              </div>
       

        <div class="form-group col-md-4">
                <label for="inputDistrict">District Issued</label>
                <select  name="inputSpouseDistrict" class="form-control">
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
        </div>
            <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputSpouseMarriageDate">Date of Civil Marriage</label>
                        <input type="date"  required class="form-control " name="inputSpouseMarriageDate" value="{{ old('inputSpouseMarriageDate') }}"  autofocus  placeholder="Date of Civil Marriage"> 
                      </div>

                      <div class="form-group col-md-4">
                        <label for="inputMcNum">Marriage Certificate Number</label>
                        <input type="number"  required class="form-control " name="inputMcNum" value="{{ old('inputMcNum') }}"  autofocus  placeholder=""> 
                      </div>
               
        
                <div class="form-group col-md-4">
                        <label for="inputMcDistrict">District Issued</label>
                        <select  name="inputMcDistrict" class="form-control">
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
            </div>
                   
                
                
     

      <div class="form-row">
            <div class="form-group col-md-4">
                    <label for="inputSpouseProfession">Profession</label>
                    <input type="text" required  class="form-control" name="inputSpouseProfession" value="{{ old('inputSpouseProfession') }}"  >
            </div>

            
            <div class="form-group col-md-4">
                    <label for="inputSpouseGender">Gender</label>
                    <select  name="inputSpouseGender" class="form-control">
                    <option selected>Male</option>
                    <option>Female</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                        <label for="inputSpousePlaceOfBirth">Place of Birth</label>
                        <select  name="inputSpousePlaceOfBirth" class="form-control">
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
                    
            
      <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Add Spouse">
        </div>
        <div class="col-4"></div>
    </div>
            {{-- <button class="button">Add User</button>   --}}
            </fieldset>
          </form>
          {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Already have an account?Login here!') }}</a></a>|  <a class="centerLink" href="">Your password will be automatically generated and send to you by mail</a> --}}
    

@endsection

</html>