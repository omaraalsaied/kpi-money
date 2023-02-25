@extends('layouts.admin.app')
@section('title',' | ' . __('site.add') .' - ' . __('site.adsperm'))
@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
               @lang('site.add')    @lang('site.adperm')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.adsperms.store') }}" method="post">
                @csrf
                @method('post')
                <div class="row m-2 col-md-12">
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="user_id">@lang('site.user')</label></label><span class="text-danger">*</span>
                        <select class="form-control  @error('user_id') is-invalid @enderror  custom-select select2bs4" id="user_id" name="user_id">
                            <option value="" selected disabled>@lang('site.choose_user')</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}" {{  old('user_id')== $user->id ? 'selected' : '' }}>
                                {{$user->fullname}}</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="point_id">@lang('site.ad')</label></label><span class="text-danger">*</span>
                        <select class="form-control  @error('point_id') is-invalid @enderror  custom-select select2bs4" id="point_id" name="point_id">
                            <option value="" selected disabled>@lang('site.choose_user')</option>
                            @foreach ($points as $point)
                            <option value="{{$point->id}}" {{  old('point_id')== $point->id ? 'selected' : '' }}>
                                {{$point->name}}</option>
                            @endforeach
                        </select>
                        @error('point_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="times">@lang('site.count')</label></label><span class="text-danger">*</span>
                        <input type="number" name="times" class="form-control @error('times') is-invalid @enderror" placeholder="@lang('site.count')"
                            id="times" value="{{ old('times') }}"min="0" step="1" value="0">
                        @error('times') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>
                            @lang('site.save')</button>
                        <a href="{{route('admin.adsperms.index')}}" class="btn btn-primary btn-sm mx-2 text-white">
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