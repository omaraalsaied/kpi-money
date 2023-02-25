<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferwallRequest;
use App\Models\AccessData;
use App\Models\Offerwall;
use App\Models\User;
use App\Models\UserPointOffer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferwallController extends Controller
{
    public function index(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        } 
        $offerwall = Offerwall::latest()->whereNOTIn(
            'id',
       UserPointOffer::select('offerwall_id')->where('user_id',$request['user_id'])->get())->get();
        return response()->json(['status' => false, 'count' => $offerwall->count(), 'data' => $offerwall]);
    }
    public function store(OfferwallRequest $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $data= [
            "name" =>$request['name'] ,
            "subtitle" =>$request['subtitle'] ,
            "url" =>$request['url'] ,
            "points" =>$request['points'],
            "image" =>$request['image'] ,
            "type" =>$request['type'] ,
            "featured" =>$request['featured'],
            "position" =>$request['position'] ,
            "status" =>$request['status']
        ];
        if ($request->image) {
            Image::make($request->image)
                ->save(public_path('uploads/offerwalls/' . $request->image->hashName()));
            $data['image'] = 'uploads/offerwalls/' . $request->image->hashName();
        }
        $offerwall=Offerwall::create($data);
        return response()->json(['status'=>false,'message' => 'Offerwall saved successfully', 'data' => $offerwall]);
    }
    public function show(Request $request,$id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $offerwall = Offerwall::select()->find($id);
        if (!$offerwall) {
            return response()->json(['status' => false, 'message' => 'Offerwall not fount', 'data' => null]);

        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $offerwall]);
    }
    public function update(OfferwallRequest $request,$id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $offerwall = Offerwall::select()->find($id);
        if (!$offerwall) {
            return response()->json(['status' => false, 'message' => 'Offerwall not fount', 'data' => null]);
        }
        $data = [
            "name" => $request['name'],
            "subtitle" => $request['subtitle'],
            "url" => $request['url'],
            "points" => $request['points'],
            "image" => $request['image'],
            "type" => $request['type'],
            "featured" => $request['featured'],
            "position" => $request['position'],
            "status" => $request['status']
        ];
        if ($request->image) {
            if ($offerwall->image != '' && $offerwall->image != 'uploads/default.jpg') {
                if (file_exists(public_path($offerwall->image))) {
                    unlink(public_path($offerwall->image));
                }
            } //end of inner if
            Image::make($request->image)
                ->save(public_path('uploads/offerwalls/' . $request->image->hashName()));
            $data['image'] = 'uploads/offerwalls/' . $request->image->hashName();
        }
        $offerwall->update($data);
        return response()->json(['status' => false, 'message' => 'Offerwall updated successfully', 'data' => $data,'id'=>$id]);
    }
    public function destroy(Request $request, $id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $offerwall = Offerwall::select()->find($id);
        if (!$offerwall) {
            return response()->json(['status' => false, 'message' => 'Offerwall not fount', 'data' => null]);
        }
        if ($offerwall->image != '' && $offerwall->image != 'uploads/default.jpg') {
            if (file_exists(public_path($offerwall->image))) {
                unlink(public_path($offerwall->image));
            }
        }
        $offerwall->delete();
        return response()->json(['status' => false, 'message' => 'Offerwall delete successfully', 'data' => null]);
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
