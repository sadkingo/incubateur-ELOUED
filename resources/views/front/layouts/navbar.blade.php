<!-- Banner Start -->
<div class="banner" style="display: flex; justify-content: space-between; align-items: center; background-color: #4CAF50; padding: 20px;">
    <img src="{{ asset('assets/front/img/img/mesrs-logo2.png')}}" alt="Left Image" style="background-color: white; padding: 10px; border-radius: 50%; width: 100px; height: 100px; object-fit: cover; margin-right: auto;">
    <div class="grow flex flex-col text-center justify-center text-lg text-alabaster-50" style="flex-direction: column;">
        <h4 class="text-white">وزارة التعليم العالي والبحث العلمي</h4>
        <h4 class="text-white">ⴰⵖⵍⵉⴼ ⵏ ⵓ ⵙⵍⵎⴻⴷ ⵓⵏⵏⵉⴳ ⴷ ⵓⵏⴰⴷⵉ ⵓⵙⵙⵏⴰⵏ</h4>
        <h4 class="text-white" class="max-sm:basis-full">MINISTRY OF HIGHER EDUCATION AND SCIENTIFIC RESEARCH</h4>
    </div>
    <img src="{{ asset('assets/front/img/img/mesrs-logo2.png')}}" alt="Right Image" style="background-color: white; padding: 10px; border-radius: 50%; width: 100px; height: 100px; object-fit: cover; margin-left: auto;">
</div>
<!-- Banner End -->

<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0">
                <!-- Start navbar -->
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        @include('front.layouts.logo')
       
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ url('/')}}" class="nav-item nav-link active">Aaccueil</a>
                <a href="{{ url('/about')}}" class="nav-item nav-link">À propos</a>
                <a href="{{ url('/service')}}" class="nav-item nav-link">Service</a>
                <a href="{{ url('/')}}" class="nav-item nav-link">Contact</a>
            </div>
            <a href="{{ url('/login')}}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Se connecter</a>
        </div>
    </nav>
                <!-- End navbar -->
                
    
</div>
<!-- Navbar & Hero End -->