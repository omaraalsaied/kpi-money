<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    /*Route::get('userpointsoffer', function (\Illuminate\Http\Request $request)
    {
        $userpoints = \App\Models\UserPointOffer::when($request->offerwall_id, function ($query) use ($request) {
            return $query->where('offerwall_id',  $request->offerwall_id);
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->with(['user', 'offerwall'])->orderBy('id', 'DESC')->paginate('10');
        $users =  \App\Models\User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        $offerwalls =  \App\Models\Offerwall::select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('admin.userpoints.offer', ['userpoints' => $userpoints, 'users' => $users, 'offerwalls' => $offerwalls]);
    })->name('userpoints.offer');*/
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/clear_views', 'AdminController@clear_views')->name('clear.views');
    Route::get('/clear_cache', 'AdminController@clear_cache')->name('clear.cache');
    Route::get('/clear_routes', 'AdminController@clear_routes')->name('clear.routes');
    Route::get('/clear_optimize', 'AdminController@clear_optimize')->name('clear.optimize');
    Route::get('/clear_config', 'AdminController@clear_config')->name('clear.config');
    Route::resource('ads', PointController::class)->except(['show']);
//    Route::resource('adsperms', PointPermController::class)->except(['show']);
    
    Route::resource('websitelinks', WebSiteLinkController::class)->except(['show']);
    Route::resource('adssettings', AdsSettingController::class)->except(['show']);
    Route::get('userpoints', function (\Illuminate\Http\Request $request)
    {
        $userpoints = \App\Models\UserPoint::when($request->link_id, function ($query) use ($request) {
            return $query->where('link_id',  $request->link_id);
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->with(['user', 'link'])->orderBy('id', 'DESC')->paginate('10');
        $users =  \App\Models\User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        $links =  \App\Models\WebSiteLink::select('id', 'title')->orderBy('title', 'ASC')->get();
        return view('admin.userpoints.index', ['userpoints' => $userpoints, 'users' => $users, 'links' => $links]);
    })->name('userpoints.index');
    Route::get('useraderarns', function (\Illuminate\Http\Request $request)
    {
        $userpoints = \App\Models\UserPointEarn::when($request->point_id, function ($query) use ($request) {
            return $query->where('point_id',  $request->point_id );
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('user_id',  $request->user_id);
        })->latest()->with(['user','point'])->orderBy('id', 'DESC')->paginate('10');
        $users = \App\Models\User::select('id', 'fullname')->orderBy('fullname', 'ASC')->get();
        $points = \App\Models\Point::select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('admin.userpoints.adsearn', ['userpoints' => $userpoints, 'users' => $users, 'points'=> $points]);
    })->name('useraderarns.index');
    });
