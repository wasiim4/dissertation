@extends('layouts.userlayout')
<link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
<script src="{{url('js/bootstrap.min.js')}}"></script>
@section('content')
<body>
<div>
    <h1 style="text-align:center;">Welcome to the notary system</h1>
    
</div>
 @include('flashy::message') 
</body>
@endsection