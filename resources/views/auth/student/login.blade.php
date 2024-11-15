@extends('layouts/blankLayout')

@section('title', trans('auth/auth.login'))

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body" dir="rtl">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <img class="app-brand-logo" height="100px" src="{{ asset('assets/logo/logo.jpg') }}"
                                    alt="" srcset="">
                                {{-- <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">{{ trans('auth/auth.login') }}</h4>
                        @if (Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <form id="formAuthentication" class="mb-3" action="{{ route('auth.login.student') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label">{{ trans('auth/auth.code') }}</label>
                                <input type="number" class="form-control mb-1 @error('code') is-invalid @enderror"
                                    id="code" name="code" placeholder="2024ES00298" autofocus>
                                @error('code')
                                    <small class="text-danger d-block">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                              <label for="password" class="form-label">{{ trans('auth/auth.password') }}</label>
                              <input type="password" class="form-control mb-1 @error('password') is-invalid @enderror"
                                  id="password" name="password" autofocus>
                              @error('password')
                                  <small class="text-danger d-block">
                                      {{ $message }}
                                  </small>
                              @enderror
                          </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">{{ trans('auth/auth.loginSubmit') }}</button>
                            </div>
                        </form>

                        {{-- <p class="text-center">
                            <span>{{ trans('auth/auth.have_not_account') }}</span>
                            <a href="{{ route('auth.registerForm') }}">
                                <span>{{ trans('auth/auth.create_account') }}</span>
                            </a>
                        </p> --}}
                        <a class="btn btn-primary d-grid w-100" type="button" href="{{ route('auth.login') }}">{{ trans('auth/auth.back') }}</a>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    </div>
@endsection
