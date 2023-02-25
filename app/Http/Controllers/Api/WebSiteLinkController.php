<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebSiteLinkRequest;
use App\Models\AccessData;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\WebSiteLink;
use Illuminate\Http\Request;

class WebSiteLinkController extends Controller
{
    public function index(Request $request)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $request->validate([
            'user_id'=>'required|exists:users,id'
            ]);
        $webSiteLinks = WebSiteLink::select('id','title','site_url','code_number','reward')->latest()->WhereNotIn('id',
            UserPoint::select('link_id')->where('user_id', $request['user_id'])->get()
        )->get();
        return response()->json(['Count' => $webSiteLinks->count(), 'Data' => $webSiteLinks]);
    }
    public function store(WebSiteLinkRequest $request)
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
            "title" => $request['title'],
            "site_url" => $request['site_url'],
            "code_number" => $request['code_number'],
            "reward" => $request['reward'],
            "user_id" => $request['user_id'],
            "active" => $request['active']
        ];
        $webSiteLink = WebSiteLink::create($data);
        $weblink=WebSiteLink::select('id','title','site_url','code_number','reward')->find($webSiteLink);
        return response()->json(['status' => false, 'message' => 'WebSite Link saved successfully', 'data' => $weblink]);
    }
    public function show(Request $request, $id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $webSiteLink = WebSiteLink::select('id','title','site_url','code_number','reward')->find($id);
        if (!$webSiteLink) {
            return response()->json(['status' => false, 'message' => 'WebSite Link not fount', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $webSiteLink]);
    }
    public function update(WebSiteLinkRequest $request,$id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $webSiteLink = WebSiteLink::select()->find($id);
        if (!$webSiteLink) {
            return response()->json(['status' => false, 'message' => 'WebSite Link not fount', 'data' => null]);
        }
        if (!$request->has('active')) {
            $request->request->add(['active' => 0]);
        } else {
            $request->request->add(['active' => 1]);
        }
        $data = [
            "title" => $request['title'],
            "site_url" => $request['site_url'],
            "code_number" => $request['code_number'],
            "reward" => $request['reward'],
            "user_id" => $request['user_id'],
            "active" => $request['active']
        ];
        $webSiteLink ->update($data);
        $weblink=WebSiteLink::select('id','title','site_url','code_number','reward')->find($webSiteLink);
        return response()->json(['status' => false, 'message' => 'WebSite Link updated successfully', 'data' => $weblink]);
    }
    public function destroy(Request $request, $id)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $webSiteLink = WebSiteLink::select('id','title','site_url','code_number','reward')->find($id);
        if (!$webSiteLink) {
            return response()->json(['status' => false, 'message' => 'WebSite Link not fount', 'data' => null]);
        }
        $webSiteLink->delete();
        return response()->json(['status' => false, 'message' => 'WebSite Link delete successfully', 'data' => null]);
    }
    public function getByCodeNum(Request $request, $code_num)
    {
        if (empty($this->checkAccess($request->bearerToken()))) {
            return response()->json(['status' => false, 'message' => 'These credentials do not match our records']);
        }
        $webSiteLink = WebSiteLink::select('id','title','site_url','code_number','reward')->where('code_number',$code_num)->get()->first();
        if (!$webSiteLink) {
            return response()->json(['status' => false, 'message' => 'WebSite Link not fount', 'data' => null]);
        }
        return response()->json(['status' => false, 'message' => 'message', 'data' => $webSiteLink]);
    }
    public function checkAccess($accessToken)
    {

        $accessToken = AccessData::where('accessToken', $accessToken)->get()->first();
        if(empty($accessToken)){
            return null;
        }
        $user = User::select()->find($accessToken->accountId);
        if (empty($user)) {
            return null;
        }
        return $user;
    }
}
