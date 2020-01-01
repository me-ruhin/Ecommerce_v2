@extends($templatePath.'.shop_layout')

@section('center')

<div class="features_items">
<h2 class="title text-center">{{ $title }}</h2>
@if (count($wishlist) ==0)
    <div class="col-md-12 text-danger">
        Not found products!
    </div>
@else
<div class="table-responsive">
<table class="table box table-bordered">
    <thead>
      <tr  style="background: #eaebec">
        <th style="width: 50px;">No.</th>
        <th style="width: 100px;">SKU</th>
        <th>Name</th>
        <th>Price</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
    @foreach($wishlist as $item)
        @php
            $n = (isset($n)?$n:0);
            $n++;
            $product = App\Models\ShopProduct::find($item->id);
        @endphp
    <tr class="row_cart">
        <td >{{ $n }}</td>
        <td>{{ $product->sku }}</td>
        <td>
            {{ $product->name }}<br>
            <a href="{{ $product->getUrl() }}"><img width="100" src="{{asset($product->getImage())}}" alt=""></a>
        </td>
        <td>{!! $product->showPrice() !!}</td>
        <td>
            <a onClick="return confirm('Confirm')" title="Remove Item" alt="Remove Item" class="cart_quantity_delete" href="{{ route('wishlist.remove',['id'=>$item->rowId]) }}"><i class="fa fa-times"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
  </table>
  </div>
@endif
            </div>

@endsection

@section('breadcrumb')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">{{ trans('front.home') }}</a></li>
          <li class="active">{{ $title }}</li>
        </ol>
      </div>
@endsection

@push('scripts')
</script>
@endpush
