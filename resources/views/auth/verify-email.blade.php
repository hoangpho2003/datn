@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        <h3>Verify your email address</h3>

        <p>
            Thanks for signing up! Before getting started, please verify your email
            by clicking the link we sent to your email address.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success">
                A new verification link has been sent to your email.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-primary">
                Resend verification email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button class="btn btn-link text-danger">
                Logout
            </button>
        </form>
    </div>
@endsection
