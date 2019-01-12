@extends('layouts.welcomelayout')
<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">
@section('content')
{{-- <div class="container"> --}}
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('show.role.login') }}" >
                        @csrf

                        <div class="form-group row">
                            <label for="role" class="col-sm-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <br>

                            <div class="col-md-6">
                                    
                                    <select  name="inputRole" class="form-control">
                                        <option selected>Notary/Notary Assistant</option>
                                        <option>Client</option>
                                        <option>RGD</option>
                                        <option>Bank</option>
                                        <option>Land Surveyor</option>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success" style="padding: 1% 34%; font-size:18px;">
                                    {{ __('OK') }}
                                </button>
                                <br><br>
                                
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            {{-- </div>
        </div>
    </div> --}}
{{-- </div> --}}
@endsection
