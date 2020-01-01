@extends($templatePath.'.shop_layout')

@section('main')

<section >
    <div class="container">
        <div class="row">
            <h2 class="title text-center">{{ $title }}</h2>
            {!! sc_html_render($news_currently->content) !!}
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
