@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title mb-4">My Account</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>

                <div class="col-lg-9">
                    <div class="page-content my-account__dashboard">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=User&background=random" class="rounded-circle"
                                    width="60" height="60">
                                <div>
                                    <h5 class="mb-1">Hello, <strong>{{ $user->name }}</strong> 👋</h5>
                                    <small class="text-muted">Welcome back to your account</small>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Total Orders</h6>
                                        <h3 class="fw-bold text-primary">{{ $orders->total() }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Delivered Orders</h6>
                                        <h3 class="fw-bold text-primary">
                                            {{ $orders->where('status', 'delivered')->count() }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-1">Total Price</h6>
                                        <h3 class="fw-bold text-primary">
                                            ${{ number_format($orders->where('status', 'delivered')->sum('total'), 2) }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <a href="{{ route('user.orders') }}"
                                    class="card border-0 shadow-sm text-center p-4 h-100 text-decoration-none">
                                    <i class="fa-solid fa-bag-shopping fs-1 text-primary mb-2"></i>
                                    <h6 class="fw-bold">My Orders</h6>
                                    <small class="text-muted">View your order history</small>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#"
                                    class="card border-0 shadow-sm text-center p-4 h-100 text-decoration-none">
                                    <i class="fa-solid fa-location-dot fs-1 text-primary mb-2"></i>
                                    <h6 class="fw-bold">My Address</h6>
                                    <small class="text-muted">Manage shipping addresses</small>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#"
                                    class="card border-0 shadow-sm text-center p-4 h-100 text-decoration-none">
                                    <i class="fa-solid fa-user fs-1 text-primary mb-2"></i>
                                    <h6 class="fw-bold">Account Details</h6>
                                    <small class="text-muted">Edit your personal information</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection
