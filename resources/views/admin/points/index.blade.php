@extends('layouts.admin.app')
@section('title',' | ' . __('site.ads') )

@section('content')
<div class="row mb-2">
    <div class="card">
        <div class="card-header  bg-white">
            <h3 class="card-title">
                @lang('site.search')
            </h3>
        </div>
        <div class="card-body p-1">
            <form action="{{ route('admin.ads.index') }}" method="get">
                <div class="row m-2 col-md-12">
                    <div class="form-group p-0 m-0 px-2">
                        <label class="py-1 m-0" for="name">@lang('site.name')</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                    <div class="form-group d-flex justify-content-center p-0 m-0 p-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i>
                            @lang('site.search')</button>
                            <a class="btn btn-primary btn-sm mx-2" href="{{route('admin.ads.create')}}">
                                <i class="fas fa-plus"></i>     @lang('site.add')
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
            <div class="d-flex justify-content-between">
            <h3 class="card-title">
                @lang('site.ads')  
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
                            <td>@lang('site.name')</td>
                            <td>@lang('site.points')</td>
                            <td>@lang('site.view_counts')</td>
                            <td>@lang('site.actions')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $index=>$point)
                        <tr style="">
                            <td>{{$index + 1}}</td>
                            <td>{{$point->name}}
                            </td>
                            <td>{{$point->points}}</td>
                            <td>{{$point->times}}</td>
                            <td><div class="d-flex">
                                <a href="{{route('admin.ads.edit',$point->id)}}"
                                    class="btn btn-success btn-sm mx-1">
                                    <i class="fas fa-edit text-white"></i></a>
                                    <form action="{{route('admin.ads.destroy',$point->id)}}" method="post" class="mx-1"
                                        style="width:fit-content;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </form>
                                    </div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{$points->appends(request()->query())->links()}}
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
