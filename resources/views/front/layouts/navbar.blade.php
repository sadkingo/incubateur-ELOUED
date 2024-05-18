<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0">
                <!-- Start navbar -->
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        @include('front.layouts.logo')
       
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ url('/home')}}" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="{{ url('/')}}" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Login</a>
        </div>
    </nav>
                <!-- End navbar -->
                
                <!-- Start hero start -->
                    @include('front.layouts.hero_start')
                <!-- End hero start -->    
</div>
<!-- Navbar & Hero End -->