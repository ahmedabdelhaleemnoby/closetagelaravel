<!-- Feature Start -->
<div class="container-fluid bg-light bg-icon my-5 py-6" id="feature">
    <div class="container">
        @foreach($mainFeatures as $mainFeature)
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">{{$mainFeature->title}}</h1>
            <p>{{$mainFeature->description}}</p>
        </div>
        @endforeach
        <div class="row g-4">
            @foreach($features as $feature)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="{{$feature->dir}}/{{$feature->icon}}" alt="">
                    <h4 class="mb-3">{{$feature->title}}</h4>
                    <p class="mb-4">{{$feature->description}}</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Feature End -->
