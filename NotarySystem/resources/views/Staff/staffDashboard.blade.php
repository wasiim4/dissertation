@extends('layouts.stafflayout')

  <head>
    <title>Staff Dashboard</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link rel="stylesheet"  id="main-stylesheet" data-version="1.1.0" type="text/css" href="{{asset('css/shards-dashboards.1.1.0.min.css')}}">
    <link rel="stylesheet"  type="text/css" href="{{asset('css/extras.1.1.0.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style4.css')}}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <style>
      #content{
        width: 100.2% !important;
      }
      .clockStyle {
        background-color:#fff;
        padding:6px;
        color:black;
        font-family:"Arial Black", Gadget, sans-serif;
        font-size:30px;
        font-weight:bold;
        letter-spacing: 2px;
        display:inline;
      }

      .blink{
		text-align: center;
	
	}
	.spanBlink{
		font-size: 25px;
		animation: blink 1s linear infinite;
	}
@keyframes blink{
0%{opacity: 0;}
50%{opacity: .5;}
100%{opacity: 1;}
}
    </style>
   
   <script>
      setTimeout(function(){
          window.location.reload(1);
       }, 300000);
       </script> 
      
  </head>
  @section('content')
  
   <div class="row">
     <div class="col-5"></div>
     <div class="col-3">
        <div id="clockDisplay" class="clockStyle"></div>
          <script>
            function renderTime() {
              var currentTime = new Date();
              var diem = "AM";
              var h = currentTime.getHours();
              var m = currentTime.getMinutes();
              var s = currentTime.getSeconds();
              setTimeout('renderTime()',1000);
                if (h == 0) {
                  h = 12;
                } 
                else if (h > 12) { 
                 h = h - 12;
                 diem="PM";
                }
                if (h < 10) {
                 h = "0" + h;
                }
                if (m < 10) {
                  m = "0" + m;
                }
                if (s < 10) {
                 s = "0" + s;
                }
                var myClock = document.getElementById('clockDisplay');
                myClock.textContent = h + ":" + m + ":" + s + " " + diem;
                myClock.innerText = h + ":" + m + ":" + s + " " + diem;
            }
            renderTime();
        </script>
     </div>
     <div class="col-2"></div>
     <div class="col-2"></div>
   </div>
  <br>
    <div class="main-content-container container-fluid px-4">         
      <!-- Small Stats Blocks -->
      <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
          <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                <a href="/staff"> <span class="stats-small__label text-uppercase">Clients</span></a>
                <h6 class="stats-small__value count my-3">{{$numClients}}</h6>
                </div>
                
              </div>
              <canvas height="120" class="blog-overview-stats-small-1"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
          <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                  <a href="/staff/transactions/list"><span class="stats-small__label text-uppercase">Transactions</span></a>
                <h6 class="stats-small__value count my-3">{{$numTransactions}}</h6>
                </div>
                
              </div>
              <canvas height="120" class="blog-overview-stats-small-2"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
          <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                  <a href="/staff/list/properties"><span class="stats-small__label text-uppercase">Immovable Properties</span></a>
                <h6 class="stats-small__value count my-3">{{$numProperties}}</h6>
                </div>
                
              </div>
              <canvas height="120" class="blog-overview-stats-small-3"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
          <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                  <a href="/staff/meetings"><span class="stats-small__label text-uppercase">Meetings</span></a>
                <h6 class="stats-small__value count my-3">{{$numMeetings}}</h6>
                </div>
                
              </div>
              <canvas height="120" class="blog-overview-stats-small-4"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg col-md-4 col-sm-12 mb-4">
          <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
                <div class="stats-small__data text-center">
                  <a href="/staff/view/download/uploaded/documents"><span class="stats-small__label text-uppercase">Documents</span></a>
                <h6 class="stats-small__value count my-3">{{$numDocuments}}</h6>
                </div>
                
              </div>
              <canvas height="120" class="blog-overview-stats-small-5"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- End Small Stats Blocks -->
      <div class="row">
          <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                  <a href="/staff/registernew"> <span class="stats-small__label text-uppercase"> New Client</span></a>
                  <h6 class="stats-small__value count my-3"><i class="fas fa-user-plus" style="color:#17a2b8;"></i></h6>
                  </div>
                  
                </div>
                <canvas height="120" class="blog-overview-stats-small-1"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <a href="/staff/upload/contract"><span class="stats-small__label text-uppercase"> New Transaction</span></a>
                  <h6 class="stats-small__value count my-3"><i class="fas fa-hand-holding-usd" style="color:#17a2b8;"></i></h6>
                  </div>
                  
                </div>
                <canvas height="120" class="blog-overview-stats-small-2"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <a href="/staff/propertyRegistration"><span class="stats-small__label text-uppercase">New Property</span></a>
                  <h6 class="stats-small__value count my-3"><i class="fas fa-building" style="color:#17a2b8;"></i></h6>
                  </div>
                  
                </div>
                <canvas height="120" class="blog-overview-stats-small-3"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <a href="/staff/meeting/add/del/up"><span class="stats-small__label text-uppercase">New Meeting</span></a>
                  <h6 class="stats-small__value count my-3">  <i class="fas fa-calendar-alt" style="color:#17a2b8;"></i></h6>
                  </div>
                  
                </div>
                <canvas height="120" class="blog-overview-stats-small-4"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg col-md-4 col-sm-12 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <a href="/staff/upload/documents"><span class="stats-small__label text-uppercase">New Upload</span></a>
                  <h6 class="stats-small__value count my-3"> <i class="fas fa-upload" style="color:#17a2b8;"></i></h6>
                  </div>
                  
                </div>
                <canvas height="120" class="blog-overview-stats-small-5"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="row">   
          <div class="col-4">
              <div class="container">               
                  <div class="card">
                    <div class="card-header stats-small__label text-uppercase" style="text-align:center;color:#818ea3;font-size:15px;">Pending Meetings <i style="color:red;" class="fas fa-circle"></i></div>
                    <div class="card-body blink" style="text-align:center;color:#17a2b8;font-size:15px;">
                      @if($pendingMeetings==0)
                      <span >{{$pendingMeetings}}</span>
                      @endif
                      @if($pendingMeetings>0)
                      <span class="spanBlink">{{$pendingMeetings}}</span>
                      @endif
                    </div>                 
                  </div>
                </div>
                {{-- <audio src="{{asset('images/notification.mp3')}}" autoplay></audio> --}}
          </div>
          <div class="col-4">
              <div class="container">               
                  <div class="card">
                    <div class="card-header stats-small__label text-uppercase" style="text-align:center;color:#818ea3;font-size:15px;">Confirmed Meetings <i style="color:green;" class="fas fa-circle"></i></div>
                    <div class="card-body" style="text-align:center;color:#17a2b8;font-size:15px;">
                      {{$confirmedMeetings}}
                    </div>                 
                  </div>
                </div>
          </div>   
          <div class="col-4">
              <div class="container">               
                  <div class="card">
                    <div class="card-header stats-small__label text-uppercase" style="text-align:center;color:#818ea3;font-size:15px;">Rejected Meetings <i style="color:red;" class="fas fa-times-circle"></i></div>
                    <div class="card-body" style="text-align:center;color:#17a2b8;font-size:15px;">{{$rejectedMeetings}}</div>                 
                  </div>
                </div>
          </div>                   
        </div>
      <br>
      <div class="row">
        <!-- Users Stats -->
        <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
          <div class="card card-small">
            <div class="card-header border-bottom">
              <h6 class="m-0">Users</h6>
            </div>
            <div class="card-body pt-0">
              <div class="row border-bottom py-2 bg-light">
                <div class="col-12 col-sm-6">
                  <div id="blog-overview-date-range" class="input-daterange input-group input-group-sm my-auto ml-auto mr-auto ml-sm-auto mr-sm-0" style="max-width: 350px;">
                    <input type="text" class="input-sm form-control" name="start" placeholder="Start Date" id="blog-overview-date-range-1">
                    <input type="text" class="input-sm form-control" name="end" placeholder="End Date" id="blog-overview-date-range-2">
                    <span class="input-group-append">
                      <span class="input-group-text">
                        <i class="material-icons"></i>
                      </span>
                    </span>
                  </div>
                </div>
                <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
                  <button type="button" class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">View Full Report &rarr;</button>
                </div>
              </div>
              <canvas height="130" style="max-width: 100% !important;" class="blog-overview-users"></canvas>
            </div>
          </div>
        </div>
        <!-- End Users Stats -->
        <!-- Users By Device Stats -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="card card-small h-100">
            <div class="card-header border-bottom">
              <h6 class="m-0">Users by device</h6>
            </div>
            <div class="card-body d-flex py-0">
              <canvas height="220" class="blog-users-by-device m-auto"></canvas>
            </div>
            <div class="card-footer border-top">
              <div class="row">
                <div class="col">
                  <select class="custom-select custom-select-sm" style="max-width: 130px;">
                    <option selected>Last Week</option>
                    <option value="1">Today</option>
                    <option value="2">Last Month</option>
                    <option value="3">Last Year</option>
                  </select>
                </div>
                <div class="col text-right view-report">
                  <a href="#">Full report &rarr;</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Users By Device Stats -->
        
      </div>
    </div>
    
  </main>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>

<script src="{{url('js/extras.1.1.0.min.js')}}"></script>
<script src="{{url('js/shards-dashboards.1.1.0.min.js')}}"></script>
<script src="{{url('js/app-blog-overview.1.1.0.js')}}"></script>
</body>

@endsection

