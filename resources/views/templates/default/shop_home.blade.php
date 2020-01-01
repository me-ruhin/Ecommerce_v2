@extends($templatePath.'.shop_layout')

@section('center')
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ trans('front.features_items') }}</h2>
                @foreach ($products_new as  $key => $product_new)
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products product-box-{{ $product_new->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_new->getUrl() }}"><img src="{{ asset($product_new->getThumb()) }}" alt="{{ $product_new->name }}" /></a>
                            {!! $product_new->showPrice() !!}
                            <a href="{{ $product_new->getUrl() }}"><p>{{ $product_new->name }}</p></a>

                            @if ($product_new->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_new->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif

                          </div>
                      @if ($product_new->price != $product_new->getFinalPrice() && $product_new->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_new->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_new->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
               @endforeach
          </div><!--features_items-->

          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">{{ trans('front.products_hot') }}</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @foreach ($products_hot as  $key => $product_hot)
                @if ($key % 3 == 0)
                  <div class="item {{  ($key ==0)?'active':'' }}">
                @endif
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products   product-box-{{ $product_hot->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_hot->getUrl() }}"><img src="{{ asset($product_hot->getThumb()) }}" alt="{{ $product_hot->name }}" /></a>
                            {!! $product_hot->showPrice() !!}
                            <a href="{{ $product_hot->getUrl() }}"><p>{{ $product_hot->name }}</p></a>
                            @if ($product_hot->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_hot->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product_hot->price != $product_hot->getFinalPrice() && $product_hot->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif

                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                @if ($key % 3 == 2 || $key+1 == $products_hot->count())
                  </div>
                @endif
               @endforeach

              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
            </div>
          </div><!--/recommended_items-->

          <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#cate1" data-toggle="tab">{{ trans('front.products_build') }}</a></li>
                  <li><a href="#cate2" data-toggle="tab">{{ trans('front.products_group') }}</a></li>
              </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane fade active in" id="cate1" >
                  @foreach ($products_build as $product)
                    <div class="col-sm-3">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
              </div>
                <div class="tab-pane fade" id="cate2" >
                  @foreach ($products_group as $product)
                    <div class="col-sm-3">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
                </div>
          </div><!--/category-tab-->


@endsection



@push('styles')
@endpush

@push('scripts')

@endpush
