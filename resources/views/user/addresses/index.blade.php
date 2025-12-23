@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title mb-4">My Addresses</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Saved Addresses</h5>
                        <a href="{{ route('user.address.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Add New Address
                        </a>
                    </div>
                    @if ($addresses->isEmpty())
                        <div class="alert alert-info">
                            You haven't added any address yet.
                        </div>
                    @endif
                    <div class="row g-4">
                        @foreach ($addresses as $address)
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0">{{ $address->name }}</h6>
                                            @if ($address->isdefault)
                                                <span class="badge bg-success">Default</span>
                                            @endif
                                        </div>
                                        <p class="mb-1">
                                            <i class="fa-solid fa-phone me-2"></i>
                                            {{ $address->phone }}
                                        </p>
                                        <p class="mb-1">
                                            <i class="fa-solid fa-location-dot me-2"></i>
                                            {{ $address->address }},
                                            {{ $address->locality }},
                                            {{ $address->city }},
                                            {{ $address->state }},
                                            {{ $address->country }}
                                        </p>
                                        @if ($address->landmark)
                                            <p class="mb-1 text-muted">
                                                Landmark: {{ $address->landmark }}
                                            </p>
                                        @endif
                                        <p class="mb-1 text-muted">
                                            ZIP: {{ $address->zip }} | Type: {{ ucfirst($address->type) }}
                                        </p>
                                        <div class="d-flex gap-2 mt-3">
                                            <a href="{{ route('user.address.edit', $address) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa-solid fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('user.address.delete', $address) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
