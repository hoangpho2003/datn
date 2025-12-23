@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title mb-4">Add New Address</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.account-nav')
            </div>
            <div class="col-lg-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form action="{{ route('user.address.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Locality</label>
                                    <input type="text" name="locality" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Landmark</label>
                                    <input type="text" name="landmark" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">ZIP Code</label>
                                    <input type="text" name="zip" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Address Type</label>
                                    <select name="type" class="form-select">
                                        <option value="home">Home</option>
                                        <option value="office">Office</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="isdefault">
                                        <label class="form-check-label">
                                            Set as default address
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-4 d-flex gap-2">
                                <button class="btn btn-primary">
                                    Save Address
                                </button>
                                <a href="{{ route('user.addresses') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
