<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar " style="height: 8rem;width: 8rem;"
            src="{{auth()->user()->image!='' ? asset(auth()->user()->image) : asset('uploads/default.jpg')}}"
            alt="{{auth()->user()->name}}">
        <div class="mt-2 d-grid justify-content-center"style="width: 12rem;">
            <p class="app-sidebar__user-name">{{auth()->user()->fullname}}</p>
            <p class="app-sidebar__user-designation">{{auth()->user()->login}}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ request()->routeIs('admin.index') ? 'active' : '' }}"
                href="{{route('admin.index')}}" title="@lang('site.dashboard')">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">@lang('site.dashboard')</span>
            </a>
        </li>{{--
        <li>
            <a href="{{route('admin.offerwalls.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.offerwalls*') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-dot-circle"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.offerwalls')
                    <span
                        class="right badge badge-info">{{\App\Models\Offerwall::count()}}</span>
                </span>
            </a>
        </li>--}}
        <li>
            <a href="{{route('admin.websitelinks.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.websitelinks*') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-tags"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.websitelink')
                    <span
                        class="right badge badge-info">{{\App\Models\WebSiteLink::count()}}</span>
                </span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.userpoints.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.userpoints.index') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-money"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.users_earn')    @lang('site.links'){{--
                    <span
                        class="right badge badge-info">{{\App\Models\UserPoint::count()}}</span>--}}
                </span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.ads.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.ads*') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-ad"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.ads')   
                    <span
                        class="right badge badge-info">{{\App\Models\Point::count()}}</span>
                </span>
            </a>
        </li>{{--
        <li>
            <a href="{{route('admin.adsperms.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.adsperms*') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-ad"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.adsperm')   
                    <span
                        class="right badge badge-info">{{\App\Models\UserPointPerm::count()}}</span>
                </span>
            </a>
        </li>--}}
        <li>
            <a href="{{route('admin.useraderarns.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.useraderarns.index') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-money"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.users_earn')    @lang('site.ads')
                </span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.adssettings.index')}}"
                class="app-menu__item {{ request()->routeIs('admin.adssettings*') ? 'active' : '' }}">
                <i class="app-menu__icon fas fa-cogs"></i>
                <span class="app-menu__label d-flex justify-content-between">
                    @lang('site.adsSetting')
                    <span
                        class="right badge badge-info">{{\App\Models\AdsSetting::count()}}</span>
                </span>
            </a>
        </li>
    </ul>
</aside>
