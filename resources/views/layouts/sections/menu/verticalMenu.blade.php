<style>
    .icon-text-spacing {
    margin-left: 10px;
}
.menu-link i {
    margin-right: 2px;
}
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
          <span class="app-brand-logo demo fs-5 d-flex align-items-center">
            <img width="58" src="{{ asset('assets/logo/logo.jpg') }}" alt="brand-logo" style="width: 50px;height: 50px;border-radius: 50%" class="{{ app()->isLocale('ar') ? 'me-2' : 'ms-2' }} fw-bold">
            Incubateur Eloued
          </span>
            {{-- <span class="app-brand-text demo menu-text fw-bold text-capitalize ms-2">
                {{ config('app.locale') == 'en' ? 'Kaid' : 'القايد' }}
            </span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-autod-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ trans('menu.dashboard') }}</span>
        </li> --}}
        @if (auth('admin')->check())
            <li class="menu-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <i class='menu-icon bx bxs-dashboard'></i>
                    <div>{{ trans('menu.dashboard') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admins') ? 'active' : '' }}">
                <a href="{{ route('admins') }}" class="menu-link">
                    <i class="menu-icon mdi mdi-security" aria-hidden="true"></i>
                    <div>{{ trans('menu.admins') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('managers') ? 'active' : '' }}">
                <a href="{{ route('managers') }}" class="menu-link">
                    <i class="menu-icon mdi mdi-office-building-cog-outline" aria-hidden="true"></i>
                    <div>{{ trans('menu.managers') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('faculties') ? 'active' : '' }}">
                <a href="{{ route('faculties') }}" class="menu-link">
                    <i class="menu-icon mdi mdi-office-building-cog-outline" aria-hidden="true"></i>
                    <div>{{ trans('menu.faculties') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teachers') ? 'active' : '' }}">
                <a href="{{ route('teachers') }}" class="menu-link">
                    <i class="menu-icon mdi mdi-pencil-ruler-outline" aria-hidden="true"></i>
                    <div>{{ trans('menu.teachers') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('commissions') ? 'active' : '' }}">
                <a href="{{ route('commissions') }}" class="menu-link">
                    <i class="menu-icon mdi mdi-gavel" aria-hidden="true"></i>
                    <div>{{ trans('menu.commissions') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.students') ? 'active' : '' }}">
                <a href="{{ route('dashboard.students') }}" class="menu-link">
                    <i class="menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div>{{ trans('menu.students') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.projects') ? 'active' : '' }}">
                <a href="{{ route('dashboard.projects')}}" class="menu-link">
                    <i class="menu-icon bx bx-buildings bx-flip-horizontal" ></i>
                    <div class="icon-text-spacing">{{ trans('menu.projects') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('certificates') ? 'active' : '' }}">
                <a href="{{ route('certificates') }}" class="menu-link">
                    <i class='menu-icon bx bxs-certification bx-flip-horizontal'></i>
                    <div>{{ trans('menu.certificates') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('statistics.index') ? 'active' : '' }}">
                <a href="{{ route('statistics.index')}}" class="menu-link ">
                    <i class="menu-icon fa-solid fa-chart-bar"></i>
                    <div>{{ trans('menu.statistics') }}</div>
                </a>
            </li>
        @elseif(auth('student')->check())
            <li class="menu-item {{ request()->routeIs('dashboard.students') ? 'active' : '' }}">
                <a href="{{ route('dashboard.students') }}" class="menu-link">
                    <i class="menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div>{{ trans('menu.students') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.projects') ? 'active' : '' }}">
                <a href="{{ route('dashboard.projects')}}" class="menu-link">
                    <i class="menu-icon bx bx-buildings bx-flip-horizontal" ></i>
                    <div >{{ trans('menu.projects') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('project.tracking') ? 'active' : '' }}">
                <a href="{{ route('project.tracking') }}" class="menu-link">
                    <i class='menu-icon mdi mdi-file-search-outline'></i>
                    <div>{{ trans('project.project_tracking') }}</div>
                </a>
            </li>
            {{-- <li class="menu-item {{ request()->routeIs('student.certificates') ? 'active' : '' }}">
                <a href="{{ url('students/certificates/' . auth('student')->user()->id) }}" class="menu-link">
                    <i class='bx bxs-certification bx-flip-horizontal'></i>
                    <div>{{ trans('menu.certificates') }}</div>
                </a>
            </li> --}}
        @elseif(auth('teacher')->check())
            {{-- <li class="menu-item {{ request()->routeIs('dashboard.students') ? 'active' : '' }}">
                <a href="{{ route('dashboard.students') }}" class="menu-link">
                    <i class="menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div>{{ trans('menu.students') }}</div>
                </a>
            </li> --}}
            <li class="menu-item {{ request()->routeIs('dashboard.projects') ? 'active' : '' }}">
                <a href="{{ route('dashboard.projects')}}" class="menu-link">
                    <i class="menu-icon bx bx-buildings bx-flip-horizontal" ></i>
                    <div >{{ trans('menu.projects') }}</div>
                </a>
            </li>
        @elseif(auth('manager')->check())
          <li class="menu-item">
            <a href="{{ route('manager.index')}}" class="menu-link">
                <i class="menu-icon bx bx-buildings bx-flip-horizontal" ></i>
                <div class="icon-text-spacing">{{ trans('menu.projects') }}</div>
            </a>
          </li>

          <li class="menu-item {{ request()->routeIs('supervisors') ? 'active' : '' }}">
            <a href="{{ route('supervisors')}}" class="menu-link">
                <i class="menu-icon mdi mdi-pencil-ruler-outline" ></i>
                <div class="icon-text-spacing">{{ trans('menu.supervisors') }}</div>
            </a>
          </li>



        @endif

        {{-- <li class="menu-item {{ request()->routeIs('dashboard.subjects.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.subjects.index') }}" class="menu-link">
                <i class="text-danger menu-icon bx bxs-purchase-tag" aria-hidden="true"></i>
                <div>{{ trans('menu.subjects') }}</div>
            </a>
        </li> --}}
        {{-- <li class="menu-item {{ request()->routeIs('dashboard.attendence.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.attendence.index') }}" class="menu-link">
                <i class="text-info menu-icon bx bxs-time" aria-hidden="true"></i>
                <div>{{ trans('menu.attendence') }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.evaluations.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.evaluations.index') }}" class="menu-link">
                <i class="text-warning menu-icon fa fa-star" aria-hidden="true"></i>
                <div>{{ trans('menu.evaluations') }}</div>
            </a>
        </li> --}}

        {{-- @if (auth('admin')->check()) --}}
            {{-- <li class="menu-item {{ request()->routeIs('certificates.index') ? 'active' : '' }}">
                <a href="{{ route('certificates.index') }}" class="menu-link">
                    <i class="text-dark menu-icon bx bxs-certification" aria-hidden="true"></i>
                    <div>{{ trans('menu.certificates') }}</div>
                </a>
            </li> --}}
            {{-- <li class="menu-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                <a href="{{ route('settings.index') }}" class="menu-link">
                    <i class="menu-icon bx bxs-cog" aria-hidden="true"></i>
                    <div>{{ trans('menu.settings') }}</div>
                </a>
            </li> --}}
        {{-- @endif --}}

    </ul>

</aside>
