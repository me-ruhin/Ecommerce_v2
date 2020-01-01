  @php
    $productsSpecial = (new \App\Models\ShopProduct)->getProductsSpecial($limit = 1, $random = true)
  @endphp
  @if (!empty($productsSpecial))
              <div class="brands_products"><!--product special-->
                <h2>{{ trans('front.products_special') }}</h2>
                <div class="products-name">
                  <ul class="nav nav-pills nav-stacked">
                    @foreach ($productsSpecial as $key => $productSpecial)
                      <li>
                        <div class="product-image-wrapper product-single">
                          <div class="single-products product-box-{{ $key }}">
                              <div class="productinfo text-center">
                                <a href="{{ $productSpecial->getUrl() }}"><img src="{{ asset($productSpecial->getThumb()) }}" alt="{{ $productSpecial->name }}" /></a>
                                {!! $productSpecial->showPrice() !!}
                                <a href="{{ $productSpecial->getUrl() }}"><p>{{ $productSpecial->name }}</p></a>
                              </div>
                          @if ($productSpecial->price != $productSpecial->getFinalPrice())
                          <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                          @elseif($productSpecial->type == SC_PRODUCT_NEW)
                          <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                          @endif
                          </div>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div><!--/product special-->
  @endif
