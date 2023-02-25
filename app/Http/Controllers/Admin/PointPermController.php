<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPointPerm;
use App\Models\User;
use App\Models\Point;
class PointPermController extends Controller
{
    public function index(Request $request)
    {
        $adsperms = UserPointPerm::when($request->name, function ($query) use ($request) {
            return $query->where('name',  $request->name );
        })->latest()->orderBy('id', 'DESC')->paginate('10');
        $users=User::select('id','fullname')->get();
        $points=Point::select('id','name')->get();
        return view('admin.adsperm.index', ['adsperms' => $adsperms,'users'=>$users,'points'=>$points]);
    }
    public function create(){
        $users=User::select('id','fullname')->get();
        $points=Point::select('id','name')->get();
        return view('admin.adsperm.create',['users'=>$users,'points'=>$points]);
    }
    public function store(Request $request){
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'point_id'=>'required|exists:points,id',
            'times'=>'required|min:1'
            ]);
        UserPointPerm::create(['user_id'=>$request->user_id,'point_id'=>$request->point_id,'times'=>$request->times]);
        session()->flash('success', __('site.added_success'));
        return redirect()->route('admin.adsperms.index');
    }
    public function edit($id){
        $adsperm = UserPointPerm::select()->find($id);
        if (!$adsperm) {
            session()->flash('errors', __('site.adperm_not_found'));
            return redirect()->route('admin.adsperms.index');
        }
        $users=User::select('id','fullname')->get();
        $points=Point::select('id','name')->get();
        return view('admin.adsperm.edit',['adsperm'=>$adsperm,'users'=>$users,'points'=>$points]);
    }
    public function update(Request $request,$id){
        $adsperm = UserPointPerm::select()->find($id);
        if (!$adsperm) {
            session()->flash('errors', __('site.adperm_not_found'));
            return redirect()->route('admin.adsperms.index');
        }
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'point_id'=>'required|exists:points,id',
            'times'=>'required|min:1'
            ]);
        $adsperm->update(['user_id'=>$request->user_id,'point_id'=>$request->point_id,'times'=>$request->times]);
        session()->flash('success', __('site.edited_success'));
        return redirect()->route('admin.adsperms.index');
    }
    public function destroy($id){
        $adsperm = UserPointPerm::select()->find($id);
        if (!$adsperm) {
            session()->flash('errors', __('site.adperm_not_found'));
            return redirect()->route('admin.adsperms.index');
        }
        $adsperm->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('admin.adsperms.index');
    }
}
