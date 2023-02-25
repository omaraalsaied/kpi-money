<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebSiteLinkRequest;
use App\Models\User;
use App\Models\WebSiteLink;
use Illuminate\Http\Request;

class WebSiteLinkController extends Controller
{

    public function index(Request $request)
    {
        $websitelinks = WebSiteLink::when($request->title, function ($query) use ($request) {
            return $query->where('title',  'LIKE', '%' . $request->title . '%');
        })->when($request->site_url, function ($query) use ($request) {
            return $query->where('site_url',  $request->site_url);
        })->when($request->code_number, function ($query) use ($request) {
            return $query->where('code_number',  $request->code_number);
        })->when($request->reward, function ($query) use ($request) {
            return $query->where('reward',  $request->reward);
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->orderBy('id', 'DESC')->paginate('10');
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.websitelinks.index', ['websitelinks' => $websitelinks, 'users' => $users]);
    }
    public function create()
    {
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.websitelinks.create', ['users' => $users]);
    }
    public function store(WebSiteLinkRequest $request)
    {
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
            "user_id" =>auth()->user()->id,
            "active" => $request['active']
        ];
        $websitelink = WebSiteLink::create($data);
        session()->flash('success', __('site.added_success'));
        return redirect()->route('admin.websitelinks.index');
    }
    public function edit($id)
    {
        $websitelink = WebSiteLink::select()->find($id);
        if (!$websitelink) {
            session()->flash('errors', __('site.websitelink_not_found'));
            return redirect()->route('admin.websitelinks.index');
        }
        $users = User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        return view('admin.websitelinks.edit', ['websitelink' => $websitelink,'users' => $users]);
    }
    public function update(WebSiteLinkRequest $request,$id)
    {
        $websitelink = WebSiteLink::select()->find($id);
        if (!$websitelink) {
            session()->flash('errors', __('site.websitelink_not_found'));
            return redirect()->route('admin.websitelinks.index');
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
            "user_id" =>auth()->user()->id,
            "active" => $request['active']
        ];
        $websitelink ->update($data);
        session()->flash('success', __('site.updated_success'));
        return redirect()->route('admin.websitelinks.index');
    }
    public function destroy( $id)
    {
        $websitelink = WebSiteLink::select()->find($id);
        if (!$websitelink) {
            session()->flash('errors', __('site.websitelink_not_found'));
            return redirect()->route('admin.websitelinks.index');
        }
        $websitelink->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('admin.websitelinks.index');
    }
}
