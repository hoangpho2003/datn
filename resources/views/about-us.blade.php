@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="about-us container pb-5">
            <div class="mw-930 text-center mb-5">
                <h2 class="page-title">About Us</h2>
                <p class="text-muted">
                    We bring you modern fashion – stylish, comfortable, and confident.
                </p>
            </div>

            <div class="about-us__banner mb-5">
                <img loading="lazy" class="w-100 h-auto d-block rounded" src="{{ asset('assets/images/about/about-1.jpg') }}"
                    alt="Fashion Store Banner" />
            </div>

            <div class="mw-930 mx-auto mb-5">
                <h3 class="mb-4 text-uppercase">Our Story</h3>
                <p class="fs-6 fw-medium mb-4">
                    Founded with a passion for fashion, our store was created to help everyone
                    express their personality through clothing and footwear.
                </p>
                <p class="mb-4">
                    From everyday essentials to statement pieces, we carefully select high-quality
                    products that combine comfort, durability, and modern design. We believe fashion
                    is not just about appearance, but also confidence and lifestyle.
                </p>
            </div>

            <div class="mw-930 mx-auto mb-5">
                <div class="row text-center">
                    <div class="col-md-6 mb-4">
                        <div class="p-4 border rounded h-100">
                            <h5 class="mb-3 text-uppercase">Our Mission</h5>
                            <p class="mb-0">
                                To deliver stylish, high-quality clothing and footwear that empower
                                customers to feel confident every day.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="p-4 border rounded h-100">
                            <h5 class="mb-3 text-uppercase">Our Vision</h5>
                            <p class="mb-0">
                                To become a trusted fashion brand, loved for quality, design, and
                                excellent customer experience.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mw-930 mx-auto d-lg-flex align-items-center">
                <div class="image-wrapper col-lg-6 mb-4 mb-lg-0">
                    <img class="img-fluid rounded" loading="lazy" src="{{ asset('assets/images/about/about-1.jpg') }}"
                        alt="Our Company">
                </div>

                <div class="content-wrapper col-lg-6 ps-lg-5">
                    <h5 class="mb-3 text-uppercase">Why Choose Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">✔ Trendy & modern fashion styles</li>
                        <li class="mb-2">✔ High-quality materials</li>
                        <li class="mb-2">✔ Affordable prices</li>
                        <li class="mb-2">✔ Dedicated customer support</li>
                    </ul>
                    <p class="mt-3">
                        Whether you are looking for casual wear, street style, or elegant footwear,
                        we are here to accompany you on every journey.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
