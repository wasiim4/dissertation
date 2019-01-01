<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class bankLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/staff';
    public function __construct(){
        $this->middleware('guest:bank', ['except' => ['logout','userlogout','rgdlogout','banklogout','landSurveyorlogout']]);
    }

    
    public function showLoginForm()
    {
        return view('auth.bankLogin');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('bank')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('bankdashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    //   return redirect()->intended(route('staff.login'))->withInput($request->only('email', 'remember'));
    }

    public function banklogout()
    {
        Auth::guard('bank')->logout();
        return redirect('bank/login');
    }

    
}
