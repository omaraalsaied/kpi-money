@extends('layouts.admin.app')
@section('title',' | ' . __('site.users_earn') .' - ' . __('site.websitelink'))

@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.search')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.userpoints.index') }}" method="get">
                <div class="row m-2 col-md-12">
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="user_id">@lang('site.user')</label>
                        <select class="form-control custom-select select2bs4" id="user_id" name="user_id">
                            <option value="" selected >@lang('site.choose_user')</option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}" {{ request()->user_id== $user->id ? 'selected' : '' }}>
                                {{$user->fullname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 p-0 m-0 px-2">
                        <label class="py-1 m-0" for="link_id">@lang('site.link')    @lang('site.title')</label>
                        <select class="form-control custom-select select2bs4" id="link_id" name="link_id">
                            <option value="" selected >@lang('site.choose_link')</option>
                            @foreach ($links as $link)
                            <option value="{{$link->id}}" {{ request()->link_id== $link->id ? 'selected' : '' }}>
                                {{$link->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i>
                            @lang('site.search')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="card card-light ">
        <div class="card-header  bg-white">
            <div class="d-flex justify-content-between">
            <h3 class="card-title">
                @lang('site.users_earn')   @lang('site.websitelink')
            </h3>
            </div>
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
                            <td>@lang('site.user')</td>
                            <td>@lang('site.link')</td>
                            <td>@lang('site.earn')</td>
                            <td>@lang('site.date')</td>
                        </tr>
                    </thead>
                    <tbody>
                    {{--<span style="display: none;">{{$total=0}}</span>--}}
                        @foreach ($userpoints as $index=>$userpoint)
                        <tr style="">
                            <td>{{$index + 1}}</td>
                            <td>{{$userpoint->user->fullname}}
                            </td>

                            <td>
                            <a href="{{$link->site_url}}" target="_blank">{{$userpoint->link->title}}</a>
                            </td>
                            <td><span class="text-primary">+</span>{{' '.$userpoint->earn}}</td>
                            <td>{{$userpoint->created_at}}</td>
                            {{--<td style="display: none;">{{$total+= $userpoint->earn}}</td>--}}
                        </tr>
                        @endforeach{{--
                        <tr><td colspan="3" class="text-center">@lang('site.total_earn')</td>
                        <td colspan="2" class="text-center">{{$total}}</td></tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{$userpoints->appends(request()->query())->links()}}
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
