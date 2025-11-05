<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('shop', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('slug', '!=', $slug)->inRandomOrder()->take(8)->get();
        return view('details', compact('product', 'products'));
    }
}
