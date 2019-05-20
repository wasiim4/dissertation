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
            <h1 style="text-align:center;">Property List</h1>
        </div>
    </div>
</div>
<br>
@if (Session::has('message'))
<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<div class="spacor1"></div>
<div class="row">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tblproperties" class="table table-hover " style="width:100%;">
                <thead>
                    <tr>
                        <th>
                            Property Id
                        </th> 
                        
                        <th>
                            Client Id
                        </th>
                        <th>
                            Type
                        </th> 
                        <th>
                           Address
                        </th> 
                        <th>
                            Size(Meter Squares)
                        </th>
                        <th>
                            District
                        </th>
                        <th>
                            Transcription Vol
                        </th>
                        <th>
                            Price(RS)
                        </th>
                        <th>
                            Registration Num
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach($properties as $property)
                        <tr >
                            <td>    
                                {{$property->propertyId}}
                            </td>
                            
                            <td>
                                {{$property->clientId}}
                            </td>
                            <td>
                                {{$property->propertyType}}
                            </td>
                            <td>
                                {{$property->address}}
                            </td>
                            <td>
                                {{$property->sizeInMSFigures}}
                            </td>
                            <td>
                                {{$property->districtSituated}}
                            </td>
                            <td>
                                {{$property->transcriptionVol}}
                            </td>
                            <td>
                                {{$property->priceInFigures}}
                            </td>
                            <td>
                                {{$property->regNumLSReport}}
                            </td>
                            <td>
                                {{-- Show Event Button --}}
                                    <a style="color:black;" href="/staff/show/property/{{$property->propertyId}}">
                                        <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="More details/Edit">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a> 
                                {{-- /Show Button --}}
                            |
                            
                                {{-- Delete  Button --}}
                                
                                    <a class="btndelevent" style="color:black;" href="/staff/property/delete/{{$property->propertyId}}">
                                        <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Delete">
                                            <i class="fas fa-trash-alt font-color"></i>
                                        </span>
                                    </a>
                                
                                {{-- /Delete User Button --}}
                            
                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div >


{{-- <footer>
    <img src="{{ asset('images/certificate.png') }}" class="footerlogo" alt="logo notary">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> NW Mauritius.
</footer> --}}
@endsection

