@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
                        href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="true">
                        Register
                    </a>
                </li>
            </ul>
            <div class="tab-content pt-2">
                <div class="register-form">
                    <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="name" type="text" class="form-control form-control_gray" name="name"
                                value="{{ old('name') }}" required>
                            <label for="name">Name *</label>
                            <div class="invalid-feedback">Name is required.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control form-control_gray" name="email"
                                value="{{ old('email') }}" required>
                            <label for="email">Email address *</label>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="mobile" type="text" class="form-control form-control_gray" name="mobile"
                                value="{{ old('mobile') }}" required>
                            <label for="mobile">Mobile *</label>
                            <div class="invalid-feedback">Please enter a valid mobile (10 digits).</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control form-control_gray" name="password"
                                required>
                            <label for="password">Password *</label>
                            <div class="invalid-feedback">Password must be at least 8 characters.</div>
                        </div>

                        <div class="form-floating mb-4">
                            <input id="password_confirmation" type="password" class="form-control form-control_gray"
                                name="password_confirmation" required>
                            <label for="password_confirmation">Confirm Password *</label>
                            <div class="invalid-feedback">Passwords do not match.</div>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('registerForm');
            const validators = {
                name: val => val.trim().length > 0,
                email: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),
                mobile: val => /^0\d{9}$/.test(val),
                password: val => val.length >= 8,
                password_confirmation: val => val === document.getElementById('password').value,
            };

            Object.keys(validators).forEach(id => {
                const input = document.getElementById(id);
                if (!input) return;

                input.addEventListener('input', () => {
                    const isValid = validators[id](input.value);
                    input.classList.remove('is-valid', 'is-invalid');
                    input.classList.add(isValid ? 'is-valid' : 'is-invalid');
                });
            });
        });
    </script>
@endsection
