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
    <script src="{{url('js/bootstrap.min.js')}}"></script>

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
                <h1 style="text-align:center;  margin-bottom: -1%;">Client Registration</h1>
                </div>
            </div>
            </div>

        <form method="POST" action="{{ route('add_user') }}" id="frmAddUser">
            @csrf
            <fieldset class="addUserFieldset">
                <legend class="addUserLegend">Registration</legend>
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
                <div class="form-group col-md-4">
                    <label for="inputFirstName">First Name</label>
                    <input type="text" required class="form-control" name="inputFirstName" value="{{ old('inputFirstName') }}"  autofocus  placeholder="First Name">
                   
                  </div>
                <div class="form-group col-md-4">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" required  class="form-control" name="inputLastName" value="{{ old('inputLastName') }}" autofocus placeholder="Last Name">
                </div>

                <div class="form-group col-md-4">
                    <label for="inputTitle">Title</label>
                    <select  name="inputTitle" class="form-control">
                    <option selected>Monsieur</option>
                    <option>Madame</option>
                    <option>Mademoiselle</option>
                    </select>
                </div>
                
             </div>

            <div class="form-row">  
            <div class="form-group col-md-4">
              <label for="inputDob">Date of Birth</label>
              <input type="date"  required class="form-control " name="inputDob" value="{{ old('inputDob') }}"  autofocus  placeholder="Date of Birth"> 
            </div>

            <div class="form-group col-md-4">
                    <label for="inputBcNum">Birth Certificate Number</label>
                    <input type="number"  required class="form-control " name="inputBcNum" value="{{ old('inputBcNum') }}"  autofocus  placeholder=""> 
                  </div>
           

            <div class="form-group col-md-4">
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
            </div>
            <div class="form-row">
                    <div class="form-group col-md-4">
                            <label for="inputEmail4">Email</label>
                            <input type="email" required class="form-control " name="inputEmail" value="{{ old('inputEmail') }}"  autofocus  placeholder="someone@example.com"> 
                          </div>
                      <div class="form-group col-md-4">
                        <label for="inputContactNum4">Contact Number</label>
                        <input type="tel" required  value="{{ old('inputContactNum') }}"  title="8 digits code only and starting with number '5'." class="form-control" name="inputContactNum"  >
                      </div>

                    <div class="form-group col-md-4">
                        <label for="inputGender">Gender</label>
                        <select  name="inputGender" class="form-control">
                        <option selected>Male</option>
                        <option>Female</option>
                        </select>
                    </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputNIC1">NIC Number</label>
                  <input type="text" required maxlength="14" class="form-control" name="inputNIC1" value="{{ old('inputNIC1') }}"  >
                  
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress">Address</label>
                    <textarea rows="1" cols="50" type="text" required  class="form-control" name="inputAddress" value="{{ old('inputAddress') }}"  ></textarea>
                   
                  </div>
                  <div class="form-group col-md-4">
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
      
      <div class="form-row">
            <div class="form-group col-md-4">
                    <label for="inputProfession">Profession</label>
                    <input type="text" required  class="form-control" name="inputProfession" value="{{ old('inputProfession') }}"  >
            </div>

            <div class="form-group col-md-4">
                <label for="inputRoles">Roles</label>
                <select  name="inputRoles" class="form-control">
                    <option >acquéreur</option>
                    <option>vendeurs</option>
                    <option >Buyer_Spouse</option>
                    <option>Seller_Spouse</option>
                    <option >Children</option>
                    <option>Partegeant</option>
                    <option>co_partageants</option>
                </select>
            </div>
            
            <div class="form-group col-md-4">
                <label for="inputMarriageStatus">Marriage Status</label>
                <select  name="inputMarriageStatus" class="form-control">
                <option selected>Célibataire</option>
                <option>Mariés</option>
                <option >Divorcés</option>
                <option>Veuve</option>
                <option>Veuf</option>
                </select>
            </div>
      </div>
            
           <div class="row">
               <div class="col-4"></div>
               <div class="col-4">
            <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Register">
               </div>
               <div class="col-4"></div>
           </div>
            {{-- <button class="button">Add User</button>   --}}
            </fieldset>
          </form>
          {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Already have an account?Login here!') }}</a></a>|  <a class="centerLink" href="">Your password will be automatically generated and send to you by mail</a> --}}
        </div>

@endsection

</html>