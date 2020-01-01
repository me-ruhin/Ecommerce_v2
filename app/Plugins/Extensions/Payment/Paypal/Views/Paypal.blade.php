@extends('admin.layout')

@section('main')
          <div class="box-header with-border">
              <h2 class="box-title">{{ $title_description??'' }}</h2>

              <div class="box-tools">
                  <div class="btn-group pull-right" style="margin-right: 5px">
                      <a href="{{ route('admin_extension',['extensionGroup'=>'Payment']) }}" class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                  </div>
              </div>
          </div>

            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="table table-bordered table-hover">
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_mode') }}</th>
                <td><a href="#" class="updateData" data-name="paypal_mode" data-type="select" data-pk="paypal_mode" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_mode') }}" data-value="{{ sc_config('paypal_mode') }}" data-source ='[{"value":"sandbox","text":"Sandbox"},{"value":"live","text":"Live"}]'></a></td>
              </tr>

              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_log') }}</th>
                <td><a href="#" class="updateData_num" data-name="paypal_log" data-type="select" data-pk="paypal_log" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_log') }}" data-value="{{ sc_config('paypal_log') }}" data-source ='[{"value":0,"text":"OFF"},{"value":1,"text":"ON"}]'></a></td>
              </tr>

              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_client_id') }}</th>
                <td><a href="#" class="updateData_can_empty" data-name="paypal_client_id" data-type="text" data-pk="paypal_client_id" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-value="{{ sc_config('paypal_client_id') }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_client_id') }}"></a></td>
              </tr>
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_secrect') }}</th>
                <td><a href="#" class="updateData_can_empty" data-name="paypal_secrect" data-type="password" data-pk="paypal_secrect" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-value="{{ sc_config('paypal_secrect') }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_secrect') }}"></a></td>
              </tr>
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_path_log') }}</th>
                <td><a href="#" class="updateData" data-name="paypal_path_log" data-type="text" data-pk="paypal_path_log" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_path_log') }}">{{ sc_config('paypal_path_log') }}</a></td>
              </tr>
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_currency') }}</th>
                <td><a href="#" class="updateData" data-name="paypal_currency" data-type="text" data-pk="paypal_currency" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_currency') }}">{{ sc_config('paypal_currency') }}</a></td>
              </tr>
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_order_status_success') }}</th>
                <td><a href="#" class="updateData_num" data-name="paypal_order_status_success" data-type="select" data-pk="paypal_order_status_success" data-source="{{ $jsonStatusOrder }}" data-value="{{ sc_config('paypal_order_status_success') }}" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_order_status_success') }}"></a></td>
              </tr>
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_order_status_faild') }}</th>
                <td><a href="#" class="updateData_num" data-name="paypal_order_status_faild" data-type="select" data-pk="paypal_order_status_faild" data-source="{{ $jsonStatusOrder }}" data-value="{{ sc_config('paypal_order_status_faild') }}" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_order_status_faild') }}"></a></td>
              </tr>
              <tr>
                <th width="40%">{{ trans('Extensions/Payment/Paypal::Paypal.paypal_logLevel') }}</th>
                <td><a href="#" class="updateData" data-name="paypal_logLevel" data-type="select" data-pk="paypal_logLevel" data-url="{{ route('admin_extension.process',['group'=>$group,'key'=>$key]) }}" data-title="{{ trans('Extensions/Payment/Paypal::Paypal.paypal_logLevel') }}" data-value="{{ sc_config('paypal_logLevel') }}" data-source ='[{"value":"DEBUG","text":"DEBUG (not allow live)"},{"value":"INFO","text":"INFO"},{"value":"ERROR","text":"ERROR"},{"value":"WARNING","text":"WARNING"}]'></a></td>
              </tr>

              </table>
            </div>
            <!-- /.box-body -->
@endsection

@push('styles')
<!-- Ediable -->
<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-editable.css')}}">
@endpush

@push('scripts')
<!-- Ediable -->
<script src="{{ asset('admin/plugin/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {

    $.fn.editable.defaults.params = function (params) {
      params._token = "{{ csrf_token() }}";
      return params;
    };

    $('.updateData_num').editable({
    ajaxOptions: {
    type: 'put',
    dataType: 'json'
    },
    validate: function(value) {
        if (value == '') {
            return '{{  trans('admin.not_empty') }}';
        }
        if (!$.isNumeric(value)) {
            return '{{  trans('admin.only_numeric') }}';
        }
    }
    });

    $('.updateData').editable({
    ajaxOptions: {
    type: 'put',
    dataType: 'json'
    },
    validate: function(value) {
        if (value == '') {
            return '{{  trans('admin.not_empty') }}';
        }
    }
    });

    $('.updateData_can_empty').editable({
    ajaxOptions: {
    type: 'put',
    dataType: 'json'
    }
    });
});

</script>

@endpush
