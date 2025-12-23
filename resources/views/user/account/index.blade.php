@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title mb-4">Account Details</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.account-nav')
            </div>

            <div class="col-lg-9">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('user.account.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3">Personal Information</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ old('name', $user->name) }}"
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="{{ old('email', $user->email) }}"
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text"
                                           name="phone"
                                           class="form-control"
                                           value="{{ old('phone', $user->phone ?? '') }}">
                                </div>
                            </div>

                            <h5 class="mb-3">Change Password</h5>
                            <small class="text-muted d-block mb-3">
                                Leave blank if you don’t want to change password
                            </small>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary">
                                    Update Account
                                </button>

                                <a href="{{ route('user.index') }}"
                                   class="btn btn-outline-secondary">
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
