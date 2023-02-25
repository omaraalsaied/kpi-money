<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPointRequest;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\UserPointEarn;
use App\Models\WebSiteLink;
use Illuminate\Http\Request;

class UserPointController extends Controller
{
    public function index(Request $request)
    {
        $userpoints = UserPoint::when($request->link_id, function ($query) use ($request) {
            return $query->where('link_id',  $request->link_id );
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->with(['user','link'])->orderBy('id', 'DESC')->paginate('10');
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        $links = WebSiteLink::select('id', 'title')->orderBy('title', 'ASC')->get();
        return view('admin.userpoints.index', ['userpoints' => $userpoints, 'users' => $users, 'links'=> $links]);
    } public function userPointEarn(Request $request)
    {
        $userpoints = UserPointEarn::when($request->point_id, function ($query) use ($request) {
            return $query->where('point_id',  $request->point_id );
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->with(['user','link'])->orderBy('id', 'DESC')->paginate('10');
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        $points = Point::select('id', 'name')->orderBy('title', 'ASC')->get();
        return view('admin.userpoints.index', ['userpoints' => $userpoints, 'users' => $users, 'points'=> $points]);
    }/* 
    public function edit($id)
    {
        $userpoint = UserPoint::select()->find($id);
        if (!$userpoint) {
            session()->flash('errors', __('site.userpoint_not_found'));
            return redirect()->route('admin.userpoints.index');
        }
        return view('admin.userpoints.edit', ['userpoint' => $userpoint]);
    }
    public function update(UserPointRequest $request, $id)
    {
        $userpoint = UserPoint::select()->find($id);
        if (!$userpoint) {
            session()->flash('errors', __('site.userpoint_not_found'));
            return redirect()->route('admin.userpoints.index');
        }

        $link = WebSiteLink::select('id', 'reward')->find($request['link_id']);
        $userpoint = UserPoint::where('link_id', $request['link_id'])->where('user_id', $request['user_id'])
        ->where('id','!=',$id)->get();
        if ($userpoint->count() == 0) {
            $data = [
                "user_id" => $request['user_id'],
                "link_id" => $request['link_id'],
                "earn" => $link->reward
            ];
            UserPoint::create($data);
            session()->flash('success', __('site.updated_success'));
            return redirect()->route('admin.userpoints.index');
        }
        session()->flash('errors', __('Data was already saved'));
        return redirect()->route('admin.userpoints.index');
    } */
}
