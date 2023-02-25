<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\UserPointRequest;
use App\Models\AccessData;
use App\Models\User;
use App\Models\UserPointEarn;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdsPointsContoller extends Controller
{
    public function index(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'point_id'=>'required|exists:points,id',
            ]);
            $points=Point::where('id',$request->point_id)->get()->first();
        $currentTime = Carbon::now();
        $userearn=UserPointEarn::where('user_id',$request->user_id)->where('point_id',$request->point_id)->
        whereDate('created_at', '=', date("Y/m/d", strtotime($currentTime)))->get();
        if($points->times - $userearn->count()){
            $time= $points->times - $userearn->count();
            return response()->json(['error'=>false,'message' => 'You have reached the limit','times'=>  $time]);
        }
        else{
            return response()->json(['error'=>false,'message' => 'You didn’t have reached the limit','times'=>  0]);
        }
    }
    public function store(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'point_id'=>'required|exists:points,id',
            ]);
            
            $points=Point::find($request->point_id);
        $currentTime = Carbon::now();
        
        $userearns=UserPointEarn::where('user_id',$request->user_id)->where('point_id',$request->point_id)->
        whereDate('created_at', '=', date("Y/m/d", strtotime($currentTime)))->get();
        
            $user=User::find($request->user_id);
            
        if($points->times - $userearns->count()){
            $ad_earn=UserPointEarn::create(['user_id'=>$request->user_id,'point_id'=>$request->point_id,'earn'=>$points->points]);
            $ad_earn1=UserPointEarn::select('id','user_id','point_id','earn')->find($ad_earn->id);
            $values = array('id' => NULL,'username' => $user->login,'points'=>$points->points,'type'=>$points->name,'date'=>$currentTime );
            
            DB::table('tracker')->insert($values);
            
            $upoints=$user->points;
            $total=$upoints + $points->points;
            $user->update(['points'=>$total]);
         	
            $time= $points->times  - 1 - $userearns->count();
            
            return response()->json(['status' => false, 'message' => 'User ads earn saved successfully', 'data' => $ad_earn1,'times'=>  $time,'total'=>$total]);
        }
        else{
            return response()->json(['error'=>false,'message' => 'You didn’t have reached the limit','times'=>  0,'total'=>$user->points]);
        }
    }
    
    public function show(Request $request, $id)
    { 
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $userpoint = UserPointEarn::select('id','user_id','point_id','earn')->find($id);
        if (!$userpoint) {
            return response()->json(['status' => false, 'message' => 'User ads earn not found', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $userpoint]);
    }
    public function getByUserId(Request $request, $user_id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $userpoint = UserPointEarn::select('id','user_id','point_id','earn')->where('user_id',$user_id)->get();
        if (!$userpoint) {
            return response()->json(['status' => false, 'message' => 'User ads earn not found', 'data' => null]);
        }
        $total=UserPointEarn::where('user_id',$user_id)->get()->sum("earn");
        return response()->json(['status' => false, 'message' => 'message', 'data' => $userpoint,'total'=>$total]);
    }
    public function getByAdId(Request $request, $ad_id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $userpoint = UserPointEarn::select('id','user_id','point_id','earn')->where('point_id',$ad_id)->get();
        if (!$userpoint) {
            return response()->json(['status' => false, 'message' => 'User ads earn not found', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $userpoint]);
    }
    
    public function getPoints(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $points=Point::select('id','name','points','times')->get();
        return response()->json(['Count'=> $points->count(),'Data' => $points]);
    }
    public function getPointById( Request $request,$id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $point=Point::select('id','name','points','times')->find($id);
        if (!$point) {
            return response()->json(['status' => false, 'message' => 'Point not found', 'data' => null]);
        }
        return response()->json(['status' => false,'Count'=> $point->count(),'Data' => $point]);
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