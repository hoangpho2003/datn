<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $slides = Slide::where('status', 1)
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        $categories = Category::orderBy('name')->get();

        $sproducts = Product::whereNotNull('sale_price')
            ->where('sale_price', '<>', '')
            ->inRandomOrder()
            ->take(8)
            ->get();

        $fproducts = Product::where('featured', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $bproducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(10)
            ->get();

        if ($request->ajax()) {
            return view('partials.featured-products', compact('fproducts'))->render();
        }

        return view('index', compact(
            'slides',
            'categories',
            'sproducts',
            'fproducts',
            'bproducts'
        ));
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function termConditions()
    {
        return view('terms-conditions');
    }
}