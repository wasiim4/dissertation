@include('flashy::message')
@extends('layouts.landSurveyorlayout')
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
{{-- BY Land surveyors --}}
<div class="row">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tbluser" class="table table-hover " style="width:100%;">
                <thead>
                    <tr>
                        <th>
                            Doc ID
                        </th> 
                        <th>
                            Sender Id
                        </th>
                        <th>
                           Sender Role
                        </th>
                        <th>
                            Doc Type
                        </th> 
                        <th>
                            Doc Name
                        </th> 
                        <th>
                            Uploaded At
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploads as $upload)
                        <tr >
                            <td>    
                                {{$upload->id}} 
                            </td>
                            <td>
                                {{$upload->senderId}}
                            </td>
                            <td>
                                {{$upload->senderRole}}
                            </td>
                            <td>
                                {{$upload->docType}}
                            </td>
                            <td>
                                {{$upload->docName}}
                            </td>
                            <td>
                                {{$upload->created_at}}
                            </td>
                            <td>
                                <a href="/storage/images/{{$upload->docName}}" download="{{$upload->docName}}">
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
</div >
<br>
           
{{-- BY Notary/Notary Assistant --}}
<div class="row ">
    <div class="col-12">
        <div class="container tableSpacor table-responsive " style="border: 2mm ridge #212529;" style="width:100%;">
            <table id="tblLs" class="table table-hover " style="width:100%;">
                <thead>
                    <tr>
                        <th>
                            Doc ID
                        </th> 
                        <th>
                            Party Id
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            Doc Type
                        </th> 
                        <th>
                            Doc Name
                        </th> 
                        <th>
                            Uploaded At
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploadsByNotary as $uploadsByNotaries)
                        <tr >
                            <td>    
                                {{$uploadsByNotaries->id}} 
                            </td>
                            <td>
                                {{$uploadsByNotaries->receiverId}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->receiverRole}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->docType}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->docName}}
                            </td>
                            <td>
                                {{$uploadsByNotaries->created_at}}
                            </td>
                            <td>
                                <a href="/storage/images/{{$uploadsByNotaries->docName}}" download="{{$uploadsByNotaries->docName}}">
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
</div >
@endsection