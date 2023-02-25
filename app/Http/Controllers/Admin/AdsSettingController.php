<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdsSettingRequest;
use App\Models\AdsSetting;
use App\Models\User;
use Illuminate\Http\Request;

class AdsSettingController extends Controller
{
    public function index(Request $request)
    {
        $adssettings = AdsSetting::when($request->admob_pub_id, function ($query) use ($request) {
            return $query->where('admob_pub_id','LIKe',  '%'. $request->admob_pub_id .'%');
        })->when($request->admob_app_id, function ($query) use ($request) {
            return $query->where('admob_app_id','LIKe',  '%'. $request->admob_app_id  .'%');
        })->when($request->admob_bads_id, function ($query) use ($request) {
            return $query->where('admob_bads_id','LIKe',  '%'. $request->admob_bads_id .'%');
        })->when($request->admob_iads_id, function ($query) use ($request) {
            return $query->where('admob_iads_id','LIKe',  '%'. $request->admob_iads_id  .'%');
        })->when($request->admob_iads_id, function ($query) use ($request) {
            return $query->where('admob_iads_id','LIKe',  '%'. $request->admob_iads_id .'%');
        })->when($request->facebook_app_id, function ($query) use ($request) {
            return $query->where('facebook_app_id','LIKe',  '%'. $request->facebook_app_id .'%');
        })->when($request->facebook_bads_p_id, function ($query) use ($request) {
            return $query->where('facebook_bads_p_id','LIKe',  '%'. $request->facebook_bads_p_id .'%');
        })->when($request->facebook_rads_p_id, function ($query) use ($request) {
            return $query->where('facebook_rads_p_id','LIKe',  '%'. $request->facebook_rads_p_id .'%');
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',   $request->user_id);
        })->latest()->orderBy('id', 'DESC')->paginate('10');
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.adssettings.index',['adssettings'=> $adssettings,'users'=>$users]);
    }
    public function create()
    {
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.adssettings.create', ['users' => $users]);
    }
    public function store(AdsSettingRequest $request)
    {
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
            "user_id" =>auth()->user()->id,
            "active" => $request['active']
        ];
        $adssetting = AdsSetting::create($data);
        session()->flash('success', __('site.added_success'));
        return redirect()->route('admin.adssettings.index');
    }
    public function edit($id)
    {
        $adssetting = AdsSetting::select()->find($id);
        if (!$adssetting) {
            session()->flash('errors', __('site.adsSetting_not_found'));
            return redirect()->route('admin.adssettings.index');
        }
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.adssettings.edit', ['adssetting'=> $adssetting,'users' => $users]);
    }
    public function update(AdsSettingRequest $request, $id)
    {
        $adssetting = AdsSetting::select()->find($id);
        if (!$adssetting) {
            session()->flash('errors', __('site.adsSetting_not_found'));
            return redirect()->route('admin.adssettings.index');
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
            "active" => $request['active']
        ];
        $adssetting->update($data);
        session()->flash('success', __('site.updated_success'));
        return redirect()->route('admin.adssettings.index');
    }
    public function destroy($id)
    {
        $adssetting = AdsSetting::select()->find($id);
        if (!$adssetting) {
            session()->flash('errors', __('site.adsSetting_not_found'));
            return redirect()->route('admin.adssettings.index');
        }
        $adssetting->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('admin.adssettings.index');
    }
}

