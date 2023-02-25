<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPointOfferRequest;
use App\Models\User;
use App\Models\UserPointOffer;
use App\Models\Offerwall;
use Illuminate\Http\Request;

class UserPointOfferController extends Controller
{
    public function index(Request $request)
    {
        $userpoints = UserPointOffer::when($request->offerwall_id, function ($query) use ($request) {
            return $query->where('offerwall_id',  $request->offerwall_id);
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->with(['user', 'offerwall'])->orderBy('id', 'DESC')->paginate('10');
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        $offerwalls = Offerwall::select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('admin.userpoints.offer', ['userpoints' => $userpoints, 'users' => $users, 'offerwalls' => $offerwalls]);
    }/* 
    public function edit($id)
    {
        $userpoint = UserPointOffer::select()->find($id);
        if (!$userpoint) {
            session()->flash('errors', __('site.userpoint_not_found'));
            return redirect()->route('admin.userpointsoffer.index');
        }
        return view('admin.userpointsoffer.edit', ['userpoint' => $userpoint]);
    }
    public function update(UserPointOfferRequest $request, $id)
    {
        $userpoint = UserPointOffer::select()->find($id);
        if (!$userpoint) {
            session()->flash('errors', __('site.userpoint_not_found'));
            return redirect()->route('admin.userpointsoffer.index');
        }

        $link = Offerwall::select('id', 'points')->find($request['offerwall_id']);
        $userpoint = UserPointOffer::where('offerwall_id', $request['offerwall_id'])->where('user_id', $request['user_id'])
            ->where('id', '!=', $id)->get();
        if ($userpoint->count() == 0) {
            $data = [
                "user_id" => $request['user_id'],
                "offerwall_id" => $request['offerwall_id'],
                "earn" => $link->points
            ];
            UserPointOffer::create($data);
            session()->flash('success', __('site.updated_success'));
            return redirect()->route('admin.userpointsoffer.index');
        }
        session()->flash('errors', __('Data was already saved'));
        return redirect()->route('admin.userpointsoffer.index');
    } */
}
