@php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';

@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))

    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo fs-5 align-items-center">
            <img width="58" src="{{ asset('assets/logo/logo.jpg') }}" alt="brand-logo" style="width: 50px;height: 50px;border-radius: 50%" class="mx-2 fw-bold">
            Incubateur Eloued
          </span>
            {{-- <span class="app-brand-logo demo">
                <img width="150" src="{{ asset('assets/logo/logo.jpg') }}" alt="brand-logo" srcset="">

                @include('_partials.macros', ['width' => 25, 'withbg' => '#696cff'])
            </span> --}}
            <span class="app-brand-text demo menu-text fw-bolder">{{ config('variables.templateName') }}</span>
        </a>
    </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                aria-label="Search...">
        </div>
    </div>
    <!-- /Search -->
    <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- Place this tag where you want the button to render. -->
        {{-- <li class="nav-item lh-1 me-3">
            <a class="github-button" href="https://github.com/themeselection/sneat-html-laravel-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-laravel-admin-template-free on GitHub">Star</a>
          </li> --}}

        <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class='bx bx-globe bx-sm'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item {{ Session::get('locale') == 'en' ? 'active' : '' }}"
                        href="{{ url('lang/en') }}" data-language="en">
                        <span class="align-middle">{{ trans('app.English') }}</span>
                    </a>
                </li>
                <a class="dropdown-item {{ Session::get('locale') == 'ar' ? 'active' : '' }}"
                    href="{{ url('lang/ar') }}" data-language="de">
                    <span class="align-middle">{{ trans('app.Arabic') }}</span>
                </a>

        </li>
    </ul>


    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            @if (Session::get('theme') == 'dark')
                <i class='bx bx-moon bx-sm'></i>
            @else
                <i class='bx bx-sun bx-sm'></i>
            @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
            <li>
                <a class="dropdown-item" href="{{ url('theme/light') }}" data-theme="light">
                    <span class="align-middle"><i class='bx bx-sun me-2'></i>{{ trans('app.Light') }}</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('theme/dark') }}" data-theme="dark">
                    <span class="align-middle"><i class="bx bx-moon me-2"></i>{{ trans('app.Dark') }}</span>
                </a>
            </li>
        </ul>
    </li>

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
                @if (auth('admin')->check())
                    <img class="w-px-40 h-auto rounded-circle" src="{{ asset('assets/logo/logo.jpg') }}" alt="brand-logo" srcset="">
                @else
                  <img class="w-px-40 h-auto rounded-circle" src="{{ asset('assets/img/avatars/default.png') }}" alt="brand-logo" srcset="">
                @endif
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="javascript:void(0);">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                @if(auth('admin')->check())
                                  <img class="w-px-40 h-auto rounded-circle" src="{{ asset('assets/logo/logo.jpg') }}" alt="brand-logo" srcset="">
                                @else
                                  <img class="w-px-40 h-auto rounded-circle" src="{{ asset('assets/img/avatars/default.png') }}" alt="brand-logo" srcset="">
                                @endif
                            </div>
                        </div>
                        @if (auth('admin')->check())
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ auth('admin')->user()->name }}</span>
                                <small class="text-muted">{{ auth('admin')->user()->name }}</small>
                            </div>
                        @endif
                        @if (auth('student')->check())
                            <div class="flex-grow-1 d-flex align-items-center">
                                <span class="fw-semibold d-block">{{ auth('student')->user()->code }}</span>
                                {{-- <small class="text-muted">{{ auth('student')->user()->email }}</small> --}}
                            </div>
                        @endif
                        @if (auth('teacher')->check())
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ auth('teacher')->user()->name }}</span>
                                <small class="text-muted">{{ auth('teacher')->user()->email }}</small>
                            </div>
                        @endif
                        @if (auth('manager')->check())
                          <div class="flex-grow-1">
                              <span class="fw-semibold d-block">{{ auth('manager')->user()->name }}</span>
                              <small class="text-muted">{{ auth('manager')->user()->email }}</small>
                          </div>
                        @endif

                    </div>
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>

            {{-- 'student.account.index' --}}

            {{-- <li>
                <a class="dropdown-item" href="javascript:void(0);">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">{{ trans('app.profile') }}</span>
                </a>
            </li> --}}
            @if (auth('student')->check())
                {{-- <li>
                    <a class="dropdown-item" href="{{ route('account.index') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">{{ trans('app.profile') }}</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('student.index') }}">
                        <i class="fa fa-star"></i>
                        <span class="align-middle">{{ trans('app.review') }}</span>
                    </a>
                </li> --}}

            {{-- <li>
                <a class="dropdown-item" href="javascript:void(0);">
                    <i class='bx bx-cog me-2'></i>
                    <span class="align-middle">Settings</span>
                </a>
            </li>   --}}

            {{-- <li>
                <a class="dropdown-item" href="javascript:void(0);">
                    <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 bx bx-credit-card me-2 pe-1"></i>
                        <span class="flex-grow-1 align-middle">Billing</span>
                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                    </span>
                </a>
            </li> --}}
{{--
              <li>
                  <div class="dropdown-divider"></div>
              </li> --}}
            @endif

            <li>
                <a class="dropdown-item" href="{{ route('auth.logout') }}">
                    <i class='bx bx-power-off me-2'></i>
                    <span class="align-middle">{{ trans('app.logout') }}</span>
                </a>
            </li>
        </ul>
    </li>
    <!--/ User -->
    </ul>
</div>

@if (!isset($navbarDetached))
    </div>
@endif
</nav>
<!-- / Navbar -->
