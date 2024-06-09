@extends('front.layouts.layout')
@section('title', "Service") 
@section('content')
<div class="container-xxl py-5 bg-primary hero-header">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated slideInDown">Service</h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{url('/')}}">Aaccueil</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Service</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
 <!-- Service Start -->
 <div id="service-section" class="container-xxl py-5">
    <div class="container py-5 px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            {{-- <p class="section-title text-secondary justify-content-center"><span></span>Programmes d'incubateurs d'entreprises numériques<span></span></p> --}}
            <h3 class="text-center mb-5 section-title text-secondary justify-content-center"><span></span>Programmes d'incubateurs d'entreprises numériques<span></span></h3>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item d-flex flex-column text-center rounded">
                    <div class=" flex-shrink-0">
                        {{-- <i class="fa fa-laptop-code fa-2x"></i> --}}
                        <img src="{{ asset('assets/front/img/camps.png')}}" alt="camps" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="mb-3">Camps d'idées.</h5>
                    <p class="m-0">Si vous avez une idée que vous souhaitez partager dans nos camps, vous pouvez consulter la liste des camps ouverts aux inscriptions ici, choisir le camp qui vous convient et présenter votre idée.</p>
                    <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item d-flex flex-column text-center rounded">
                    <div class=" flex-shrink-0">
                        
                        <img src="{{ asset('assets/front/img/ideas.png')}}" alt="ideas" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="mb-3">Le parcours des startups</h5>
                    <p class="m-0">A ce stade, vous devriez être capable de créer une startup pour concrétiser l’idée que vous proposez.</p>
                    <a class="btn btn-square" href="{{ url('/home')}}"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item d-flex flex-column text-center rounded">
                    <div class=" flex-shrink-0">
                        
                        <img src="{{ asset('assets/front/img/portfolio-5.jpg')}}" alt="stape_dev" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="mb-3">Étapes pour développer les entreprises émergentes.</h5>
                    <p class="m-0">Si vous avez une idée que vous souhaitez partager dans nos camps, vous pouvez ici consulter la liste des camps ouverts aux inscriptions, choisir le camp qui vous convient et présenter votre idée.</p>
                    <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item d-flex flex-column text-center rounded">
                    <div class=" flex-shrink-0">
                        <img src="{{ asset('assets/front/img/portfolio-2.jpg')}}" alt="incubater" style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="mb-3">Incubateurs d'entreprises.</h5>
                    <p class="m-0">Si vous disposez d'une pépinière d'entreprises privée ou publique et que vous souhaitez bénéficier des services et programmes de la pépinière d'entreprises numérique, vous pouvez choisir le bouquet d'offres adapté à vos besoins.</p>
                    <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item d-flex flex-column text-center rounded">
                    <div class=" flex-shrink-0">
                        {{-- <i class="fa fa-laptop-code fa-2x"></i> --}}
                        <img src="{{ asset('assets/front/img/portfolio-3.jpg')}}" alt="teamWorking  " style="width: 200px; height: 200px;">
                    </div>
                    <h5 class="mb-3">Espaces de coworking numériques.</h5>
                    <p class="m-0">
                        Si vous avez des idées que vous souhaitez partager avec d'autres innovateurs, ou si vous souhaitez former une équipe de travail diversifiée et spécialisée, ou si vous êtes un homme d'affaires ou une organisation émergente et souhaitez obtenir un service numérique, vous êtes au bon espace.
                    </p>
                    <a class="btn btn-square" href=""><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- Service End -->
@endsection