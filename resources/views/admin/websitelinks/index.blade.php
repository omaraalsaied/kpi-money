@extends('layouts.admin.app')
@section('title',' | ' . __('site.websitelinks'))

@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.search')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.websitelinks.index') }}" method="get">
                <div class="row m-2 col-md-12">
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="title">@lang('site.title')</label>
                        <input type="text" name="title" class="form-control" placeholder="@lang('site.title')" id="title"
                            value="{{ request()->title }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="site_url">@lang('site.site_url')</label>
                        <input type="url" name="site_url" class="form-control" placeholder="@lang('site.site_url')"
                            id="site_url" value="{{ request()->site_url }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="code_number">@lang('site.code_number')</label>
                        <input type="text" name="code_number" class="form-control" placeholder="@lang('site.code_number')" id="code_number"
                            value="{{ request()->code_number }}">
                    </div>
                    <div class="form-group col-md-4 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="reward">@lang('site.reward')</label>
                        <input type="text" name="reward" class="form-control" placeholder="@lang('site.reward')" id="reward"
                            value="{{ request()->reward }}">
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
                        <a href="{{route('admin.websitelinks.create')}}" class="btn btn-primary btn-sm mx-2 text-white">
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
                @lang('site.websitelinks')
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
                                <a href="#" data-toggle="modal"
                                    data-target="#showModal_{{$index}}">{{$websitelink->title}}</a>
                            </td>
                            <td>
                                <a href="{{$websitelink->site_url}}" >@lang('site.link')</a>
                            </td>
                            <td>{{$websitelink->code_number}}</td>
                            <td>{{$websitelink->reward}}
                            </td>
                            <td>{{$websitelink->user->fullname}}</td>
                            <td><div class="d-flex">
                                <a href="{{route('admin.websitelinks.edit',$websitelink->id)}}"
                                    class="btn btn-success btn-sm mx-1">
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
                                                       <a href="{{$websitelink->site_url}}" >
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
            <div class="d-flex justify-content-center">
                {{$websitelinks->appends(request()->query())->links()}}
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
