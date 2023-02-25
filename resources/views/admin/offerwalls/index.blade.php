@extends('layouts.admin.app')
@section('title',' | ' .  __('site.offerwalls'))
@section('styles')
   <style>
    p{text-indent: 0px!important;}
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
        <form action="{{ route('admin.offerwalls.index') }}" method="get">
            <div class="row m-2 col-md-12">
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="name">@lang('site.name')</label>
                    <input type="text" name="name" class="form-control" placeholder="@lang('site.name')" id="name"
                        value="{{ request()->name }}">
                </div>
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="subtitle">@lang('site.subtitle')</label>
                    <input type="text" name="subtitle" class="form-control" placeholder="@lang('site.subtitle')" id="subtitle"
                        value="{{ request()->subtitle }}">
                </div>
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="url">@lang('site.url')</label>
                    <input type="url" name="url" class="form-control" placeholder="@lang('site.url')" id="url"
                        value="{{ request()->url }}">
                </div>
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="points">@lang('site.points')</label>
                    <input type="text" name="points" class="form-control" placeholder="@lang('site.points')" id="points"
                        value="{{ request()->points }}">
                </div>
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="type">@lang('site.type')</label>
                    <input type="text" name="type" class="form-control" placeholder="@lang('site.type')" id="type"
                        value="{{ request()->type }}">
                </div>
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="featured">@lang('site.featured')</label>
                    <input type="text" name="featured" class="form-control" placeholder="@lang('site.featured')" id="featured"
                        value="{{ request()->featured }}">
                </div>
                <div class="form-group col-md-3 p-0 m-0 px-2">
                    <label class="py-1 m-0" for="position">@lang('site.position')</label>
                    <input type="text" name="position" class="form-control" placeholder="@lang('site.position')" id="position"
                        value="{{ request()->position }}">
                </div>
                <div class="d-flex justify-content-center my-2">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i>
                        @lang('site.search')</button>
                    <a href="{{route('admin.offerwalls.create')}}" class="btn btn-primary btn-sm mx-2 text-white">
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
                @lang('site.offerwalls')
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
                                    <img src="{{asset($offerwall->image)}}" alt="{{$offerwall->name}}"
                                    style="height: 50px;width: 100%;"class="img-thumbnail">
                                @endif</td>
                            <td>{{$offerwall->type}}</td>
                            <td>{{$offerwall->featured}}</td>
                            <td>{{$offerwall->position}}</td>
                            <td>
                                <div class="d-flex">
                                <a href="{{route('admin.offerwalls.edit',$offerwall->id)}}" class="btn btn-success btn-sm mx-1">
                                    <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.offerwalls.destroy',$offerwall->id)}}" method="post" class="mx-1" style="width:fit-content;">
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
            <div class="d-flex justify-content-center">
                {{$offerwalls->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
