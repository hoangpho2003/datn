@foreach ($fproducts as $fproduct)
<div class="col-6 col-md-4 col-lg-3">
    <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
        <div class="pc__img-wrapper">
            <a href="{{ route('shop.show', $fproduct->slug) }}">
                <img loading="lazy"
                     src="{{ asset('uploads/products/' . $fproduct->image) }}"
                     width="330" height="400"
                     alt="{{ $fproduct->name }}"
                     class="pc__img">
            </a>
        </div>

        <div class="pc__info position-relative">
            <h6 class="pc__title">
                <a href="{{ route('shop.show', $fproduct->slug) }}">
                    {{ $fproduct->name }}
                </a>
            </h6>

            <div class="product-card__price d-flex align-items-center">
                <span class="money price text-secondary">
                    @if ($fproduct->sale_price)
                        <s>${{ $fproduct->price }}</s> ${{ $fproduct->sale_price }}
                    @else
                        ${{ $fproduct->price }}
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
@endforeach
