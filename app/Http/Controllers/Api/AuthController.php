<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessData;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $accessToken=AccessData::where('accountId',$request->accountId)->
        where('accessToken',$request->accessToken)->get()->first();
        $user=User::select()->find($accessToken->accountId);
        return response()->json(['User'=> $user,'Token'=>$accessToken]);
    }
   /*    public function login(Request $request)
  {
     $user = User::where('username', $request->username)
                  ->where('password',md5($request->password))
                  ->first();
     Auth::login($user);
     return redirect('/');
  } */
}
