<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class landSurveyorLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/staff';
    public function __construct(){
        $this->middleware('guest:landSurveyor', ['except' => ['logout','userlogout','rgdlogout','banklogout','landSurveyorlogout']]);
    }

    
    public function showLoginForm()
    {
        return view('auth.landSurveyorLogin');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('landSurveyor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('landSurveyordashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    //   return redirect()->intended(route('staff.login'))->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('landSurveyor')->logout();
        return redirect('landSurveyor/login');
    }

    
}
