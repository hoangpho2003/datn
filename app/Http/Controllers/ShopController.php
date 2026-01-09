<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\RecentlyViewedProduct;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size', 12);
        $order = $request->query('order', -1);

        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');

        $min_price = $request->query('min', 1);
        $max_price = $request->query('max', 500);

        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'desc';
                break;
            case 2:
                $o_column = 'created_at';
                $o_order = 'asc';
                break;
            case 3:
                $o_column = 'sale_price';
                $o_order = 'asc';
                break;
            case 4:
                $o_column = 'sale_price';
                $o_order = 'desc';
                break;
            default:
                $o_column = 'id';
                $o_order = 'desc';
        }

        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        $products = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')

            ->when($f_brands, function ($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands));
            })

            ->when($f_categories, function ($query) use ($f_categories) {
                $query->whereIn('category_id', explode(',', $f_categories));
            })

            ->whereNotNull('sale_price')
            ->whereBetween('sale_price', [$min_price, $max_price])

            ->orderBy($o_column, $o_order)
            ->paginate($size);

        return view('shop', compact(
            'products',
            'size',
            'order',
            'brands',
            'f_brands',
            'categories',
            'f_categories',
            'min_price',
            'max_price'
        ));
    }

    public function show($slug)
    {
        $product = Product::with(['reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        if (auth()->check()) {
            RecentlyViewedProduct::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                ],
                [
                    'updated_at' => now()
                ]
            );

            $ids = RecentlyViewedProduct::where('user_id', auth()->id())
                ->latest()
                ->pluck('id');

            if ($ids->count() > 10) {
                RecentlyViewedProduct::whereIn(
                    'id',
                    $ids->slice(10)
                )->delete();
            }
        }

        $products = Product::where('slug', '!=', $slug)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $avgRating = round($product->reviews->avg('rating'), 1);
        $reviewCount = $product->reviews->count();

        $canReview = false;
        $userReview = null;

        if (auth()->check()) {
            $canReview = auth()->user()
                ->orders()
                ->where('status', 'delivered')
                ->whereHas('orderItems', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })
                ->exists();

            $userReview = $product->reviews
                ->where('user_id', auth()->id())
                ->first();
        }

        $recentProducts = collect();

        if (auth()->check()) {
            $recentIds = RecentlyViewedProduct::where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->pluck('product_id');

            $recentProducts = Product::whereIn('id', $recentIds)
                ->orderByRaw("FIELD(id," . $recentIds->implode(',') . ")")
                ->get();
        }

        return view('details', compact(
            'product',
            'products',
            'avgRating',
            'reviewCount',
            'canReview',
            'userReview',
            'recentProducts'
        ));
    }

}
