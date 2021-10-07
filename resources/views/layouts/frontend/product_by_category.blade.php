<div class="row col-md-12">
    @if($products)
    @foreach ($products as $pro)
    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
        <div class="product product-7 text-center">
        @foreach ($pro->get_product_avatars as $avtr)
        <figure class="product-media">
            <a href="{{route('quick',$pro->slug)}}">
            <img
                style="height: 203px !important"
                src="/images/{{$avtr->front}}"
                class="product-image"
            />
            </a>

            <div class="product-action-vertical">
            <a
                onclick="addWishList({{$pro}})"
                href="#"
                class="btn-product-icon btn-wishlist btn-expandable"
                ><span>add to wishlist</span></a
            >
            </div>

            <div class="product-action">
            <a onclick="addToCart({{$pro}})" href="#" class="btn-product btn-cart"
                ><span>add to cart</span></a
            >
            </div>
        </figure>
        @endforeach
        <div class="product-body">
            <h3 class="product-title">
            <a href="#">{{$pro->product_name}}</a>
            </h3>
            <div class="product-price">
                @foreach($pro->get_attribute->unique('product_id') as $key => $price)
                    <span class="new_price">{{$price->sale_price}}</span>
                    <span class="old_price" style="margin-left: 5px;
                    color: #ddd;"><del>{{$price->promo_price}}</del></span>
                @endforeach
            </div>
        </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
