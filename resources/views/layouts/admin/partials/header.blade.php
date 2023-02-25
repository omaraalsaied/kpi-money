<!-- Navbar-->
<header class="app-header">
    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
        aria-label="Hide Sidebar"></a>
    <a class="app-header__logo" href="{{route('admin.index')}}" style="background-color:#009688;">
        {{ __('site.app_name')}}
    </a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search" style="display:none;">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!-- Notifications Dropdown Menu -->
    
        <!-- Account Dropdown Menu -->
        <li class=" dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Cache Clear">
                <i class="fas fa-sync-alt fa-lg"></i>
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right" style="
                    right: inherit; left: 0px; text-align:right;">
                <a href="{{route('admin.clear.views')}}" class="dropdown-item" style="text-align: start"
                    title="@lang('site.clear_views')">
                    <i class="fas fa-sync"></i> @lang('site.clear_views')
                </a>
                <a href="{{route('admin.clear.config')}}" class="dropdown-item" style="text-align: start"
                    title="@lang('site.clear_contig')">
                    <i class="fas fa-sync"></i> @lang('site.clear_config')
                </a>
                <a href="{{route('admin.clear.routes')}}" class="dropdown-item" style="text-align: start"
                    title="@lang('site.clear_routes')">
                    <i class="fas fa-sync"></i> @lang('site.clear_routes')
                </a>
                <a href="{{route('admin.clear.cache')}}" class="dropdown-item" style="text-align: start"
                    title="@lang('site.clear_cache')">
                    <i class="fas fa-sync"></i> @lang('site.clear_cache')
                </a>
                <a href="{{route('admin.clear.optimize')}}" class="dropdown-item" style="text-align: start"
                    title="@lang('site.clear_optimize')">
                    <i class="fas fa-sync"></i> @lang('site.clear_optimize')
                </a>
            </ul>
        </li>
        <!-- Account Dropdown Menu -->
        <li class=" dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                <i class="fa fa-user fa-lg"></i>
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right" style="
                    right: inherit; left: 0px; text-align:right;">
                <a href="#" class="dropdown-item" style="text-align: start">
                    {{ auth()->user()->fullname }}</a>
                <a href="{{ route('logout') }}" class="dropdown-item" style="text-align:start"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> @lang('site.logout')
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </ul>
        </li>
    </ul>
</header>
