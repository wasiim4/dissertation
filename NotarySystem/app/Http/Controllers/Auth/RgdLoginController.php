<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class RgdLoginController extends Controller
{
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/rgd';
    public function __construct(){
        $this->middleware('guest:rgd', ['except' => ['logout','userlogout','rgdlogout']]);
    }

    
    public function showLoginForm()
    {
        return view('auth.rgd-login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('rgd')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('rgddashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function rgdlogout()
    {
        Auth::guard('rgd')->logout();
        
    return redirect('rgd/login');
       // return view('auth.rgd-login');
    }
}
