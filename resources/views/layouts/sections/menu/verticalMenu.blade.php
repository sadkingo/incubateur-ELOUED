<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img width="150" src="{{ asset('assets/logo/logo.jpg') }}" alt="brand-logo" srcset="" style="width:  70px; height: 70px; border-radius: 50%">
                {{-- @include('_partials.macros',["width"=>25,"withbg"=>'#696cff']) --}}
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
                    <i class='text-primary menu-icon bx bxs-dashboard'></i>
                    <div>{{ trans('menu.dashboard') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.admins.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.admins.index') }}" class="menu-link">
                    <i class="text-success menu-icon fa fa-user-secret" aria-hidden="true"></i>
                    <div>{{ trans('menu.admins') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.teachers.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.teachers.index') }}" class="menu-link">
                    <i class="text-success menu-icon fa fa-users" aria-hidden="true"></i>
                    <div>{{ trans('menu.teachers') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.commission.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.commission.index') }}" class="menu-link">
                    <i class="text-success menu-icon fa fa-users" aria-hidden="true"></i>
                    <div>{{ trans('menu.commissions') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.students.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.students.index') }}" class="menu-link">
                    <i class="text-warning menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div>{{ trans('menu.students') }}</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('dashboard.projet.index')}}" class="menu-link">
                    <i class='bx bx-buildings bx-flip-horizontal' ></i>               
                    <div >{{ trans('menu.projects') }}</div>
                </a>
            </li>
        @elseif(auth('student')->check())
            <li class="menu-item {{ request()->routeIs('student.index') ? 'active' : '' }}">
                <a href="{{ route('student.index') }}" class="menu-link">
                    <i class="text-warning menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div>{{ trans('menu.students') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('students.project') ? 'active' : '' }}">
                <a href="{{ route('student.project.index')}}" class="menu-link">
                    <i class='bx bx-buildings bx-flip-horizontal' ></i>               
                    <div >{{ trans('menu.projects') }}</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('students.certificates') ? 'active' : '' }}">
                <a href="{{ url('student/certificates/' . auth('student')->id()) }}" class="menu-link">
                    <i class='bx bx-buildings bx-flip-horizontal' ></i>               
                    <div>{{ trans('menu.certificates') }}</div>
                </a>
            </li>
            
           
            
        @elseif(auth('teacher')->check())
            <li class="menu-item {{ request()->routeIs('student.index') ? 'active' : '' }}">
                <a href="{{ route('teacher.students.index') }}" class="menu-link">
                    <i class="text-warning menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div>{{ trans('menu.students') }}</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('teacher.project.projects')}}" class="menu-link">
                    <i class='bx bx-buildings bx-flip-horizontal' ></i>               
                    <div >{{ trans('menu.projects') }}</div>
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

        @if (auth('admin')->check())
            {{-- <li class="menu-item {{ request()->routeIs('dashboard.certificates.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.certificates.index') }}" class="menu-link">
                    <i class="text-dark menu-icon bx bxs-certification" aria-hidden="true"></i>
                    <div>{{ trans('menu.certificates') }}</div>
                </a>
            </li> --}}
            <li class="menu-item {{ request()->routeIs('dashboard.settings.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.settings.index') }}" class="menu-link">
                    <i class="text-info menu-icon bx bxs-cog" aria-hidden="true"></i>
                    <div>{{ trans('menu.settings') }}</div>
                </a>
            </li>
        @endif
    </ul>

</aside>
