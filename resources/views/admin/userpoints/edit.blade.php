@extends('layouts.admin.app')
@section('title',' | ' . __('site.websitelinks'))
@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
               @lang('site.edit')    @lang('site.websitelink')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.websitelinks.update',$websitelink->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row m-2 col-md-12">
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="title">@lang('site.title')</label></label><span class="text-danger">*</span>
                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror " placeholder="@lang('site.title')"
                            id="title" value="{{ $websitelink->title }}">
                        @error('title') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="site_url">@lang('site.site_url')</label></label><span class="text-danger">*</span>
                        <input type="url" name="site_url" class="form-control  @error('site_url') is-invalid @enderror " placeholder="@lang('site.site_url')"
                            id="site_url" value="{{ $websitelink->site_url }}">
                        @error('site_url') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="code_number">@lang('site.code_number')</label></label><span class="text-danger">*</span>
                        <input type="text" name="code_number" class="form-control  @error('code_number') is-invalid @enderror "
                            placeholder="@lang('site.code_number')" id="code_number"
                            value="{{ $websitelink->code_number }}">
                        @error('code_number') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="reward">@lang('site.reward')</label></label><span class="text-danger">*</span>
                        <input type="text" name="reward" class="form-control  @error('reward') is-invalid @enderror " placeholder="@lang('site.reward')"
                            id="reward" value="{{ $websitelink->reward }}">
                        @error('reward') <span class="text-danger">{{$message}}</span> @enderror
                    </div>{{-- 
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="user_id">@lang('site.user')</label></label><span class="text-danger">*</span>
                        <select class="form-control  @error('user_id') is-invalid @enderror  custom-select select2bs4" id="user_id" name="user_id">
                            <option value="" selected disabled>@lang('site.choose_user')</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}" {{ $websitelink->user_id== $user->id ? 'selected' : '' }}>
                                {{$user->fullname}}</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div> --}}
                    <div class="form-group col-md-6  pt-4  d-flex">
                        <label for="active">@lang('site.status')</label>
                        <div class="toggle-flip mx-3">
                            <label>
                                <input type="checkbox" name="active" id="active" {{$websitelink->active==1 ? 'checked' : ''}}
                                value="{{$websitelink->active}}">
                                <span class="flip-indecator" data-toggle-on="@lang('site.inactivate')" 
                                data-toggle-off="@lang('site.activate')" ></span>
                            </label>
                        </div>
                        @error('active')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                            @lang('site.edit')</button>
                        <a href="{{route('admin.websitelinks.index')}}" class="btn btn-primary btn-sm mx-2 text-white">
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