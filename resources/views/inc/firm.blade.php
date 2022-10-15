<!-- Firm Visit Start -->
<div class="container-fluid bg-primary bg-icon mt-5 py-6">
    <div class="container">
        <div class="row g-5 align-items-center">
            @foreach($firms as $firm)
            <div class="col-md-7 wow fadeIn" data-wow-delay="0.1s">

                <h1 class="display-5 text-white mb-3">{{$firm->title}}</h1>
                <p class="text-white mb-0">{{$firm->description}}</p>
            </div>
            @endforeach
            <div class="col-md-5 text-md-end wow fadeIn" data-wow-delay="0.5s">
                <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="">Visit Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Firm Visit End -->
