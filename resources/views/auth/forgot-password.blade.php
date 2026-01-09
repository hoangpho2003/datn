@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>

        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active">
                        Forgot Password
                    </a>
                </li>
            </ul>

            <div class="tab-content pt-2">
                <div class="tab-pane fade show active">
                    <div class="register-form">

                        <!-- Description -->
                        <p class="text-muted mb-4">
                            Forgot your password? Enter your registered email, and we will send you a password reset link.
                        </p>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm" novalidate>
                            @csrf

                            <div class="form-floating mb-4">
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

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">
                                Send Password Reset Link
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
            const emailInput = document.getElementById('email');

            emailInput.addEventListener('input', () => {
                const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
                emailInput.classList.remove('is-valid', 'is-invalid');
                emailInput.classList.add(isValid ? 'is-valid' : 'is-invalid');
            });
        });
    </script>
@endsection
