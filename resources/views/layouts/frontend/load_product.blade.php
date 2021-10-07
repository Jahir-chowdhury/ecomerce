 
    <div class="products mb-2" id="loadData">
      <div class="row justify-content-center">
        @foreach($load_products as $product)
        @if($product->get_category->status == 1)
        <div class="col-4 col-md-4 col-lg-4 col-xl-2">
          <div class="product prod_hover product-7 text-center">
            @foreach($product->get_product_avatars as $avtr)
            <figure class="product-media">
              <a href="{{route('quick',$product->slug)}}">
                <img  src="/images/{{$avtr->front}}" alt="Product image" class="product-image img_mbl"/>
              </a>

              <div class="product-action-vertical">
                <a onclick="addWishList({{$product}})" href="#" class="btn-product-icon btn-wishlist btn-expandable"
                  ><span>add to wishlist</span></a
                >
              </div>
              <div class="product-action">
                <a onclick="addToCart({{$product}})" href="#" class="btn-product btn-cart"
                  ><span>add to cart</span></a
                >
              </div>
            </figure>
            @endforeach
            <div class="product-body">
              <!-- End .product-cat -->
              <h3 class="product-title">
                <a href="product.html">{{ optional($product)->product_name }}</a>
              </h3>
              <div class="product-price">
                @foreach ($product->get_attribute->unique('product_id') as $attr)
                <span class="new-price">{{$attr->sale_price}} TK</span>
                <span class="old-price"><del>{{$attr->promo_price}} TK</del></span>
                    
                @endforeach
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>