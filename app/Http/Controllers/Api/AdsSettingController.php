<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AdsSettingRequest;
use App\Models\AdsSetting;
use App\Http\Controllers\Controller;
use App\Models\AccessData;
use App\Models\User;
use Illuminate\Http\Request;

class AdsSettingController extends Controller
{
    public function index(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $adsSettings = AdsSetting::
            select('id','admob_pub_id','admob_app_id','admob_bads_id','admob_iads_id','admob_rads_id','facebook_app_id','facebook_bads_p_id','facebook_rads_p_id')
            ->latest()->get();
        return response()->json(['Count'=> $adsSettings->count(),'Data' => $adsSettings]);
    }
    public function store(AdsSettingRequest $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        if (!$request->has('active')) {
            $request->request->add(['active' => 0]);
        } else {
            $request->request->add(['active' => 1]);
        }
        $data = [
            "admob_pub_id" => $request['admob_pub_id'],
            "admob_app_id" => $request['admob_app_id'],
            "admob_bads_id" => $request['admob_bads_id'],
            "admob_iads_id" => $request['admob_iads_id'],
            "admob_rads_id" => $request['admob_rads_id'],
            "facebook_app_id" => $request['facebook_app_id'],
            "facebook_bads_p_id" => $request['facebook_bads_p_id'],
            "facebook_rads_p_id" => $request['facebook_rads_p_id'],
            "user_id" => $request['user_id'],
            "active" => $request['active']
        ];
        $adsSetting = AdsSetting::create($data);
        $setting=AdsSetting::
            select('id','admob_pub_id','admob_app_id','admob_bads_id','admob_iads_id','admob_rads_id','facebook_app_id','facebook_bads_p_id','facebook_rads_p_id')
            ->find($adsSetting->id);
        return response()->json(['status' => false, 'message' => 'Ads Setting saved successfully', 'data' => $setting]);
    }
    public function show($id, Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $adsSetting = adsSetting::
            select('id','admob_pub_id','admob_app_id','admob_bads_id','admob_iads_id','admob_rads_id','facebook_app_id','facebook_bads_p_id','facebook_rads_p_id')
            ->find($id);
        if (!$adsSetting) {
            return response()->json(['status' => false, 'message' => 'Ads Setting not fount', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $adsSetting]);
    }
    public function update(AdsSettingRequest $request, $id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $adsSetting = AdsSetting::select()->find($id);
        if (!$adsSetting) {
            return response()->json(['status' => false, 'message' => 'Ads Setting not fount', 'data' => null]);
        }
        if (!$request->has('active')) {
            $request->request->add(['active' => 0]);
        } else {
            $request->request->add(['active' => 1]);
        }
        $data = [
            "admob_pub_id" => $request['admob_pub_id'],
            "admob_app_id" => $request['admob_app_id'],
            "admob_bads_id" => $request['admob_bads_id'],
            "admob_iads_id" => $request['admob_iads_id'],
            "admob_rads_id" => $request['admob_rads_id'],
            "facebook_app_id" => $request['facebook_app_id'],
            "facebook_bads_p_id" => $request['facebook_bads_p_id'],
            "facebook_rads_p_id" => $request['facebook_rads_p_id'],
            "user_id" => $request['user_id'],
            "active" => $request['active']
        ];
        $adsSetting->update($data);
        $setting=AdsSetting::
            select('id','admob_pub_id','admob_app_id','admob_bads_id','admob_iads_id','admob_rads_id','facebook_app_id','facebook_bads_p_id','facebook_rads_p_id')
            ->find($adsSetting->id);
        return response()->json(['status' => false, 'message' => 'Ads Setting updated successfully', 'data' => $setting]);
    }
    public function destroy(Request $request, $id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $adsSetting = adsSetting::
            select('id','admob_pub_id','admob_app_id','admob_bads_id','admob_iads_id','admob_rads_id','facebook_app_id','facebook_bads_p_id','facebook_rads_p_id')
            ->find($id);
        if (!$adsSetting) {
            return response()->json(['status' => false, 'message' => 'Ads Setting not fount', 'data' => null]);
        }
        $adsSetting->delete();
        return response()->json(['status' => false, 'message' => 'Ads Setting delete successfully', 'data' => null]);
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

