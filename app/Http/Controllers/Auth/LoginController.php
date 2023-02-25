<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Admin;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function username()
    {
        return 'passw';
    }
    public function login(Request $request)
    {
        $vali=Validator::make($request->all(),[
        'login'=>'required','password'=>'required']);
        if($vali->fails()){
            return redirect()->back()->withErrors($vali)->withInput();
        }
        if(Auth::attempt(['login'=>$request->login, 'passw'=>md5(md5($request->password).'cda')])){
                return redirect()->route('admin.index');
        }else{
            return redirect()->route('login')->with([
                'message'=> 'These credentials do not match our records'
            ]);
        }
    }/*
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'login');
    } */
}
