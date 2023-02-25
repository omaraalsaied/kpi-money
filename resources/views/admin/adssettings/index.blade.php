@extends('layouts.admin.app')
@section('title',' | ' . __('site.adsSettings'))
@section('styles')
<style>
    p {
        text-indent: 0px !important;
    }
</style>
@endsection
@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.search')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.adssettings.index') }}" method="get">
                <div class="row m-2 col-md-12">
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="admob_pub_id">@lang('site.admob_pub_id')</label>
                        <input type="text" name="admob_pub_id" class="form-control" placeholder="@lang('site.admob_pub_id')" id="admob_pub_id"
                            value="{{ request()->admob_pub_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="admob_app_id">@lang('site.admob_app_id')</label>
                        <input type="text" name="admob_app_id" class="form-control" placeholder="@lang('site.admob_app_id')"
                            id="admob_app_id" value="{{ request()->admob_app_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="admob_bads_id">@lang('site.admob_bads_id')</label>
                        <input type="text" name="admob_bads_id" class="form-control" placeholder="@lang('site.admob_bads_id')" id="admob_bads_id"
                            value="{{ request()->admob_bads_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="admob_iads_id">@lang('site.admob_iads_id')</label>
                        <input type="text" name="admob_iads_id" class="form-control" placeholder="@lang('site.admob_iads_id')" id="admob_iads_id"
                            value="{{ request()->admob_iads_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="admob_rads_id">@lang('site.admob_rads_id')</label>
                        <input type="text" name="admob_rads_id" class="form-control" placeholder="@lang('site.admob_rads_id')" id="admob_rads_id"
                            value="{{ request()->admob_rads_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="facebook_app_id">@lang('site.facebook_app_id')</label>
                        <input type="text" name="facebook_app_id" class="form-control" placeholder="@lang('site.facebook_app_id')" id="facebook_app_id"
                            value="{{ request()->facebook_app_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="facebook_bads_p_id">@lang('site.facebook_bads_p_id')</label>
                        <input type="text" name="facebook_bads_p_id" class="form-control" placeholder="@lang('site.facebook_bads_p_id')" id="facebook_bads_p_id"
                            value="{{ request()->facebook_bads_p_id }}">
                    </div><div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="facebook_rads_p_id">@lang('site.facebook_rads_p_id')</label>
                        <input type="text" name="facebook_rads_p_id" class="form-control" placeholder="@lang('site.facebook_rads_p_id')"
                            id="facebook_rads_p_id" value="{{ request()->facebook_rads_p_id }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="user_id">@lang('site.user')</label>
                        <select class="form-control custom-select select2bs4" id="user_id" name="user_id">
                            <option value="" selected disabled>@lang('site.choose_user')</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}" {{ request()->user_id== $user->id ? 'selected' : '' }}>
                                {{$user->fullname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i>
                            @lang('site.search')</button>
                        <a href="{{route('admin.adssettings.create')}}" class="btn btn-primary btn-sm mx-2 text-white">
                            <i class="fas fa-plus text-white"></i>
                            @lang('site.add')
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="card card-light ">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.adsSettings')
            </h3>
        </div>
        <div class="card-body p-1 mt-1">
            <div class="table-responsive">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                        <p class="mb-0">{{session('success')}}</p>
                </div>
                @endif
                @if (session('errors'))
                <div class="alert alert-danger" role="alert">
                        <p class="mb-0">{{session('errors')}}</p>
                </div>
                @endif
                <table class="table table-bordered table-hover">
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
                                <a href="#" data-toggle="modal"
                                    data-target="#showModal_{{$index}}">{{$adssetting->admob_pub_id}}</a>
                            </td>
                            <td>{{$adssetting->admob_app_id}}
                            </td>
                            <td>{{$adssetting->admob_bads_id}}</td>
                            <td>{{$adssetting->admob_iads_id}}
                            </td>
                            <td>{{$adssetting->user->fullname}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('admin.adssettings.edit',$adssetting->id)}}"
                                        class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.adssettings.destroy',$adssetting->id)}}" method="post" class="mx-1" style="width:fit-content;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm">
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
                                        <h5 class="modal-title" id="showModal_{{$index}}">{{$adssetting->admob_pub_id}}</h5>
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
            <div class="d-flex justify-content-center">
                {{$adssettings->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function(){
             $('.select2bs4').select2();
        });
        </script>
@endsection
