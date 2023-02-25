<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Validation\Rule;

class PointController extends Controller
{
    public function index(Request $request)
    {
        $points = Point::when($request->name, function ($query) use ($request) {
            return $query->where('name',  $request->name );
        })->latest()->orderBy('id', 'DESC')->paginate('10');
        return view('admin.points.index', ['points' => $points]);
    }
    public function create(){
        return view('admin.points.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:points,name,',
            'points'=>'required|min:0',
            'times'=>'required|min:0'
            ]);
        Point::create(['name'=>$request->name,'points'=>$request->points,'times'=>$request->times]);
        session()->flash('success', __('site.added_success'));
        return redirect()->route('admin.ads.index');
    }
    public function edit($id){
        $point = Point::select()->find($id);
        if (!$point) {
            session()->flash('errors', __('site.ad_not_found'));
            return redirect()->route('admin.ads.index');
        }
        return view('admin.points.edit',['point'=>$point]);
    }
    public function update(Request $request,$id){
        $point = Point::select()->find($id);
        if (!$point) {
            session()->flash('errors', __('site.ad_not_found'));
            return redirect()->route('admin.ads.index');
        }
        $request->validate([
            'name'=>['required',Rule::unique('points')->ignore($point->id),],
            'points'=>'required|min:0',
            'times'=>'required|min:0'
            ]);
        $point->update(['name'=>$request->name,'points'=>$request->points,'times'=>$request->times]);
        session()->flash('success', __('site.updated_success'));
        return redirect()->route('admin.ads.index');
    }
    public function destroy($id){
        $point = Point::select()->find($id);
        if (!$point) {
            session()->flash('errors', __('site.ad_not_found'));
            return redirect()->route('admin.ads.index');
        }
        $point->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('admin.ads.index');
    }
}
