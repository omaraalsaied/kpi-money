<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferwallRequest;
use App\Models\Offerwall;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferwallController extends Controller
{
    public function index(Request $request)
    {
        $offerwalls = Offerwall::when($request->name, function ($query) use ($request) {
            return $query->where('name',  'LIKE', '%' . $request->name . '%');
        })->when($request->subtitle, function ($query) use ($request) {
            return $query->where('subtitle',  'LIKE', '%' . $request->subtitle . '%');
        })->when($request->url, function ($query) use ($request) {
            return $query->where('url',  'LIKE', '%' . $request->url . '%');
        })->when($request->points, function ($query) use ($request) {
            return $query->where('points',   $request->points);
        })->when($request->type, function ($query) use ($request) {
            return $query->where('type',   $request->type);
        })->when($request->featured, function ($query) use ($request) {
            return $query->where('featured',   $request->featured);
        })->when($request->position, function ($query) use ($request) {
            return $query->where('position',   $request->position);
        })->latest()->orderBy('id', 'DESC')->paginate('10');
        return view('admin.offerwalls.index', ['offerwalls' => $offerwalls]);
    }
    public function create()
    {
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.offerwalls.create', ['users' => $users]);
    }
    public function store(OfferwallRequest $request)
    {
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);
        } else {
            $request->request->add(['status' => 1]);
        }
        $data= [
            "name" =>$request['name'] ,
            "subtitle" =>$request['subtitle'] ,
            "url" =>$request['url'] ,
            "points" =>$request['points'],
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
        session()->flash('success', __('site.added_success'));
        return redirect()->route('admin.offerwalls.index');
    }
    public function edit($id)
    {
        $offerwall = Offerwall::select()->find($id);
        if (!$offerwall) {
            session()->flash('errors', __('site.offerwalls_not_found'));
            return redirect()->route('admin.offerwalls.index');
        }
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.offerwalls.edit', ['offerwall'=> $offerwall,'users' => $users]);
    }
    public function update(OfferwallRequest $request,$id)
    {
        $offerwall = Offerwall::select()->find($id);
        if (!$offerwall) {
            session()->flash('errors', __('site.offerwalls_not_found'));
            return redirect()->route('admin.offerwalls.index');
        }
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);
        } else {
            $request->request->add(['status' => 1]);
        }
        $data = [
            "name" => $request['name'],
            "subtitle" => $request['subtitle'],
            "url" => $request['url'],
            "points" => $request['points'],
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
        session()->flash('success', __('site.updated_success'));
        return redirect()->route('admin.offerwalls.index');
    }
    public function destroy($id)
    {
        $offerwall = Offerwall::select()->find($id);
        if (!$offerwall) {
            session()->flash('errors', __('site.offerwalls_not_found'));
            return redirect()->route('admin.offerwalls.index');
        }
        if ($offerwall->image != '' && $offerwall->image != 'uploads/default.jpg') {
            if (file_exists(public_path($offerwall->image))) {
                unlink(public_path($offerwall->image));
            }
        }
        
        $offerwall->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('admin.offerwalls.index');
    }
}
