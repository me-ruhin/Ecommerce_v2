@extends('admin.layout')

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $title_description??'' }}</h2>

                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ route('admin_cms_category.index') }}" class="btn  btn-flat btn-default"
                            title="List"><i class="fa fa-list"></i><span class="hidden-xs">
                                {{trans('admin.back_list')}}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"
                enctype="multipart/form-data">


                <div class="box-body">
                    <div class="fields-group">
                        @php
                        $descriptions = $category?$category->descriptions->keyBy('lang')->toArray():[];
                        @endphp

                        @foreach ($languages as $code => $language)

                        <div class="form-group">
                            <label class="col-sm-2  control-label"></label>
                            <div class="col-sm-8">
                                <b>{{ $language->name }}</b>
                                {!! sc_image_render($language->icon,'20px','20px') !!}
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.title') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__title"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Category.title') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__title" name="descriptions[{{ $code }}][title]"
                                        value="{{ old()? old('descriptions.'.$code.'.title'):($descriptions[$code]['title']??'') }}"
                                        class="form-control {{ $code.'__title' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.title'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.title') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.keyword') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__keyword"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Category.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__keyword"
                                        name="descriptions[{{ $code }}][keyword]"
                                        value="{{ old()?old('descriptions.'.$code.'.keyword'):($descriptions[$code]['keyword']??'') }}"
                                        class="form-control {{ $code.'__keyword' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.keyword'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.keyword') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.description') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__description"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Category.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__description"
                                        name="descriptions[{{ $code }}][description]"
                                        value="{{ old()?old('descriptions.'.$code.'.description'):($descriptions[$code]['description']??'') }}"
                                        class="form-control {{ $code.'__description' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.description'))
                                <span class="help-block">
                                    {{ $errors->first('descriptions.'.$code.'.description') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <hr>

                        <div class="form-group  {{ $errors->has('parent') ? ' has-error' : '' }}">
                            <label for="parent"
                                class="col-sm-2 asterisk control-label">{{ trans('Modules/Cms/Content::Category.admin.select_category') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control parent select2" style="width: 100%;" name="parent">
                                    <option value=""></option>
                                    @php
                                    $categories = [0=>'==ROOT==']+ $categories;
                                    @endphp
                                    @foreach ($categories as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('parent',$category['parent']??'') ==$k) ? 'selected':'' }}>{{ $v }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent'))
                                <span class="help-block">
                                    {{ $errors->first('parent') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group   {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Category.image') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image"
                                        value="{{ old('image',$category['image']??'') }}"
                                        class="form-control input-sm image" placeholder="" />
                                    <span class="input-group-btn">
                                        <a data-input="image" data-preview="preview_image" data-type="content"
                                            class="btn btn-sm btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                                        </a>
                                    </span>
                                </div>
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    {{ $errors->first('image') }}
                                </span>
                                @endif


                                <div id="preview_image" class="img_holder">
                                    @if (old('image',$category['image']??''))
                                    <img src="{{ asset(old('image',$category['image']??'')) }}">
                                    @endif
                                </div>

                            </div>
                        </div>


                        <div class="form-group   {{ $errors->has('alias') ? ' has-error' : '' }}">
                            <label for="alias"
                                class="col-sm-2  control-label">{!! trans('Modules/Cms/Content::Category.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="alias" name="alias" value="{!! old('alias',($category['alias']??'')) !!}"
                                        class="form-control alias" placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="help-block">
                                    {{ $errors->first('alias') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="sort"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Category.sort') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="sort" name="sort"
                                        value="{{ old()?old('sort'):$category['sort']??0 }}" class="form-control sort"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sort'))
                                <span class="help-block">
                                    {{ $errors->first('sort') }}
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group  ">
                            <label for="status"
                                class="col-sm-2  control-label">{{ trans('Modules/Cms/Content::Category.status') }}</label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="status"
                                    {{ old('status',(empty($category['status'])?0:1))?'checked':''}}>

                            </div>
                        </div>

                    </div>
                </div>



                <!-- /.box-body -->

                <div class="box-footer">
                    @csrf
                    <div class="col-md-2">
                    </div>

                    <div class="col-md-8">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary">{{ trans('admin.submit') }}</button>
                        </div>

                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
                        </div>
                    </div>
                </div>

                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>


@endsection

@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('admin/AdminLTE/bower_components/select2/dist/css/select2.min.css')}}">

{{-- switch --}}
<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-switch.min.css')}}">

@endpush

@push('scripts')
<!-- Select2 -->
<script src="{{ asset('admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

{{-- switch --}}
<script src="{{ asset('admin/plugin/bootstrap-switch.min.js')}}"></script>

<script type="text/javascript">
    $("[name='top'],[name='status']").bootstrapSwitch();
</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2()
});



</script>

@endpush