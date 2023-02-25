<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\UserPointOfferRequest;
use App\Models\AccessData;
use App\Models\User;
use App\Models\UserPointOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offerwall;

class UserPointOfferController extends Controller
{
    public function index(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $userpoints = UserPointOffer::latest()->get();
        return response()->json(['Count' => $userpoints->count(), 'Data' => $userpoints]);
    }
    public function store(UserPointOfferRequest $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $offerwall = Offerwall::select('id', 'points')->find($request['offerwall_id']);
        $userpoint = UserPointOffer::where('offerwall_id', $request['offerwall_id'])->where('user_id', $request['user_id'])->get();
        if ($userpoint->count() == 0) {
            $data = [
                "user_id" => $request['user_id'],
                "offerwall_id" => $request['offerwall_id'],
                "earn" => $offerwall->points
            ];
            UserPointOffer::create($data);
            return response()->json(['status' => false, 'message' => 'User earn saved successfully', 'data' => $userpoint]);
        } else {
            return response()->json(['status' => false, 'message' => 'User earn was already saved', 'data' => $userpoint]);
        }
    }
    public function show(Request $request, $id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $userpoint = UserPointOffer::select()->find($id);
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
        $userpoint = UserPointOffer::where('user_id', $user_id)->select()->get();
        if (!$userpoint) {
            return response()->json(['status' => false, 'message' => 'User earn not fount', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $userpoint]);
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
