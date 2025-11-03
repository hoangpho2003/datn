<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        try {
            $category = new Category();
            $category->name = $data['name'];
            $category->slug = Str::slug($data['slug']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_extension = $image->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extension;
                $this->GenerateCategoryThumbailsImage($image, $file_name);
                $category->image = $file_name;
            }
            $category->save();

            return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create category!');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request)
    {
        $data = $request->validated();

        try {
            $category = Category::find($request->id);
            $category->name = $data['name'];
            $category->slug = Str::slug($data['slug']);
            if ($request->hasFile('image')) {
                $oldImagePath = public_path('uploads/categories/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $image = $request->file('image');
                $file_extension = $image->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extension;
                $this->GenerateCategoryThumbailsImage($image, $file_name);
                $category->image = $file_name;
            }

            $category->save();

            return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                $oldImagePath = public_path('uploads/categories/' . $category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $category->delete();
                return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
            } else {
                return redirect()->route('admin.categories')->with('error', 'Category not found.');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.categories')->with('error', 'Failed to delete category!');
        }
    }

    public function GenerateCategoryThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('/uploads/categories/');
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $imageName);
    }
}
