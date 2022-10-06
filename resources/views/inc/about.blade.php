<!-- About Start -->
<div class="container-xxl py-5" id="about">
    <div class="container">
        @foreach($abouts as $about)
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="{{$about->dir.$about->image}}">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="display-5 mb-4">{{$about->title}}</h1>
                <p class="mb-4">{{$about->description}}</p>
                <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">Read More</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- About End -->
