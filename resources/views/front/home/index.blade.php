@extends('front.layouts.layout')
@section('title', "Page d'accueil") 
@section('content')

        <!-- Start hero start -->
            @include('front.layouts.hero_start')
        <!-- End hero start -->
        <!-- Feature Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item bg-light rounded text-center p-4">
                            {{-- <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i> --}}
                            <img src="{{ asset('assets/front/img/brain.png')}}" alt="brain" style="width: 50px; height: 50px;">
                            <h5 class="mb-3">Esprit = créativité et innovation</h5>
                            <p class="m-0">Les esprits créatifs et innovants réalisent des exploits. Source d'idées nouvelles, moteur de progrès et de changement, ils impactent le monde pour les générations à venir.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item bg-light rounded text-center p-4">
                            {{-- <i class="fa fa-3x fa-search text-primary mb-4"></i> --}}
                            <img src="{{ asset('assets/front/img/hard-work.png')}}" alt="hard-work" style="width: 50px; height: 50px;">
                            <h5 class="mb-3">Never give up</h5>
                            <p class="m-0">"Never give up" est notre boussole : chaque épreuve devient une occasion de grandir, de s'élever et de réaliser l'impossible.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item bg-light rounded text-center p-4">
                            {{-- <i class="fa fa-3x fa-laptop-code text-primary mb-4"></i> --}}
                            <img src="{{ asset('assets/front/img/business-people.png')}}" alt="business-people" style="width: 50px; height: 50px;">

                            <h5 class="mb-3">Plus d'esprits = Plus de créativité</h5>
                            <p class="m-0">Sous "Plus d'esprits = plus de créativité", la diversité des idées crée des solutions novatrices et des succès exceptionnels.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End -->


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
<div class="container-xxl bg-primary fact py-5 wow fadeInUp d-flex justify-content-center align-items-center" data-wow-delay="0.1s">
    <div>
        <h3 class="text-secondary text-center">Indicateurs sur l'incubateur d'entreprises numériques</h3>
        <div class="container py-5 px-lg-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <img src="{{ asset('assets/front/img/idea.png')}}" alt="idea" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Les idées</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <img src="{{ asset('assets/front/img/start-up.png')}}" alt="start-up" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Les projets innovants</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <img src="{{ asset('assets/front/img/police-station.png')}}" alt="police-station" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Institutions émergentes</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <img src="{{ asset('assets/front/img/startup.png')}}" alt="startup" style="width: 50px; height: 50px;">
                    <h1 class="text-white mb-2" data-toggle="counter-up">1234</h1>
                    <p class="text-white mb-0">Incubateurs d'entreprises</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->



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


        {{-- <!-- Newsletter Start -->
        <div class="container-xxl bg-primary newsletter py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <p class="section-title text-white justify-content-center"><span></span>Newsletter<span></span></p>
                        <h1 class="text-center text-white mb-4">Stay Always In Touch</h1>
                        <p class="text-white mb-4">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit sed stet lorem sit clita duo justo</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Enter Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter End --> --}}

       


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
@endsection 