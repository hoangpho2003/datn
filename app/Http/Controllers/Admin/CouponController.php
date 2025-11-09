<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('expiry_date', 'desc')->paginate(12);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(CouponRequest $couponRequest)
    {
        $data = $couponRequest->validated();

        try {
            $coupon = new Coupon();
            $coupon->code = $data['code'];
            $coupon->type = $data['type'];
            $coupon->value = $data['value'];
            $coupon->cart_value = $data['cart_value'];
            $coupon->expiry_date = $data['expiry_date'];

            $coupon->save();
            return redirect()->route('admin.coupons')->with('success', 'Coupon has been added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create Coupon!');
        }
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(CouponRequest $request)
    {
        $data = $request->validated();

        try {
            $coupon = Coupon::find($request->id);
            $coupon->code = $data['code'];
            $coupon->type = $data['type'];
            $coupon->value = $data['value'];
            $coupon->cart_value = $data['cart_value'];
            $coupon->expiry_date = $data['expiry_date'];

            $coupon->save();

            return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $coupon = Coupon::find($id);

            $coupon->delete();

            return redirect()->route('admin.coupons')->with('success', 'Coupon deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.coupons')->with('error', 'Failed to delete coupon!');
        }
    }
}
