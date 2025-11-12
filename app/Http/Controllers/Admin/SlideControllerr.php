<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Log;

class SlideControllerr extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('id', 'desc')->paginate(12);
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(SlideRequest $request)
    {
        $data = $request->validated();

        try {
            $slide = new Slide();
            $slide->tagline = $data['tagline'];
            $slide->title = $data['title'];
            $slide->subtitle = $data['subtitle'];
            $slide->link = $data['link'];
            $slide->status = $data['status'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_extension = $image->extension();
                $file_name = Carbon::now()->timestamp . '.' . $file_extension;
                $this->GenerateSlideImage($image, $file_name);
                $slide->image = $file_name;
            }

            $slide->save();

            return redirect()->route('admin.slides')->with('success', 'Success to create new Slide!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Failed to create new slide!');
        }
    }

    public function GenerateSlideImage($image, $imageName)
    {
        $destinationPath = public_path('/uploads/slides/');
        $img = Image::read($image->path());
        $img->cover(400, 690, "top");
        $img->resize(400, 690)->save($destinationPath . '/' . $imageName);
    }
}
