@extends('admin.layout')

@section('main')
   <div class="row">
      <div class="col-md-12">
         <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description??'' }}</h2>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="{{ route('admin_block_content.index') }}" class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main"  enctype="multipart/form-data">


                    <div class="box-body">
                        <div class="fields-group">

                            <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-2  control-label">{{ trans('block_content.name') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="name" name="name" value="{!! old('name',$layout['name']??'') !!}" class="form-control" placeholder="" />
                                    </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group  {{ $errors->has('position') ? ' has-error' : '' }}">
                                <label for="position" class="col-sm-2  control-label">{{ trans('block_content.admin.select_position') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control position select2" style="width: 100%;" name="position" >
                                        <option value=""></option>
                                        @foreach ($layoutPosition as $k => $v)
                                            <option value="{{ $k }}" {{ (old('position',$layout['position']??'') ==$k) ? 'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('position'))
                                            <span class="help-block">
                                                {{ $errors->first('position') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group  {{ $errors->has('page') ? ' has-error' : '' }}">
                                <label for="page" class="col-sm-2  control-label">{{ trans('block_content.admin.select_page') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control page select2" multiple="multiple" style="width: 100%;" name="page[]" >
                                        <option value=""></option>
                                        @php
                                            $layoutPage = ['*'=>'All pages'] + $layoutPage;
                                            $arrPage = explode(',', $layout['page']??'');
                                        @endphp
                                        @foreach ($layoutPage as $k => $v)
                                            <option value="{{ $k }}" {{ in_array($k,old('page',$arrPage)) ? 'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('page'))
                                            <span class="help-block">
                                                {{ $errors->first('page') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group  {{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-sm-2  control-label">{{ trans('block_content.type') }}</label>
                                <div class="col-sm-8">
                            @if ($layout)
                                <label class="radio-inline"><input type="radio" name="type" value="{!! $layout['type'] !!}" checked>{{ $layoutType[$layout['type']]}}</label>
                            @else
                                @foreach ( $layoutType as $key => $type)
                                    <label class="radio-inline"><input type="radio" name="type" value="{!! $key !!}"  {{ (old('type',$layout['type']??'') == $key)?'checked':'' }}>{{ $type }}</label>
                                @endforeach
                            @endif
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                {{ $errors->first('type') }}
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group  {{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text" class="col-sm-2  control-label">{{ trans('block_content.text') }}</label>
                                <div class="col-sm-8">
                                    @php
                                        $dataType = old('type',$layout['type']??'')
                                    @endphp
                                    @if ($dataType =='html')
                                        <textarea name="text" class="form-control text" rows="5" placeholder="Layout text">
                                            {{ old('text',$layout['text']??'') }}
                                        </textarea>
                                    <span class="help-block"><i class="fa fa-info-circle"></i> {{ trans('block_content.admin.helper_html') }}</span>
                                    @elseif ($dataType =='view')
                                        <select name="text" class="form-control text">
                                            @foreach ($listViewBlock as $view)
                                                <option value="{!! $view !!}" {{ (old('text',$layout['text']??'') == $view)?'selected':'' }} >{{ $view }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"><i class="fa fa-info-circle"></i> {{ trans('block_content.admin.helper_view') }}</span>
                                    @elseif ($dataType =='module')
                                        <select name="text" class="form-control text">
                                            @foreach ($listModuleBlock as $key => $module)
                                                <option value="{!! $module !!}" {{ (old('text',$layout['text']??'') == $module)?'selected':'' }} >{{ $module }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"><i class="fa fa-info-circle"></i> {{ trans('block_content.admin.helper_module') }}</span>
                                    @else
                                        <textarea name="text" class="form-control text" rows="5" placeholder="Layout text">
                                            {!! old('text',$layout['text']??'') !!}
                                        </textarea>
                                    @endif


                                    @if ($errors->has('text'))
                                        <span class="help-block">
                                            {{ $errors->first('text') }}
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                                <label for="sort" class="col-sm-2  control-label">{{ trans('block_content.sort') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="number" style="width: 100px;"  id="sort" name="sort" value="{!! old()?old('sort'):$layout['sort']??0 !!}" class="form-control sort" placeholder="" />
                                    </div>
                                        @if ($errors->has('sort'))
                                            <span class="help-block">
                                                {{ $errors->first('sort') }}
                                            </span>
                                        @endif
                                </div>
                            </div>


                            <div class="form-group  ">
                                <label for="status" class="col-sm-2  control-label">{{ trans('block_content.status') }}</label>
                                <div class="col-sm-8">
                                <input type="checkbox" name="status"  {!! old('status',(empty($layout['status'])?0:1))?'checked':''!!}>

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



$(function () {
    $('[name="type"]').change(function(){
    var type = $(this).val();
    var obj = $('[name="text"]');
    obj.next('.help-block').remove();
    if(type =='html'){
       obj.before('<textarea name="text" class="form-control text" rows="5" placeholder="Layout text"></textarea><span class="help-block"><i class="fa fa-info-circle"></i> {{ trans('block_content.admin.helper_html') }}.</span>');
       obj.remove();
    }else if(type =='view'){
       obj.before('<select name="text" class="form-control text">@foreach ($listViewBlock as $view)<option value="{{ $view }}">{{ $view }}</option>@endforeach</select><span class="help-block"><i class="fa fa-info-circle"></i> {{ trans('block_content.admin.helper_view') }}</span>');
       obj.remove();
    }else if(type =='module'){
       obj.before('<select name="text" class="form-control text">@foreach ($listModuleBlock as $module)<option value="{{ $module }}">{{ $module }}</option>@endforeach</select><span class="help-block"><i class="fa fa-info-circle"></i> {{ trans('block_content.admin.helper_module') }}</span>');
       obj.remove();
    }
    });
});
</script>

@endpush
