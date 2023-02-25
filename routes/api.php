<?php

use App\Http\Controllers\Api\OfferwallController;
use App\Http\Controllers\Api\WebSiteLinkController;
use App\Http\Controllers\Api\AdsSettingController;
use App\Http\Controllers\Api\UserPointController;
use App\Http\Controllers\Api\UserPointOfferController;
use App\Http\Controllers\Api\AdsPointsContoller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::apiResource('offerwall', OfferwallController::class)->except(['create','edit','store','update','destroy']);
Route::apiResource('websitelink', WebSiteLinkController::class)->except(['create', 'edit','store','update','destroy']);
Route::get('/websitelink/getByCodeNum/{code_num}', [WebSiteLinkController::class, 'getByCodeNum']);
Route::apiResource('adssetting', AdsSettingController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);
Route::apiResource('userpoint', UserPointController::class)->except(['create', 'edit','update','destroy']);
Route::get('/userpoint/getByUserId/{user_id}', [UserPointController::class, 'getByUserId']);
Route::apiResource('adspoint', AdsPointsContoller::class)->except(['create', 'edit','update','destroy']);
Route::get('/adspoint/getByUserId/{user_id}', [AdsPointsContoller::class, 'getByUserId']);
Route::get('/adspoint/getByAdId/{point_id}', [AdsPointsContoller::class, 'getByAdId']);
Route::get('/points', [AdsPointsContoller::class, 'getPoints']);
Route::get('/points/{point_id}', [AdsPointsContoller::class, 'getPointById']);
//Route::apiResource('userpointoffer', UserPointOfferController::class)->except(['create', 'edit', 'update', 'destroy']);
//Route::get('/userpointoffer/getByUserId/{user_id}', [UserPointOfferController::class, 'getByUserId']);
