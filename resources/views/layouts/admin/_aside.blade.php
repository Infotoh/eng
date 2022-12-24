<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar" style="::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ asset('admin_assets/images/default.png') }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth('admin')->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth('admin')->user()->roles->first()->name }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li>
            <a class="app-menu__item" href="{{ route('dashboard.admin.welcome') }}">
                <i class="app-menu__icon fa fa-home"></i> 
                <span class="app-menu__label">@lang('site.home')</span>
            </a>
        </li>

        {{--roles--}}
        @if (auth('admin')->user()->hasPermission('read_roles'))

            <li>
                <a class="app-menu__item {{ request()->segment(3) == 'roles' ? 'active' : '' }}" href="{{ route('dashboard.admin.roles.index') }}">
                    <i class="app-menu__icon fa fa-lock"></i> 
                    <span class="app-menu__label">@lang('roles.roles')</span>
                </a>
            </li>

        @endif

        {{--admins--}}
        @if (auth('admin')->user()->hasPermission('read_admins'))

            <li>
                <a class="app-menu__item {{ request()->segment(3) == 'admins' ? 'active' : '' }}" href="{{ route('dashboard.admin.admins.index') }}">
                    <i class="app-menu__icon fa fa-users"></i> 
                    <span class="app-menu__label">@lang('admins.admins')</span>
                </a>
            </li>

        @endif

        {{--users--}}
        @if (auth('admin')->user()->hasPermission('read_users'))

            <li>
                <a class="app-menu__item {{ request()->segment(3) == 'users' ? 'active' : '' }}" href="{{ route('dashboard.admin.users.index') }}">
                    <i class="app-menu__icon fa fa-users"></i> 
                    <span class="app-menu__label">@lang('users.users')</span>
                </a>
            </li>

        @endif

        {{--consultations--}}
        @if (auth('admin')->user()->hasPermission('read_consultations'))

            <li>
                <a class="app-menu__item {{ request()->segment(3) == 'consultations' ? 'active' : '' }}" href="{{ route('dashboard.admin.consultations.index') }}">
                    <i class="app-menu__icon fa fa-users"></i> 
                    <span class="app-menu__label">@lang('consultations.consultations')</span>
                </a>
            </li>

        @endif

        {{--profile--}}
        <li class="treeview {{ request()->is('*profile*') || request()->is('*password*')  ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">@lang('users.profile')</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('dashboard.admin.profile.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.edit_profile')</a></li>
                <li><a class="treeview-item" href="{{ route('dashboard.admin.profile.password.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.change_password')</a></li>
            </ul>
        </li>

        {{--categorys--}}
        @if (auth('admin')->user()->hasPermission('read_categoreys'))

            {{--categorys--}}
            <li class="treeview {{ request()->is('*categorys*')  ? 'is-expanded' : '' }}">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">@lang('categoreys.categoreys')</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @php
                        $categoreys = \App\Models\Categorey::all();
                    @endphp

                    <li>
                        <a class="treeview-item" href="{{ route('dashboard.admin.categorys.index') }}">
                        <i class="icon fa fa-circle-o"></i>
                        @lang('categoreys.all')</a>
                    </li>

                    @foreach ($categoreys as $category)

                        <li>
                            <a class="treeview-item" href="{{ route('dashboard.admin.categorys.index',['status' => $category->id ]) }}">
                                <i class="icon fa fa-circle-o"></i>
                                {{ $category->name }}
                            </a>
                        </li>
                        
                    @endforeach

                </ul>
            </li>

        @endif

    </ul>
</aside>
