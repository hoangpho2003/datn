@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active">
                        Confirm Password
                    </a>
                </li>
            </ul>

            <div class="tab-content pt-2">
                <div class="tab-pane fade show active">
                    <div class="register-form">

                        <p class="text-muted mb-4">
                            This is a secure area of the application. Please confirm your password before continuing.
                        </p>

                        <form method="POST" action="{{ route('password.confirm') }}" id="confirmPasswordForm" novalidate>
                            @csrf


                            <div class="form-floating mb-4">
                                <input id="password" type="password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                <label for="password">Password *</label>
                                <div class="invalid-feedback">
                                    @error('password')
                                        {{ $message }}
                                    @else
                                        Please enter your password.
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">
                                Confirm
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
            const passwordInput = document.getElementById('password');

            passwordInput.addEventListener('input', () => {
                const isValid = passwordInput.value.length > 0;
                passwordInput.classList.remove('is-valid', 'is-invalid');
                passwordInput.classList.add(isValid ? 'is-valid' : 'is-invalid');
            });
        });
    </script>
@endsection
