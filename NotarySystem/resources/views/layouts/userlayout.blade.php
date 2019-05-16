<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notary System</title>

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> --}}
    <!-- Our Custom CSS -->
    {{-- <link rel="stylesheet" href="style4.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style4.css')}}">
    <link rel="icon" href="{{asset('images/certificate.png')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/css/footer.css')}}">
    <!-- Font Awesome JS -->
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
        $('#tblUsertransaction').DataTable(
            {'responsive':'true'}
        );
        $('#tbluser').DataTable(
            {'responsive':'true'}
        );
        $('#tblDoc').DataTable(
            {'responsive':'true'}
        );
    } );
    </script>  
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3> Notary System</h3>
            <strong>NS</strong>
        </div>

        <ul class="list-unstyled components">
            
            <li>
                <a href="{{ route('client.myProfile') }}"><i class="fas fa-user-circle"></i> My Profile</a></li>
            </li>
            <li>
                <a href="{{ route('view.transaction') }}" ><i class="fas fa-user-plus"></i> View Transactions</a>
            </li>
            <li>
                <a href="{{ route('show.uploadDoc') }}" ><i class="fas fa-user-plus"></i> Upload Documents</a>
            </li>
                
            <li class="active">
                <a href="#uploadedDocsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-file"></i>
                    Uploaded Documents
                </a>
                <ul class="collapse list-unstyled" id="uploadedDocsSubmenu">
                    <li>
                        <a href="{{route('show.UploadedDocs')}}" ><i class="fas fa-user-plus"></i>My documents</a>
                    </li>
                    <li>
                        <a href="" ><i class="fas fa-user-plus"></i> Notary/Notary Assistant</a>
                    </li>                                    
                </ul>
            </li>
            <li class="active">
                <a href="#meetingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-calendar-alt"></i>
                    Meetings
                </a>
                <ul class="collapse list-unstyled" id="meetingSubmenu">
                    <li>
                        <a href="{{ route('client.meetings') }}" ><i class="fas fa-calendar-check"></i> View Meetings</a>
                    </li>
                    <li>
                        <a href="{{ route('client.show.meetingsForms') }}" ><i class="fas fa-calendar-times"></i> Agenda</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#mailSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-envelope"></i>
                    Mails
                </a>
                <ul class="collapse list-unstyled" id="mailSubmenu">
                    <li>
                        <a href="{{ route('show.mailCompose') }}" ><i class="fas fa-edit"></i> Compose Mail</a>
                    </li>
                    <li>
                        <a href="https://mail.google.com/mail/u/2/#inbox" target='_blank'><i class="fas fa-inbox"></i> Inbox</a>
                    </li>
                    <li>
                        <a href="https://mail.google.com/mail/u/2/#sent" target='_blank'><i class="fas fa-share-square"></i> Sent Items</a>
                    </li>                            
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fa fa-power-off"></i>
                    <b>Log out<b>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">   
                        <li class="nav-item">
                            <a class="nav-link" style="color:aliceblue;" href="{{route('dashboard')}}">Welcome,{{ ucfirst(strtolower(Auth::user()->firstname)) }} </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
<body>
    <div  class="translate" >

            <div id="google_translate_element" style="padding-bottom: 2%;"></div>
            
            <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
            </script>
            
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </div>
@yield('content')
            
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
<footer>
    <img src="{{ asset('images/certificate.png') }}" class="footerlogo" alt="logo notary">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> NW Mauritius.
</footer>
</html>