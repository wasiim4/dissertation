@extends('layouts.rgdlayout')
<head>
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style4.css')}}">
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}"> --}}
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

  <style>
    #content {
    width: 106.5% !important;
    }
    .header {
    
      margin-left:1.5%;
      background-color: #17a2b8;
      color: #ffffff;
      padding: 5px;
      font-size: 5px !important;
    }

    html {
     scroll-behavior: smooth;
    }

    .isDisabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
  pointer-events: none;
}
  </style> 
  <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
  </script>
</head>

@section('content')
<div class="container">
  <div class="card" id="addMeeting">
    <div class="card-header card bg-primary text-white" style=" text-align:center;">Add Meeting</div>
      <div class="card-body">
          @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}
              <a href="http://127.0.0.1:8000/rgd/meetings" style="color:#155724; text-decoration:underline;" target="_blank">View in Calendar</a>
            </div>
          @endif

          <form action="{{route('rgd.meetings.add')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-3">
                <label for="partyId">Party ID</label>
                <select name="partyId" id="partyId" class="form-control " >
                  <option value="">Select name</option>
                  @foreach($staffs as $staff )
                    <option value="{{ $staff->id}}">{{$staff->firstname}}<?php echo" "?>{{$staff->lastname}}<?php echo"-"?>{{$staff->roles}}</option>
                  @endforeach 
                </select>   
              </div>

              <div class="col-3">
                <label for="meetingReason">Meeting Reason</label><br>
                <input type="text" id="meetingReason" name="meetingReason" value="" class="form-control"><br>
              </div>

              <div class="col-3">
                <label for="startTime">Start Time</label>
                <input type="datetime-local" id="startTime" name="startTime" value=""class="form-control"><br>
              </div>

              <div class="col-3">
                <label for="endTime">End Time</label>
                <input type="datetime-local" id="endTime" name="endTime" value=""class="form-control"><br>
              </div>
            </div>


            <div class="row">
              <div class="col-4"></div>
              <div class="col-4">
                <input type="submit" name="btnSubmit" class="btn btn-success btn-block" value="Add Meeting">
              </div>
              <div class="col-4"></div>
            </div>
          </form> 
      </div>  
  </div>
</div>
<br>

<div class="container">
  <div class="card">
    <div class="card-header card bg-primary text-white" style=" text-align:center;" >Meeting Request From Me</div>
    <div class="card-body">
      @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="container tableSpacor table-responsive "  style="width:100%;">
            <table id="tbluser" class="table table-hover " style="width:100%;">
              <thead>
                <tr>
                  <th>
                    ID
                  </th> 
                  <th>
                    Meeting Reason
                  </th>
                  <th>
                    Start Time
                  </th>
                  <th>
                    End Time
                  </th> 
                  <th>
                    Status
                  </th>
                  <th>
                    Party
                  </th>                   
                  <th>
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($meetings as $meeting)
                  <tr>
                    <td>    
                      {{$meeting->id}} 
                    </td>
                    <td>
                      {{$meeting->meetingReason}}
                    </td>
                    <td>
                      {{$meeting->startTime}}
                    </td>
                    <td>
                      {{$meeting->endTime}}
                    </td>
                    <td>
                      {{$meeting->meetingStatus}}
                    </td>
                    <td>
                      {{$meeting->partyRole}}
                    </td>
                    <td>
                      {{-- Show Event Button --}}
                      <a style="color:#007bff;" href="/rgd/meeting/cancel/{{$meeting->id}}">
                        <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Cancel Meeting">
                          <i class="fas fa-times"></i>
                      </span>
                      {{-- /Show Button --}}
                        |
                      {{-- Delete User Button --}}
                        <a class="btndelevent" style="color:red;" href="/rgd/meeting/delete/{{$meeting->id}}">
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
            <a style="color:green;font-size: 411%;    padding-left: 46%;" href="#addMeeting">
              <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="Add Meeting">
                <i class="fas fa-calendar-plus"></i>
              </span>
            </a> 
          </div>
        </div>
      </div >
    </div> 
  </div>
</div>
<br>
 {{-- MEETING REQUEST FROM NOTARY --}}
<div class="container">
    <div class="card">
      <div class="card-header card bg-primary text-white" style=" text-align:center;" >Meeting Request From Notary</div>
      <div class="card-body">
        @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="container tableSpacor table-responsive "  style="width:100%;">
              <table id="tbluser" class="table table-hover " style="width:100%;">
                <thead>
                  <tr>
                    <th>
                      ID
                    </th> 
                    <th>
                      Meeting Reason
                    </th>
                    <th>
                      Start Time
                    </th>
                    <th>
                      End Time
                    </th> 
                    <th>
                      Status
                    </th>
                    <th>
                      Party
                    </th>                   
                    <th>
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($meetingByNotary as $meetingByNotarys)
                    <tr>
                      <td>    
                        {{$meetingByNotarys->id}} 
                      </td>
                      <td>
                        {{$meetingByNotarys->meetingReason}}
                      </td>
                      <td>
                        {{$meetingByNotarys->startTime}}
                      </td>
                      <td>
                        {{$meetingByNotarys->endTime}}
                      </td>
                      <td>
                        {{$meetingByNotarys->meetingStatus}}
                      </td>
                      <td>
                        {{$meetingByNotarys->partyRole}}
                      </td>
                      <td>
                        {{-- Show Event Button --}}
                        <a style="color:#007bff;" href="/rgd/meeting/cancel/{{$meetingByNotarys->id}}">
                          <span style="border-bottom:none" data-toggle="tooltip" data-placement="top"tabindex="1" title="Cancel Meeting">
                            <i class="fas fa-times"></i>
                        </span>
                        {{-- /Show Button --}}
                          |
                        {{-- Delete User Button --}}
                          <a class="btndelevent" style="color:red;" href="/rgd/meeting/delete/{{$meetingByNotarys->id}}">
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
              <a style="color:green;font-size: 411%;    padding-left: 46%;" href="#addMeeting">
                <span data-toggle="tooltip"  data-placement="top" style="border-bottom:none" title="Add Meeting">
                  <i class="fas fa-calendar-plus"></i>
                </span>
              </a> 
            </div>
          </div>
        </div >
      </div> 
    </div>
  </div>
@endsection