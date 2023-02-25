@extends('layouts.admin.app')
@section('title',' | ' . __('site.edit') .' - '. __('site.adsSettings'))
@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.edit')   @lang('site.adsSettings')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.adssettings.update',$adssetting->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row m-2">
                    <div class=" col-md-6">
                        <h2>@lang('site.admob_settings')</h2>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="admob_pub_id">@lang('site.admob_pub_id')</label></label><span class="text-danger">*</span>
                            <input type="text" name="admob_pub_id" class="form-control  @error('admob_pub_id') is-invalid @enderror" placeholder="@lang('site.admob_pub_id')" id="admob_pub_id"
                                value="{{ $adssetting->admob_pub_id}}">
                                @error('admob_pub_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="admob_app_id">@lang('site.admob_app_id')</label></label><span class="text-danger">*</span>
                            <input type="text" name="admob_app_id" class="form-control  @error('admob_app_id') is-invalid @enderror" placeholder="@lang('site.admob_app_id')"
                                id="admob_app_id" value="{{ $adssetting->admob_app_id}}">
                                @error('admob_app_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="admob_bads_id">@lang('site.admob_bads_id')</label></label><span class="text-danger">*</span>
                            <input type="text" name="admob_bads_id" class="form-control  @error('admob_bads_id') is-invalid @enderror" placeholder="@lang('site.admob_bads_id')" id="admob_bads_id"
                                value="{{ $adssetting->admob_bads_id}}">
                                @error('admob_bads_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="admob_iads_id">@lang('site.admob_iads_id')</label></label><span class="text-danger">*</span>
                            <input type="text" name="admob_iads_id" class="form-control  @error('admob_iads_id') is-invalid @enderror" placeholder="@lang('site.admob_iads_id')" id="admob_iads_id"
                                value="{{ $adssetting->admob_iads_id}}">
                                @error('admob_iads_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="admob_rads_id">@lang('site.admob_rads_id')</label></label><span class="text-danger">*</span>
                            <input type="text" name="admob_rads_id" class="form-control  @error('admob_rads_id') is-invalid @enderror" placeholder="@lang('site.admob_rads_id')" id="admob_rads_id"
                                value="{{ $adssetting->admob_rads_id}}">
                                @error('admob_rads_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <h2>@lang('site.facebook_settings')</h2>
                    <div class="form-group p-0 m-0 px-2">
                        <label class="py-1 m-0" for="facebook_app_id">@lang('site.facebook_app_id')</label></label><span class="text-danger">*</span>
                        <input type="text" name="facebook_app_id" class="form-control  @error('facebook_app_id') is-invalid @enderror" placeholder="@lang('site.facebook_app_id')" id="facebook_app_id"
                            value="{{ $adssetting->facebook_app_id}}">
                            @error('facebook_app_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="form-group p-0 m-0 px-2">
                        <label class="py-1 m-0" for="facebook_bads_p_id">@lang('site.facebook_bads_p_id')</label></label><span class="text-danger">*</span>
                        <input type="text" name="facebook_bads_p_id" class="form-control  @error('facebook_bads_p_id') is-invalid @enderror" placeholder="@lang('site.facebook_bads_p_id')" id="facebook_bads_p_id"
                            value="{{ $adssetting->facebook_bads_p_id}}">
                            @error('facebook_bads_p_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div><div class="form-group p-0 m-0 px-2">
                        <label class="py-1 m-0" for="facebook_rads_p_id">@lang('site.facebook_rads_p_id')</label></label><span class="text-danger">*</span>
                        <input type="text" name="facebook_rads_p_id" class="form-control  @error('facebook_rads_p_id') is-invalid @enderror" placeholder="@lang('site.facebook_rads_p_id')"
                            id="facebook_rads_p_id" value="{{ $adssetting->facebook_rads_p_id}}">
                            @error('facebook_rads_p_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>{{--
                    <div class="form-group p-0 m-0 px-2">
                        <label class="py-1 m-0" for="user_id">@lang('site.user')</label></label><span class="text-danger">*</span>
                        <select class="form-control  @error('user_id') is-invalid @enderror custom-select select2bs4" id="user_id" name="user_id">
                            <option value="" selected disabled>@lang('site.choose_user')</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}} " {{ $adssetting->user_id == $user->id ? 'selected' : '' }}>
                            {{$user->fullname}}</option>
                            @endforeach
                        </select>
                            @error('user_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>--}}
                    <div class="form-group  pt-4  d-flex">
                        <label for="active">@lang('site.status')</label>
                        <div class="toggle-flip mx-3">
                            <label>
                                <input type="checkbox" name="active" id="active" {{$adssetting->active==1 ? 'checked' : ''}}
                                value="{{$adssetting->active}}">
                                <span class="flip-indecator" data-toggle-on="@lang('site.inactivate')" 
                                data-toggle-off="@lang('site.activate')" ></span>
                            </label>
                        </div>
                        @error('active')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                            @lang('site.edit')</button>
                        <a href="{{route('admin.adssettings.index')}}" class="btn btn-danger btn-sm mx-2 text-white">
                            <i class="fas fa-home text-white"></i>
                            @lang('site.cancel')
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection