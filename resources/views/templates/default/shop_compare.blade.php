@extends($templatePath.'.shop_layout')

@section('main')
<section >
<div class="container">
    <div class="row">
        <h2 class="title text-center">{{ $title }}</h2>
        @if (count($compare) ==0)
            <div class="col-md-12 text-danger">
               Not found!
            </div>
        @else
<div class="table-responsive">
<table class="table box table-bordered">
    <tbody>
   <tr>
    @php
        $n = 0;
    @endphp
    @foreach($compare as $key => $item)
        @php
            $n++;
            $product = App\Models\ShopProduct::find($item->id);
        @endphp
       <td align="center">
           {{ $product->name }}({{ $product->sku }})
           <hr>
            <a href="{{ $product->getUrl() }}"><img width="100" src="{{asset($product->getImage())}}" alt=""></a>
            <hr>
            {!! $product->showPrice() !!}
            <hr>
            {!! $product->description !!}
            <hr>
            <a onClick="return confirm('Confirm')" title="Remove Item" alt="Remove Item" class="cart_quantity_delete" href="{{route("compare.remove",['id'=>$item->rowId])}}"><i class="fa fa-times"></i></a>
       </td>
       @if ($n % 4 == 0)
      </tr>
       @endif
    @endforeach
</tr>
    </tbody>
  </table>
  </div>
        @endif
        </div>
    </div>
</section>
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
