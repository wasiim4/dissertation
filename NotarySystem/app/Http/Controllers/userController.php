<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\user;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Datatables;
use Illuminate\Support\Facades\Validator;
use App\Mail\sendMail;
use Mail;
use Illuminate\Support\Facades\Hash;



class userController extends Controller
{
    public function getTransactions(Request $request){
        $transactions=DB::table('transaction')->where('clientId',(Auth::user()->id))->get();
        
        return view('users.myTransactions')->with('transactions',$transactions);

    }
}
