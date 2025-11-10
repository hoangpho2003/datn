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
                <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel"
                    aria-labelledby="register-tab">
                    <div class="register-form">
                        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                            @csrf
                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                    class="form-control form-control_gray @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required>
                                <label for="name">Name *</label>
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @else
                                        Name is required.
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control form-control_gray @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                <label for="email">Email address *</label>
                                <div class="invalid-feedback">
                                    @error('email')
                                        {{ $message }}
                                    @else
                                        Please enter a valid email.
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="mobile" type="text"
                                    class="form-control form-control_gray @error('mobile') is-invalid @enderror"
                                    name="mobile" value="{{ old('mobile') }}" required>
                                <label for="mobile">Mobile *</label>
                                <div class="invalid-feedback">
                                    @error('mobile')
                                        {{ $message }}
                                    @else
                                        Please enter a valid mobile (10 digits).
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    name="password" required>
                                <label for="password">Password *</label>
                                <div class="invalid-feedback">
                                    @error('password')
                                        {{ $message }}
                                    @else
                                        Password must be at least 8 characters.
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <input id="password_confirmation" type="password"
                                    class="form-control form-control_gray @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required>
                                <label for="password_confirmation">Confirm Password *</label>
                                <div class="invalid-feedback">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @else
                                        Passwords do not match.
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>
                        </form>
                    </div>
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
