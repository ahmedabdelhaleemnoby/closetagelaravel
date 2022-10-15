<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Category;
use App\Models\CustomerReview;
use App\Models\Feature;
use App\Models\Firm;
use App\Models\MainBlog;
use App\Models\MainFeature;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sliders = Slider::all();
        $abouts = About::all();
        $mainFeatures = MainFeature::all();
        $features = Feature::all();
        $categories = Category::all();
        $products = Product::all();
        $productz = Product::limit(4)->get();
        $firms = Firm::all();
        $customerReviews = CustomerReview::all();
        $reviews = Review::all();
        $blogs = Blog::all();
        $MainBlogs = MainBlog::all();
        return view('index', compact('sliders', 'abouts', 'mainFeatures', 'features', 'categories', 'products', 'productz', 'firms', 'customerReviews', 'reviews', 'blogs', 'MainBlogs'));
    }
}
