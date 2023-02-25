<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserPointRequest;
use App\Models\AccessData;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebSiteLink;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPointController extends Controller

{
    public function index(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $userpoints = UserPoint::select('id','user_id','link_id','earn')->latest()->get();
        return response()->json(['Count' => $userpoints->count(), 'Data' => $userpoints]);
    }
    public function store(UserPointRequest $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $link=WebSiteLink::select('id', 'reward','title')->find($request['link_id']);
        $userpoint = UserPoint::select('id','user_id','link_id','earn')->where('link_id', $request['link_id'])->where('user_id',$request['user_id'])->get();
            $user=User::find($request->user_id);
        if($userpoint->count()==0){
        $data = [
            "user_id" => $request['user_id'],
            "link_id" => $request['link_id'],
            "earn" => $link->reward
        ];
         $userpoint =UserPoint::create($data);
          $currentTime = Carbon::now();
            $values = array('id' => NULL,'username' => $user->login,'points'=>$link->reward,'type'=>$link->title,'date'=>$currentTime);
            DB::table('tracker')->insert($values);
            $total=$user->points + $link->reward;
            $user->update(['points'=>$total]);
         $point=UserPoint::select('id','user_id','link_id','earn')->find($userpoint->id);
            return response()->json(['status' => false, 'message' => 'User earn saved successfully', 'data' => $point,'total'=>$total]);
        }else {
            return response()->json(['status' => false, 'message' => 'User earn was already saved', 'data' => $userpoint,'total'=>$user->points]);
        }
    }
    public function show(Request $request, $id)
    { 
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $userpoint = UserPoint::select('id','user_id','link_id','earn')->find($id);
        if (!$userpoint) {
            return response()->json(['status' => false, 'message' => 'User earn not fount', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $userpoint]);
    }
    public function getByUserId(Request $request, $user_id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $userpoint = UserPoint::select('id','user_id','link_id','earn')->where('user_id',$user_id)->get();
        if (!$userpoint) {
            return response()->json(['status' => false, 'message' => 'User earn not fount', 'data' => null]);
        }
        $total = UserPoint::where('user_id',$user_id)->select()->get()->sum("earn");
        return response()->json(['status' => false, 'message' => 'message', 'data' => $userpoint,'total'=>$total]);
    }
    public function checkAccess($accessToken)
    {
        $accessToken = AccessData::where('accessToken', $accessToken)->get()->first();
        if (empty($accessToken)) {
            return null;
        }
        $user = User::select()->find($accessToken->accountId);
        if (empty($user)) {
            return null;
        }
        return $user;
    }
}
