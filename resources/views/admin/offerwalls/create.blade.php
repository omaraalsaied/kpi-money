@extends('layouts.admin.app')
@section('title',' | ' . __('site.add').' - '. __('site.offerwalls'))
@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.add')   @lang('site.offerwalls')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.offerwalls.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="row m-2">
                    <div class="col-md-6">
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="name">@lang('site.name')</label></label><span class="text-danger">*</span>
                            <input type="text" name="name" class="form-control   @error('name') is-invalid @enderror  " placeholder="@lang('site.name')" id="name"
                                value="{{ old('name') }}">
                                @error('name') <span class="text-danger"></span> @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="subtitle">@lang('site.subtitle')</label></label><span class="text-danger">*</span>
                            <input type="text" name="subtitle" class="form-control   @error('subtitle') is-invalid @enderror  " placeholder="@lang('site.subtitle')"
                                id="subtitle" value="{{ old('subtitle') }}">
                                @error('subtitle') <span class="text-danger"></span> @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="url">@lang('site.url')</label><span class="text-danger">*</span>
                            <input type="url" name="url" class="form-control   @error('url') is-invalid @enderror  " placeholder="@lang('site.url')" id="url"
                                value="{{ old('url') }}">
                                @error('url') <span class="text-danger"></span> @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="points">@lang('site.points')</label></label><span class="text-danger">*</span>
                            <input type="text" name="points" class="form-control   @error('points') is-invalid @enderror  " placeholder="@lang('site.points')"
                                id="points" value="{{ old('points') }}">
                                @error('points') <span class="text-danger"></span> @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="type">@lang('site.type')</label></label><span class="text-danger">*</span>
                            <input type="text" name="type" class="form-control   @error('type') is-invalid @enderror  " placeholder="@lang('site.type')" id="type"
                                value="{{ old('type') }}">
                                @error('type') <span class="text-danger"></span> @enderror
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="featured">@lang('site.featured')</label></label><span class="text-danger">*</span>
                            <input type="text" name="featured" class="form-control   @error('featured') is-invalid @enderror  " placeholder="@lang('site.featured')"
                                id="featured" value="{{ old('featured') }}">
                                @error('featured') <span class="text-danger"></span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="image">@lang('site.image')</label></label><span class="text-danger">*</span>
                            <input type="file" name="image" class="form-control image   @error('image') is-invalid @enderror  "
                                placeholder="@lang('site.image')" id="image">
                            @error('image') <span class="text-danger"></span> @enderror
                            <img src="{{asset('uploads/default.jpg')}}" alt="Offerwall Image"class="img-thumbnail image-preview" style="width: 100%;height: 200px;">
                        </div>
                        <div class="form-group p-0 m-0 px-2">
                            <label class="py-1 m-0" for="position">@lang('site.position')</label></label><span class="text-danger">*</span>
                            <input type="text" name="position" class="form-control   @error('position') is-invalid @enderror  " placeholder="@lang('site.position')"
                                id="position" value="{{ old('position') }}">
                                @error('position') <span class="text-danger"></span> @enderror
                        </div>
                        <div class="form-group  pt-4  d-flex">
                            <label for="status">@lang('site.status')</label>
                            <div class="toggle-flip mx-3">
                                <label>
                                    <input type="checkbox" name="status" id="status" checked
                                    value="{{old('status')}}">
                                    <span class="flip-indecator" data-toggle-on="@lang('site.inactivate')" 
                                    data-toggle-off="@lang('site.activate')" ></span>
                                </label>
                            </div>
                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-add"></i>
                            @lang('site.add')</button>
                        <a href="{{route('admin.offerwalls.index')}}" class="btn btn-primary btn-sm mx-2 text-white">
                            <i class="fas fa-home text-white"></i>
                            @lang('site.cancel')
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection