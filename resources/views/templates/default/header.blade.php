  <header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-phone"></i> {{ sc_store('phone') }}</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> {{ sc_store('email') }}</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="btn-group pull-right">
              <div class="btn-group locale">
               
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div><!--/header_top-->
    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="{{ route('home') }}"><img style="width: 150px;" src="{{ asset(sc_store('logo')) }}" alt="" /></a>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
                @php
                $cartsCount = \Cart::count();
                @endphp
                <li><a href="{{ route('wishlist') }}"><span  class="cart-qty  sc-wishlist" id="shopping-wishlist">{{ Cart::instance('wishlist')->count() }}</span><i class="fa fa-star"></i> {{ trans('front.wishlist') }}</a></li>
                <li><a href="{{ route('compare') }}"><span  class="cart-qty sc-compare" id="shopping-compare">{{ Cart::instance('compare')->count() }}</span><i class="fa fa-crosshairs"></i> {{ trans('front.compare') }}</a></li>
                <li><a href="{{ route('cart') }}"><span class="cart-qty sc-cart" id="shopping-cart">{{ $cartsCount }}</span><i class="fa fa-shopping-cart"></i> {{ trans('front.cart_title') }}</a>
                </li>
                @guest
                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ trans('front.login') }}</a></li>
                @else
                <li><a href="{{ route('member.index') }}"><i class="fa fa-user"></i> {{ trans('front.account') }}</a></li>
                <li><a href="{{ route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ trans('front.logout') }}</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                @endguest

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="{{ route('home') }}" class="active">{{ trans('front.home') }}</a></li>
                <li class="dropdown"><a href="#">{{ trans('front.shop') }}<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                        <li><a href="{{ route('product.all') }}">{{ trans('front.all_product') }}</a></li>
                        <li><a href="{{ route('compare') }}">{{ trans('front.compare') }}</a></li>
                        <li><a href="{{ route('cart') }}">{{ trans('front.cart_title') }}</a></li>
                        <li><a href="{{ route('categories') }}">{{ trans('front.categories') }}</a></li>
                        <li><a href="{{ route('brands') }}">{{ trans('front.brands') }}</a></li>
                        <li><a href="{{ route('vendors') }}">{{ trans('front.vendors') }}</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('news') }}">{{ trans('front.blog') }}</a></li>

                @if (!empty(sc_config('Content')))
                <li class="dropdown"><a href="#">{{ trans('front.cms_category') }}<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                      @php
                        $nameSpace = sc_get_module_namespace('Cms','Content').'\Models\CmsCategory';
                        $cmsCategories = (new $nameSpace)->where('status', 1)->get();
                      @endphp
                      @foreach ($cmsCategories as $cmsCategory)
                        <li><a href="{{ $cmsCategory->getUrl() }}">{{ sc_language_render($cmsCategory->title) }}</a></li>
                      @endforeach
                    </ul>
                </li>
                @endif

                  @if (!empty($layoutsUrl['menu']))
                    @foreach ($layoutsUrl['menu'] as $url)
                      <li><a {{ ($url->target =='_blank')?'target=_blank':''  }} href="{{ sc_url_render($url->url) }}">{{ sc_language_render($url->name) }}</a></li>
                    @endforeach
                  @endif
              </ul>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="search_box pull-right">
              <form id="searchbox" method="get" action="{{ route('search') }}" >
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="{{ trans('front.search_form.keyword') }}..." name="keyword">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
  </header><!--/header-->
