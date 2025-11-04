<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug' . ($this->id ? ',' . $this->id : ''),
            'description' => 'required|string',
            'short_description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'SKU' => 'required|string|max:100|unique:products,SKU' . ($this->id ? ',' . $this->id : ''),
            'stock_status' => 'required',
            'featured' => 'required|boolean',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'image' => $imageRule,
        ];
    }
}