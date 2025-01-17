@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title-dashboard'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>



@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="ps-lg-1-6 ps-xl-5">
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">{{trans('project.label.name')}}</h2>
                    </div>
                    <br>
                   <h1 class="">{{$project->name}}</h1>
                </div>
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">{{trans('project.label.description')}}</h2>
                    </div>
                    <br>
                    <p>{{$project->description}}</p>
                </div>

                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{ trans('project.label.project_images')}}</h2>
                    </div>
                    <br>
                    <div class="row">
                        @foreach($projectImages as $image)
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                <img src="{{ asset('storage/images/'.$image->image) }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $image->description }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{trans('project.label.bmc_project')}}</h2>
                    </div>
                    <a href="{{ asset('storage/bmc/'.$project->bmc) }}" target="_blank">{{ trans('project.label.download_bmc')}}</a>
                </div>
                <br>
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{trans('project.label.project_video')}}</h2>
                    </div>
                    <a href="{{ asset('storage/videos/'.$project->video) }}" target="_blank">{{ trans('project.label.download_video')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
