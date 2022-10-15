<!-- Blog Start -->
<div class="container-xxl py-5" id="blog">
    <div class="container">
        @foreach($MainBlogs as $MainBlog)
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">{{$MainBlog->title}}</h1>
            <p>{{$MainBlog->description}}</p>
        </div>
        @endforeach
        <div class="row g-4">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid" src="{{$blog->dir.$blog->image}}" alt="">
                <div class="bg-light p-4">
                    <a class="d-block h5 lh-base mb-4" href="">{{$blog->title}}</a>
                    <div class="text-muted border-top pt-4">
                        <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                        <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>{{$blog->updated_at}}</small>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Blog End -->
