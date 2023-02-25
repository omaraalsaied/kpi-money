@extends('layouts.admin.app')
@section('title',' | ' .  __('site.dashboard'))
@section('styles')
   <style>
    p{text-indent: 0px!important;}
    </style>
@endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> @lang('site.dashboard')</h1>
        <p></p>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="widget-small info coloured-icon">
            <i class="icon fas fa-tags fa-3x"></i>
            <div class="info">
                <h4>@lang('site.websitelinks')</h4>
                <p><b> {{\App\Models\WebSiteLink::count()}}</b></p>
                <p><a href="{{route('admin.websitelinks.index')}} " class="small-box-footer">@lang('site.read')
                        <i class="fas fa-arrow-circle-right"></i></a></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="widget-small primary coloured-icon">
            <i class="icon fas fa-ad fa-3x"></i>
            <div class="info">
                <h4>@lang('site.ads')</h4>
                <p><b> {{\App\Models\Point::count()}}</b></p>
                <p><a href="{{route('admin.ads.index')}} " class="small-box-footer">@lang('site.read')
                        <i class="fas fa-arrow-circle-right"></i></a></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="widget-small danger coloured-icon">
            <i class="icon fa fa-cogs fa-3x"></i>
            <div class="info">
                <h4>@lang('site.adsSettings')</h4>
                <p><b> {{\App\Models\AdsSetting::count()}}</b></p>
                <p><a href="{{route('admin.adssettings.index')}} " class="small-box-footer">@lang('site.read')
                        <i class="fas fa-arrow-circle-right"></i></a></p>
            </div>
        </div>
    </div>
    </div>{{--
    <div class="row mb-2">
        <div class="tile" style="margin-bottom: 2px;">
            <h4 class="tile-title"> @lang('site.last_offerwalls')</h4>
            <div class="tile-body p-1">
                <div class="table-responsive"><table class="table table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #009688;color: #fff;">
                            <td>#</td>
                            <td>@lang('site.name')</td>
                            <td>@lang('site.subtitle')</td>
                            <td>@lang('site.url')</td>
                            <td>@lang('site.points')</td>
                            <td>@lang('site.image')</td>
                            <td>@lang('site.type')</td>
                            <td>@lang('site.featured')</td>
                            <td>@lang('site.position')</td>
                            <td>@lang('site.actions')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offerwalls as $index=>$offerwall)
                        <tr style="background-color:@if($offerwall->status==1) #fff @else #cecdcd @endif;">
                            <td>{{$index + 1}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#showModal_{{$index}}">{{$offerwall->name}}</a>
                            </td>
                            <td>{{$offerwall->subtitle}}</td>
                            <td><a href="{{$offerwall->url}}" target="_blank">@lang('site.link')</a></td>
                            <td>{{$offerwall->points}}
                            </td>
                            <td>@if($offerwall->image)
                                <img src="{{asset($offerwall->image)}}" alt="{{$offerwall->name}}" style="height: 50px;width: 100%;"
                                    class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{$offerwall->type}}</td>
                            <td>{{$offerwall->featured}}</td>
                            <td>{{$offerwall->position}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('admin.offerwalls.edit',$offerwall->id)}}" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.offerwalls.destroy',$offerwall->id)}}" method="post" class="mx-1"
                                        style="width:fit-content;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </form>
                                </div>
                
                            </td>
                        </tr>
                        <div class="modal fade" id="showModal_{{$index}}" tabindex="-1" role="dialog"
                            aria-labelledby="showModal_{{$index}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModal_{{$index}}">{{$offerwall->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{$offerwall->image!='' ? asset($offerwall->image) : asset('uploads/default.jpg')}}"
                                                    alt="{{$offerwall->name}}" class="img-thumbnail img-preview"
                                                    style="width: 100%;height: 250px;">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row ">
                                                    <div class="col-md-5">
                                                        @lang('site.name')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->name}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.subtitle')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->subtitle}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.url')
                                                    </div>
                                                    <div class="col-md-7">
                                                        <a href="{{$offerwall->url}}">@lang('site.link')</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.points')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->points}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.type')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->type}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.featured')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->featured}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.position')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->position}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.status')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$offerwall->getActive()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tile-footer ">
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.offerwalls.index')}}" class="btn btn-secondary" title="@lang('site.show_all')">
                        <i class="fas fa-eye"></i> @lang('site.show_all')
                    </a>
                </div>
            </div>
        </div>
    </div>--}}
    <div class="row mb-2">
        <div class="tile" style="margin-bottom: 2px;">
            <h4 class="tile-title"> @lang('site.last_websitelinks')</h4>
            <div class="tile-body p-1">
                <div class="table-responsive"><table class="table table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #009688;color: #fff;">
                            <td>#</td>
                            <td>@lang('site.title')</td>
                            <td>@lang('site.site_url')</td>
                            <td>@lang('site.code_number')</td>
                            <td>@lang('site.reward')</td>
                            <td>@lang('site.user')</td>
                            <td>@lang('site.actions')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($websitelinks as $index=>$websitelink)
                        <tr style="background-color:@if($websitelink->active==1) #fff @else #cecdcd @endif;">
                            <td>{{$index + 1}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#showModal_{{$index}}">{{$websitelink->title}}</a>
                            </td>
                            <td>
                                <a href="{{$websitelink->site_url}}">@lang('site.link')</a>
                            </td>
                            <td>{{$websitelink->code_number}}</td>
                            <td>{{$websitelink->reward}}
                            </td>
                            <td>{{$websitelink->user->fullname}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('admin.websitelinks.edit',$websitelink->id)}}" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.websitelinks.destroy',$websitelink->id)}}" method="post" class="mx-1"
                                        style="width:fit-content;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="showModal_{{$index}}" tabindex="-1" role="dialog"
                            aria-labelledby="showModal_{{$index}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModal_{{$index}}">{{$websitelink->title}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row ">
                                                    <div class="col-md-5">
                                                        @lang('site.title')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$websitelink->title}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.site_url')
                                                    </div>
                                                    <div class="col-md-7">
                                                        <a href="{{$websitelink->site_url}}">
                                                            @lang('site.link')
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.code_number')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$websitelink->code_number}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.reward')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$websitelink->reward}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.user')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$websitelink->user->fullname}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.status')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$websitelink->getActive()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tile-footer ">
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.websitelinks.index')}}" class="btn btn-secondary" title="@lang('site.show_all')">
                        <i class="fas fa-eye"></i> @lang('site.show_all')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="tile" style="margin-bottom: 2px;">
            <h4 class="tile-title"> @lang('site.last_ads')</h4>
            <div class="tile-body p-1">
                <div class="table-responsive"><table class="table table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #009688;color: #fff;">
                            <td>#</td>
                            <td>@lang('site.name')</td>
                            <td>@lang('site.points')</td>
                            <td>@lang('site.view_counts')</td>
                            <td>@lang('site.actions')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads as $index=>$ad)
                        <tr >
                            <td>{{$index + 1}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#showModalads_{{$index}}">{{$ad->name}}</a>
                            </td>
                            <td>{{$ad->points}}</td>
                            <td>{{$ad->times}}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('admin.ads.edit',$ad->id)}}" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.ads.destroy',$ad->id)}}" method="post" class="mx-1"
                                        style="width:fit-content;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="showModalads_{{$index}}" tabindex="-1" role="dialog"
                            aria-labelledby="showModalads_{{$index}}" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalads_{{$index}}">{{$ad->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" row">
                                            <div class="row ">
                                                <div class="col-md-5">
                                                    @lang('site.name')
                                                </div>
                                                <div class="col-md-7">
                                                    {{$ad->name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    @lang('site.points')
                                                </div>
                                                <div class="col-md-7">
                                                    {{$ad->points}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    @lang('site.view_counts')
                                                </div>
                                                <div class="col-md-7">
                                                    {{$ad->times}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tile-footer ">
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.ads.index')}}" class="btn btn-secondary" title="@lang('site.show_all')">
                        <i class="fas fa-eye"></i> @lang('site.show_all')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tile" style="margin-bottom: 2px;">
            <h4 class="tile-title"> @lang('site.last_adsSettings')</h4>
            <div class="tile-body p-1">
                <div class="table-responsive"><table class="table table-bordered table-hover">
                    <thead>
                        <tr style="background-color: #009688;color: #fff;">
                            <td>#</td>
                            <td>@lang('site.admob_pub_id')</td>
                            <td>@lang('site.admob_app_id')</td>
                            <td>@lang('site.admob_bads_id')</td>
                            <td>@lang('site.admob_iads_id')</td>
                            <td>@lang('site.user')</td>
                            <td>@lang('site.actions')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adssettings as $index=>$adssetting)
                        <tr style="background-color:@if($adssetting->active==1) #fff @else #cecdcd @endif;">
                            <td>{{$index + 1}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#showModalset_{{$index}}">{{$adssetting->admob_pub_id}}</a>
                            </td>
                            <td>{{$adssetting->admob_app_id}}
                            </td>
                            <td>{{$adssetting->admob_bads_id}}</td>
                            <td>{{$adssetting->admob_iads_id}}
                            </td>
                            <td>{{$adssetting->user->fullname}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('admin.adssettings.edit',$adssetting->id)}}" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.adssettings.destroy',$adssetting->id)}}" method="post" class="mx-1"
                                        style="width:fit-content;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="showModalset_{{$index}}" tabindex="-1" role="dialog"
                            aria-labelledby="showModalset_{{$index}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalset_{{$index}}">{{$adssetting->admob_pub_id}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2>@lang('site.admob_settings')</h2>
                                                <div class="row ">
                                                    <div class="col-md-5">
                                                        @lang('site.pub_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->admob_pub_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.app_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->admob_app_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.bads_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->admob_bads_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.iads_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->admob_iads_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.rads_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->admob_rads_id}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h2>@lang('site.facebook_settings')</h2>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.app_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->facebook_app_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.bads_p_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->facebook_bads_p_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.rads_p_id')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->facebook_rads_p_id}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.user')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->user->fullname}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @lang('site.status')
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{$adssetting->getActive()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tile-footer ">
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.adssettings.index')}}" class="btn btn-secondary" title="@lang('site.show_all')">
                        <i class="fas fa-eye"></i> @lang('site.show_all')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection