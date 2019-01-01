<html>
<head>
<title>Login</title>
    {{-- <link rel="stylesheet" type="text/css" href="login.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/footer.css')}}">
    {{-- <script src="{{url('js/bootstrap.min.js')}}"></script> --}}
</head>
   

<body>
       <h1  style="color:white; padding-top:2%;"> <img src="{{ asset('images/mru1.png') }}" height="10%" width="5%" alt="Mauritius">Welcome to Mauritius e-Notary</h1>
    <div class="loginbox">
            @yield('content')
            <marquee style="color:#a9a9a9; font-size:14px;">*** For security reasons, please Log Out and Exit your web browser when you are done accessing services that require authentication!***</marquee>

    </div>