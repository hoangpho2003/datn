<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Str;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.brands.create', compact('categories'));
    }

    public function store(BrandRequest $request)
    {
        $data = $request->validated();

        try {
            $brand = new Brand();
            $brand->name = $data['name'];
            $brand->slug = Str::slug($data['slug']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_extension = $image->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extension;
                $this->GenerateBrandThumbailsImage($image, $file_name);
                $brand->image = $file_name;
            }
            $brand->save();

            if ($request->filled('category_id')) {
                $brand->categories()->attach($request->category_id);
            }

            return redirect()->route('admin.brands')->with('success', 'Brand created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create brand!');
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $categories = Category::all();
        return view('admin.brands.edit', compact('brand', 'categories'));
    }

    public function update(BrandRequest $request)
    {
        $data = $request->validated();

        try {
            $brand = Brand::find($request->id);
            $brand->name = $data['name'];
            $brand->slug = Str::slug($data['slug']);
            if ($request->hasFile('image')) {
                $oldImagePath = public_path('uploads/brands/' . $brand->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $image = $request->file('image');
                $file_extension = $image->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extension;
                $this->GenerateBrandThumbailsImage($image, $file_name);
                $brand->image = $file_name;
            }

            $brand->save();

            $brand->categories()->sync($request->category_id);

            return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $brand = Brand::find($id);
            if ($brand) {
                $oldImagePath = public_path('uploads/brands/' . $brand->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $brand->delete();
                return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully.');
            } else {
                return redirect()->route('admin.brands')->with('error', 'Brand not found.');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.brands')->with('error', 'Failed to delete brand!');
        }
    }

    public function GenerateBrandThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('/uploads/brands/');
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124)->save($destinationPath . '/' . $imageName);
    }
}
