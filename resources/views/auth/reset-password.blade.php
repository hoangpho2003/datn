@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>

        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active">
                        Reset Password
                    </a>
                </li>
            </ul>

            <div class="tab-content pt-2">
                <div class="tab-pane fade show active">
                    <div class="register-form">

                        <p class="text-muted mb-4">
                            Enter your new password below to reset your account password.
                        </p>

                        <form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm" novalidate>
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control form-control_gray @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $request->email) }}" required autofocus>
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
                                <input id="password" type="password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    name="password" required>
                                <label for="password">New Password *</label>
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
                                <label for="password_confirmation">Confirm New Password *</label>
                                <div class="invalid-feedback">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @else
                                        Passwords do not match.
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">
                                Reset Password
                            </button>

                            <div class="text-center mt-4">
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    ← Back to Login
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('resetPasswordForm');

            const validators = {
                email: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),
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
