@extends('front.layouts.layout')
@section('title', "About") 
@section('content')

    <div class="container-xxl py-5 bg-primary hero-header">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 py-5">
                <div class="col-12 text-center">
                    <h1 class="text-white animated slideInDown">À propos</h1>
                    <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{url('/')}}">Aaccueil</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">À propos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
     <!-- About Start -->
     <div id="about-section" class="container-xxl py-5">
        <div class="container py-5 px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary">À propos de nous<span></span></p>
                    <h1 class="mb-5">Experts dans le domaine depuis plus de 10 ans</h1>
                    <p class="mb-4">
                        L'Incubateur d'entreprises numériques est une initiative du ministère de 
                        l'Enseignement supérieur et de la Recherche scientifique en Algérie qui vise 
                        à responsabiliser les institutions et incubateurs d'entreprises émergents ainsi 
                        qu'à encourager l'innovation. Nous vous accompagnons pleinement, de l’incubation 
                        des idées jusqu’à l’entrée sur le marché, en bénéficiant d’une expertise locale 
                        et internationale. Notre incubateur joue un rôle efficace en contribuant à renforcer 
                        la culture de l’innovation en bâtissant une économie diversifiée basée sur 
                        la connaissance.
                    </p>
                    <div class="skill mb-4">
                        <h5 class="text-primary">-- Le taux d'acceptation des projets de l'Université d'El Oued --</h5>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Peojet innovants</p>
                            <p class="mb-2">85%</p>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="skill mb-4">
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Start Up</p>
                            <p class="mb-2">90%</p>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="skill mb-4">
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Breveté</p>
                            <p class="mb-2">95%</p>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    {{-- <a href="" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill mt-3">Read More</a> --}}
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets/front/img/img.jpg')}}">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
     <!-- Facts Start -->
     <div class="container-xxl bg-primary fact py-5 wow fadeInUp" data-wow-delay="0.1s">
        <h3 class="text-secondary text-center">Indicateurs sur l'incubateur d'entreprises numériques</h3>
        <div class="container py-5 px-lg-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    {{-- <i class="fa fa-certificate fa-3x text-secondary mb-3"></i> --}}
                    <img src="{{ asset('assets/front/img/idea.png')}}" alt="idea" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Les idées</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    {{-- <i class="fa fa-users-cog fa-3x text-secondary mb-3"></i> --}}
                    <img src="{{ asset('assets/front/img/start-up.png')}}" alt="start-up" style="width: 50px; height: 50px;">

                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Les projets innovants</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    {{-- <i class="fa fa-users fa-3x text-secondary mb-3"></i> --}}
                    <img src="{{ asset('assets/front/img/police-station.png')}}" alt="police-station" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Institutions émergentes</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    {{-- <i class="fa fa-check fa-3x text-secondary mb-3"></i> --}}
                    <img src="{{ asset('assets/front/img/startup.png')}}" alt="startup" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Incubateurs d'entreprises</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->

@endsection