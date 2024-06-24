@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

{{-- @section('title', trans('student.title-dashboard')) --}}

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>



@endsection

@section('content')
<style>
    .project-description {
       max-width: 800px; 
       font-size: 16px; 
       line-height: 1.6; 
       color: #333; 
   }

   .project-description p {
       margin-bottom: 1.5em; 
   }

   .project-description h2 {
       font-size: 2em; 
       margin-bottom: 0.5em; 
       color: #007bff; 
   }


</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="ps-lg-1-6 ps-xl-5">
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">{{trans('project.label.name')}}</h2>
                    </div>
                    <br>
                   <h1 class="text-black">{{$project->name}}</h1>
                </div>
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">{{ trans('project.label.description') }}</h2>
                    </div>
                    <br>
                    <div class="project-description text-black">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">
                            {{ trans('project.label.type_project') }}:<span class="mb-0 text-black">
                                @if($project->type_project === 'commercial') {{trans('auth/project.project_commercial')}}
                                @elseif($project->type_project === 'industrial') {{trans('auth/project.project_industrial')}}
                                @elseif($project->type_project === 'agricultural') {{trans('auth/project.project_agricultural')}}
                                @else {{trans('project_service')}}
                                @endif
                        </span> 
                        </h2>
                    </div>
                    <br>
                    
                </div>
                
                
                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{ trans('project.label.project_images')}}</h2>
                    </div>
                    <br>
                    <div class="row">
                        @foreach($projectImages as $image)
                           
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                <img src="{{ asset('storage/public/projects/images/'.$image->image) }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $image->name }}">
                            </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{trans('project.label.bmc_project')}}</h2>
                    </div>
                    <a href="{{ asset('storage/public/projects/bmc/'.$project->bmc) }}" class="text-black" target="_blank">{{ trans('project.label.download_bmc')}}</a>
                </div>
                <br>
                
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{trans('project.label.project_video')}}</h2>
                    </div>
                    <br>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4 ">
                        <video controls class="w-100 shadow-1-strong rounded mb-4">
                            <source src="{{ asset('storage/public/projects/videos/'.$project->video) }}" type="video/mp4">
                            <source src="{{ asset('storage/public/projects/videos/'.$project->video) }}" type="video/ogg">
                                {{ trans('auth/project.video_not_supported') }}
                        </video>
                    </div>    
                    {{-- <a href="{{ asset('storage/public/projects/videos/'.$project->video) }}" class="text-black" target="_blank">{{ trans('project.label.download_video')}}</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection