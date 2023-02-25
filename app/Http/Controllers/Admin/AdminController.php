<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsSetting;
use App\Models\Offerwall;
use App\Models\WebSiteLink;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        //dd(md5(md5('123456').'cda'));
        $adssettings = AdsSetting::orderBy('id','DESC')->take(6)->latest()->get();
        $offerwalls = Offerwall::latest()->orderBy('id', 'DESC')->take(6)->get();
        $websitelinks = WebSiteLink::latest()->orderBy('id', 'DESC')->take(6)->get();
        $ads = Point::latest()->orderBy('id', 'DESC')->take(6)->get();
        return view('admin.index',['adssettings'=>$adssettings,'offerwalls'=>$offerwalls,'websitelinks'=>$websitelinks, 'ads'=>$ads]);
    }
    public function clear_views()
    {
        Artisan::call('view:clear');
        session()->flash("success", __('site.views_cleared'));
        return redirect()->back();
    }
    public function clear_cache()
    {
        Artisan::call('cache:clear');
        session()->flash("success", __('site.cache_cleared'));
        return redirect()->back();
    }
    public function clear_routes()
    {
        Artisan::call('route:clear');
        session()->flash("success", __('site.routes_cleared'));
        return redirect()->back();
    }
    public function clear_config()
    {
        Artisan::call('config:clear');
        session()->flash("success", __('site.config_cleared'));
        return redirect()->back();
    }
    public function clear_optimize()
    {
        Artisan::call('optimize:clear');
        session()->flash("success", __('site.optimize_cleared'));
        return redirect()->back();
    }
}
