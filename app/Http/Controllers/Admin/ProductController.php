<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        try {
            $product = new product();
            $product->name = $data['name'];
            $product->slug = Str::slug($data['slug']);
            $product->short_description = $data['short_description'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->sale_price = $data['sale_price'];
            $product->SKU = $data['SKU'];
            $product->stock_status = $data['stock_status'];
            $product->featured = $data['featured'] ?? 0;
            $product->quantity = $data['quantity'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $current_timestamp = Carbon::now()->timestamp;

            $image_name = "";
            $image = $request->file('image');
            if ($image) {
                $image_name = $current_timestamp . '.' . $image->extension();
                $this->GenerateProductImage($image, $image_name);
                $product->image = $image_name;
            }

            $gallery_arr = array();
            $gallery_images = "";
            $counter = 1;

            if ($request->hasFile('images')) {
                $allowedfileExtensions = ['jpg', 'jpeg', 'png'];
                $files = $request->file('images');
                foreach ($files as $file) {
                    $gextension = $file->getClientOriginalExtension();
                    $gcheck = in_array($gextension, $allowedfileExtensions);
                    if ($gcheck) {
                        $gfileName = $current_timestamp . '-' . $counter . '.' . $gextension;
                        $this->GenerateProductThumbailsImage($file, $gfileName);
                        array_push($gallery_arr, $gfileName);
                        $counter++;
                    }
                }
                $this->GenerateProductThumbailsImage($image, $image_name);
                array_push($gallery_arr, $image_name);
                $gallery_images = implode(',', $gallery_arr);
            }
            $product->images = $gallery_images;

            $product->save();

            return redirect()->route('admin.products')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Failed to create product!');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request)
    {
        $data = $request->validated();

        try {
            $product = Product::find($request->id);
            $product->name = $data['name'];
            $product->slug = Str::slug($data['slug']);
            $product->short_description = $data['short_description'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->sale_price = $data['sale_price'];
            $product->SKU = $data['SKU'];
            $product->stock_status = $data['stock_status'];
            $product->featured = $data['featured'] ?? 0;
            $product->quantity = $data['quantity'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $current_timestamp = Carbon::now()->timestamp;

            if ($request->hasFile('image')) {
                $oldImagePath = public_path('uploads/products/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $oldThumbPath = public_path('uploads/products/thumbnails/' . $product->image);
                if (file_exists($oldThumbPath)) {
                    unlink($oldThumbPath);
                }

                $image = $request->file('image');
                $image_name = $current_timestamp . '.' . $image->extension();

                $this->GenerateProductImage($image, $image_name);
                $this->GenerateProductThumbailsImage($image, $image_name);

                $product->image = $image_name;
            }


            $gallery_arr = array();
            $gallery_images = "";
            $counter = 1;

            if ($request->hasFile('images')) {
                $currentImages = $product->images ? explode(',', $product->images) : [];
                $gallery_arr = $currentImages;

                $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $files = $request->file('images');

                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    if (in_array($extension, $allowedfileExtensions)) {
                        $gfileName = $current_timestamp . '-' . $counter . '.' . $extension;
                        $this->GenerateProductThumbailsImage($file, $gfileName);
                        $gallery_arr[] = $gfileName;
                        $counter++;
                    }
                }

                if ($request->filled('deleted_images')) {
                    $deletedImages = explode(',', $request->deleted_images);
                    foreach ($deletedImages as $delImg) {
                        $path = public_path('uploads/products/thumbnails/' . trim($delImg));
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                    $gallery_arr = array_diff($gallery_arr, $deletedImages);
                }

                $gallery_images = implode(',', $gallery_arr);
                $product->images = $gallery_images;
            }


            $product->save();

            return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Failed to update product!');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $oldImagePath = public_path('uploads/products/' . $product->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        foreach (explode(',', $product->images) as $img) {
            $thumbPath = public_path('uploads/products/thumbnails/' . trim($img));
            if (file_exists($thumbPath)) {
                unlink($thumbPath);
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    public function GenerateProductImage($image, $imageName)
    {
        $destinationPath = public_path('/uploads/products/');
        $img = Image::read($image->path());
        $img->cover(540, 689, "top");
        $img->resize(540, 689)->save($destinationPath . '/' . $imageName);
    }

    public function GenerateProductThumbailsImage($image, $imageName)
    {
        $destinationPathThumbnails = public_path('/uploads/products/thumbnails/');
        $img = Image::read($image->path());
        $img->cover(104, 104, "top");
        $img->resize(104, 104)->save($destinationPathThumbnails . '/' . $imageName);
    }
}
