<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('put') || $this->isMethod('patch')
            ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return [
            'tagline' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'status' => 'required|boolean',
            'image' => $imageRule,
        ];
    }
}
