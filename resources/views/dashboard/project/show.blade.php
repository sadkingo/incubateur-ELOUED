@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', trans('student.title-dashboard'))

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

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

   .project-description.ar {
    text-align: right;
    direction: rtl;
    font-family: 'Tajawal', sans-serif; /* اختر خط مناسب للغة العربية */
    }

    .project-description.en {
        text-align: left;
        direction: ltr;
        font-family: 'Arial', sans-serif; /* اختر خط مناسب للغة الإنجليزية */
    }

    .project-description.fr {
        text-align: left;
        direction: ltr;
        font-family: 'Arial', sans-serif; /* اختر خط مناسب للغة الفرنسية */
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
                                @if($project->type_project == null) {{trans('auth/project.type_null')}}
                                @elseif($project->type_project === 'commercial') {{trans('auth/project.project_commercial')}}
                                @elseif($project->type_project === 'industrial') {{trans('auth/project.project_industrial')}}
                                @elseif($project->type_project === 'agricultural') {{trans('auth/project.project_agricultural')}}
                                @else {{trans('auth/project.project_service')}}
                                @endif
                        </span>
                        </h2>
                    </div>
                    <br>
                </div>

                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">
                            {{ trans('project.label.cassification_project') }}:<span class="mb-0 text-black">
                                @if($project->project_classification == null) {{trans('auth/project.classification_null')}}
                                @elseif($project->project_classification  === 1) {{trans('project.mini_project')}}
                                @elseif($project->project_classification  === 2) {{trans('project.start_up')}}
                                @elseif($project->project_classificationt === 3) {{trans('project.patent')}}
                                @elseif($project->project_classification === 4)  {{trans('project.patent start up')}}
                                @endif
                        </span>
                        </h2>
                    </div>
                    <br>
                </div>


                <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{ trans('project.label.project_images') }}</h2>
                    </div>
                    <br>
                    <div class="row">
                        @foreach($projectImages as $image)
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                <a href="{{ asset('storage/public/projects/images/'.$image->image) }}" data-lightbox="project-images" data-title="{{ $image->name }}">
                                    <img src="{{ asset('storage/public/projects/images/'.$image->image) }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $image->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($project->bmc != null)
                    @if( $project->bmc_status == 2)
                        <div class="wow fadeIn">
                            <div class="text-start mb-1-6 wow fadeIn">
                                <h2 class="mb-0 text-primary">{{trans('project.label.bmc_project')}}</h2>
                            </div>
                            <a href="{{ asset('storage/public/projects/bmc/'.$project->bmc) }}" class="text-black" target="_blank">{{ trans('project.label.download_bmc')}}</a>
                        </div>
                        <br>
                    @else
                        <div class="wow fadeIn">
                            <div class="text-start mb-1-6 wow fadeIn">
                                <h2 class="mb-0 text-primary">{{trans('project.label.bmc_project')}}</h2>
                            </div>
                            <span class="text-warning">{{ trans('project.status_project.studying_bmc') }}</span>
                            <a href="{{ url('dashboard/project/bmc-studing/'.$project->id)}}">{{trans('project.edit_status_bmc')}} </a>
                        </div>
                        <br>
                    @endif
                @endif
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">{{trans('project.label.project_video')}}</h2>
                    </div>
                    <br>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4 ">
                        <a href="$project->video }}" class="text-black" target="_blank">{{ trans('project.label.download_video')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var descriptionElement = document.querySelector('.project-description');
        var descriptionText = descriptionElement.innerText || descriptionElement.textContent;

        // Regular expressions to detect Arabic, English, and French
        var arabicPattern = /[\u0600-\u06FF\u0750-\u077F]/;
        var englishPattern = /[A-Za-z]/;
        var frenchPattern = /[A-Za-zàâäéèêëîïôöùûüÿçœæ]/;

        if (arabicPattern.test(descriptionText)) {
            descriptionElement.classList.add('ar');
        } else if (englishPattern.test(descriptionText)) {
            descriptionElement.classList.add('en');
        } else if (frenchPattern.test(descriptionText)) {
            descriptionElement.classList.add('fr');
        } else {
            // Default to English if no pattern matches
            descriptionElement.classList.add('en');
        }
    });
</script>
@endsection
