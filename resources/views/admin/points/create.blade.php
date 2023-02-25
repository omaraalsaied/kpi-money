@extends('layouts.admin.app')
@section('title',' | ' . __('site.add') .' - ' . __('site.ads'))
@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
               @lang('site.add')    @lang('site.ad')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.ads.store') }}" method="post">
                @csrf
                @method('post')
                <div class="row m-2 col-md-12">
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="name">@lang('site.name')</label></label><span class="text-danger">*</span>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('site.name')"
                            id="name" value="{{ old('name') }}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="points">@lang('site.points')</label></label><span class="text-danger">*</span>
                        <input type="number" name="points" class="form-control @error('points') is-invalid @enderror" placeholder="@lang('site.points')"
                            id="points" value="{{ old('points') }}"min="0" step="1">
                        @error('points') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="times">@lang('site.view_counts')</label></label><span class="text-danger">*</span>
                        <input type="number" name="times" class="form-control @error('times') is-invalid @enderror" placeholder="@lang('site.view_counts')"
                            id="times" value="{{ old('times') }}"min="0" step="1">
                        @error('times') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>
                            @lang('site.save')</button>
                        <a href="{{route('admin.ads.index')}}" class="btn btn-primary btn-sm mx-2 text-white">
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