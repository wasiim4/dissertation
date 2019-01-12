<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\user;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;
use Illuminate\Support\Facades\Hash;




class welcomeController extends Controller
{
    public function showWelcomePage(){
        return view('welcomePage');
    }

    public function showlogin(Request $request){
        $role=Input::get('inputRole');

        if($role=="Notary/Notary Assistant"){
            return redirect('staff/login');
        }
        else if($role=="Client"){
            return redirect('/login');
        }
        else if($role=="RGD"){
            return redirect('rgd/login');
        }
        else if($role=="Bank"){
            return redirect('bank/login');
        }
        else if($role=="Land Surveyor"){
            return redirect('landSurveyor/login');
        }
    }
}
