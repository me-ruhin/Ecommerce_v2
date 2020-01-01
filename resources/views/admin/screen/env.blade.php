@extends('admin.layout')

@section('main')

<div class="row">

  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-body table-responsive no-padding box-primary">
       <table class="table table-hover">
         <thead>
           <tr>
             <th>{{ trans('env.field') }}</th>
             <th>{{ trans('env.value') }}</th>
           </tr>
         </thead>
         <tbody>

        <tr>
          <td>{{ trans('env.SITE_STATUS') }}</td>
          <td>
            <a href="#" class="fied-required editable editable-click" data-name="SITE_STATUS" data-type="select" data-pk="" data-source="{{ json_encode(['on'=>'ON','off'=>'OFF']) }}" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.SITE_STATUS') }}" data-value="{{ sc_config('SITE_STATUS') }}" data-original-title="" title=""></a></td>
        </tr>

        <tr>
          <td>{{ trans('env.SITE_TIMEZONE') }}</td>
          <td><a href="#" class="fied-required editable editable-click" data-name="SITE_TIMEZONE" data-type="select" data-pk="" data-source="{{ json_encode($timezones) }}" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.SITE_TIMEZONE') }}" data-value="{{ sc_config('SITE_TIMEZONE') }}" data-original-title="" title=""></a></td>
        </tr>

        <tr>
          <td>{{ trans('env.SITE_LANGUAGE') }}</td>
          <td><a href="#" class="fied-required editable editable-click" data-name="SITE_LANGUAGE" data-type="select" data-pk="" data-source="{{ json_encode($languages) }}" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.SITE_LANGUAGE') }}" data-value="{{ sc_config('SITE_LANGUAGE') }}" data-original-title="" title=""></a></td>
        </tr>

        <tr>
          <td>{{ trans('env.SITE_CURRENCY') }}</td>
          <td><a href="#" class="fied-required editable editable-click" data-name="SITE_CURRENCY" data-type="select" data-pk="" data-source="{{ json_encode($currencies) }}" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.SITE_CURRENCY') }}" data-value="{{ sc_config('SITE_CURRENCY') }}" data-original-title="" title=""></a></td>
        </tr>

          <tr>
            <td>{{ trans('env.APP_DEBUG') }}</td>
            <td><a href="#" class="fied-required editable editable-click" data-name="APP_DEBUG" data-type="select" data-pk="" data-source="{{ json_encode(['off'=>'OFF','on'=>'ON']) }}" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.APP_DEBUG') }}" data-value="{{ sc_config('APP_DEBUG') }}" data-original-title="{{ trans('env.APP_DEBUG') }}" title=""></a></td>
          </tr>


          <tr>
            <td>{{ trans('env.ADMIN_LOG') }}</td>
            <td><a href="#" class="fied-required editable editable-click" data-name="ADMIN_LOG" data-type="select" data-pk="" data-source="{{ json_encode(['off'=>'OFF','on'=>'ON']) }}" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_LOG') }}" data-value="{{ sc_config('ADMIN_LOG') }}" data-original-title="{{ trans('env.ADMIN_LOG') }}" title=""></a></td>
          </tr>

          <tr>
            <td>{{ trans('env.ADMIN_LOG_EXP') }}</td>
            <td><a href="#" class="updateInfo editable editable-click" data-name="ADMIN_LOG_EXP" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_LOG_EXP') }}" data-value="{{ sc_config('ADMIN_LOG_EXP') }}" data-original-title="" title=""></a></td>
          </tr>

          <tr>
            <td>{{ trans('env.ADMIN_PREFIX') }}</td>
            <td><a href="#" class="fied-required editable editable-click" data-name="ADMIN_PREFIX" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_PREFIX') }}" data-value="{{ config('app.admin_prefix') }}" data-original-title="" title=""></a></td>
          </tr>
          <tr>
            <td>{{ trans('env.ADMIN_NAME') }}</td>
            <td><a href="#" class="fied-required editable editable-click" data-name="ADMIN_NAME" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_NAME') }}" data-value="{{ sc_config('ADMIN_NAME') }}" data-original-title="" title=""></a></td>
          </tr>
          <tr>
            <td>{{ trans('env.ADMIN_TITLE') }}</td>
            <td><a href="#" class="fied-required editable editable-click" data-name="ADMIN_TITLE" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_TITLE') }}" data-value="{{ sc_config('ADMIN_TITLE') }}" data-original-title="" title=""></a></td>
          </tr>
          <tr>
            <td>{{ trans('env.ADMIN_LOGO') }}</td>
            <td><a href="#" class="fied-required editable editable-click" data-name="ADMIN_LOGO" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_LOGO') }}" data-value="{{ sc_config('ADMIN_LOGO') }}" data-original-title="" title=""></a></td>
          </tr>
          <tr>
            <td>{{ trans('env.ADMIN_LOGO_MINI') }}</td>
            <td><a href="#" class="updateInfo editable editable-click" data-name="ADMIN_LOGO_MINI" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.ADMIN_LOGO_MINI') }}" data-value="{{ sc_config('ADMIN_LOGO_MINI') }}" data-original-title="" title=""></a></td>
          </tr>
          <tr>
            <td>{{ trans('env.LOG_SLACK_WEBHOOK_URL') }}</td>
            <td><a href="#" class="updateInfo editable editable-click" data-name="LOG_SLACK_WEBHOOK_URL" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_value.update') }}" data-title="{{ trans('env.LOG_SLACK_WEBHOOK_URL_help') }}" data-value="{{ sc_config('LOG_SLACK_WEBHOOK_URL') }}" data-original-title="" title=""></a></td>
          </tr>
          

         </tbody>
       </table>
      </div>
    </div>
  </div>

</div>


@endsection


@push('styles')
<!-- Ediable -->
<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-editable.css')}}">
@endpush

@push('scripts')
<!-- Ediable -->
<script src="{{ asset('admin/plugin/bootstrap-editable.min.js')}}"></script>

<script type="text/javascript">
  // Editable
$(document).ready(function() {
      $.fn.editable.defaults.params = function (params) {
        params._token = "{{ csrf_token() }}";
        return params;
      };
       $('.updateInfo').editable({});
        $('.fied-required').editable({
        validate: function(value) {
            if (value == '') {
                return '{{  trans('admin.not_empty') }}';
            }
        },
        success: function(data) {
          if(data.stt == 1){
            if(data.field == 'ADMIN_PREFIX'){
              window.location.replace("/"+data.value+'/env');
            }
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });
            Toast.fire({
              type: 'success',
              title: '{{ trans('admin.msg_change_success') }}'
            })
          }
      }
    });
});
</script>

    {{-- //Pjax --}}
   <script src="{{ asset('admin/plugin/jquery.pjax.js')}}"></script>

  <script type="text/javascript">

    $('.grid-refresh').click(function(){
      $.pjax.reload({container:'#pjax-container'});
    });

    $(document).on('pjax:send', function() {
      $('#loading').show()
    })
    $(document).on('pjax:complete', function() {
      $('#loading').hide()
    })
    $(document).ready(function(){
    // does current browser support PJAX
      if ($.support.pjax) {
        $.pjax.defaults.timeout = 2000; // time in milliseconds
      }
    });

    {!! $script_sort??'' !!}

    $(document).on('ready pjax:end', function(event) {
      $('.table-list input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    })

  </script>
    {{-- //End pjax --}}


<script type="text/javascript">
{{-- sweetalert2 --}}
var selectedRows = function () {
    var selected = [];
    $('.grid-row-checkbox:checked').each(function(){
        selected.push($(this).data('id'));
    });

    return selected;
}

$('.grid-trash').on('click', function() {
  var ids = selectedRows().join();
  deleteItem(ids);
});

  function deleteItem(ids){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true,
  })

  swalWithBootstrapButtons.fire({
    title: 'Are you sure to delete this item ?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: "#DD6B55",
    cancelButtonText: 'No, cancel!',
    reverseButtons: true,

    preConfirm: function() {
        return new Promise(function(resolve) {
            $.ajax({
                method: 'post',
                url: '{{ $url_delete_item }}',
                data: {
                  ids:ids,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    $.pjax.reload('#pjax-container');
                    resolve(data);
                }
            });
        });
    }

  }).then((result) => {
    if (result.value) {
      swalWithBootstrapButtons.fire(
        'Deleted!',
        'Item has been deleted.',
        'success'
      )
    } else if (
      // Read more about handling dismissals
      result.dismiss === Swal.DismissReason.cancel
    ) {
      // swalWithBootstrapButtons.fire(
      //   'Cancelled',
      //   'Your imaginary file is safe :)',
      //   'error'
      // )
    }
  })
}
{{--/ sweetalert2 --}}

</script>

@endpush
