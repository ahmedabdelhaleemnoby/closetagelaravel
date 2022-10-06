<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Feature;
use App\Models\MainFeature;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Slider;

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
        return view('index', compact('sliders', 'abouts', 'mainFeatures', 'features', 'categories', 'products'));
    }
}
