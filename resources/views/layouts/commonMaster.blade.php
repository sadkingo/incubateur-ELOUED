<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free"
@if (Session::get('locale') == 'ar') dir="rtl" lang="ar" @endif>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') </title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  {{-- <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" /> --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.jpg') }}" />

  <script src="{{ asset('assets/vendor/js/jquery/jquery.min.js') }}?v={{ time() }}"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 <!-- SweetAlert CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

 <!-- SweetAlert JS -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- logo-print.jpg --}}
  <!-- Include Styles -->
  @include('layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>

<body>
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

  {{-- remove while creating package --}}
  {{-- <div class="buy-now">
    <a href="{{config('variables.productPage')}}" target="_blank" class="btn btn-danger btn-buy-now">Upgrade To Pro</a>
  </div> --}}
  {{-- remove while creating package end --}}

  <!-- Include Scripts -->
  @include('layouts/sections/scripts')

</body>

</html>
