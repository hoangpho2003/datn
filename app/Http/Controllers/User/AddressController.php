<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()
            ->addresses()
            ->orderByDesc('isdefault')
            ->latest()
            ->get();

        return view('user.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('user.addresses.create', [
            'address' => new Address(),
            'isEdit' => false
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'locality' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'zip' => 'required|string|max:20',
            'type' => 'required|in:home,office',
            'isdefault' => 'nullable',
        ]);

        if ($request->has('isdefault')) {
            auth()->user()->addresses()->update(['isdefault' => false]);
            $data['isdefault'] = true;
        }

        auth()->user()->addresses()->create($data);

        return redirect()->route('user.addresses')
            ->with('success', 'Address added successfully.');
    }

    public function edit(Address $address)
    {
        abort_if($address->user_id !== auth()->id(), 403);

        return view('user.addresses.edit', [
            'address' => $address,
            'isEdit' => true
        ]);
    }

    public function update(Request $request, Address $address)
    {
        abort_if($address->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'locality' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'zip' => 'required|string|max:20',
            'type' => 'required|in:home,office',
            'isdefault' => 'nullable',
        ]);

        if ($request->has('isdefault')) {
            auth()->user()->addresses()->update(['isdefault' => false]);
            $data['isdefault'] = true;
        } else {
            $data['isdefault'] = false;
        }

        $address->update($data);

        return redirect()->route('user.addresses')
            ->with('success', 'Address updated successfully.');
    }
}