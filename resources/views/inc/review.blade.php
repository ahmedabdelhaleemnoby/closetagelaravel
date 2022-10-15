<!-- Testimonial Start -->
<div class="container-fluid bg-light bg-icon py-6 mb-5" id="testimonial">
    <div class="container">
        @foreach($customerReviews as $customerReview)
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">{{$customerReview->title}}</h1>
            <p>{{$customerReview->description}}</p>
        </div>
        @endforeach
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach($reviews as $review)
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">{{$review->description}}</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="{{$review->dir.$review->image}}" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">{{$review->title}}</h5>
                        <span>{{$review->title_job}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="{{asset('img/testimonial-2.jpg')}}" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="{{asset('img/testimonial-3.jpg')}}" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-item position-relative bg-white p-5 mt-4">
                <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 rounded-circle" src="{{asset('img/testimonial-4.jpg')}}" alt="">
                    <div class="ms-3">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- Testimonial End -->
