@extends('admin.layout')

@section('main')

<div class="row">

  <div class="col-md-6">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ trans('store_info.admin.config_mode') }}</h3>
      </div>

      <div class="box-body table-responsive no-padding box-primary">
       <table class="table table-hover table-bordered">
         <thead>
           <tr>
             <th>{{ trans('store_info.admin.field') }}</th>
             <th>{{ trans('store_info.admin.value') }}</th>
           </tr>
         </thead>
         <tbody>


      <tr>
        <td>{{ trans('store_info.logo') }}
               <span class="input-group-btn">
                 <a data-input="image" data-preview="preview_image" data-type="logo" class="btn btn-sm btn-flat btn-primary lfm">
                   <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                 </a>
               </span>

        </td>
        <td>
            <div class="input-group">
                <input type="hidden" id="image" name="logo" value="{{ $infos->logo }}" class="form-control input-sm image" placeholder=""  />
            </div>
              @if ($errors->has('image'))
                  <span class="help-block">
                      {{ $errors->first('image') }}
                  </span>
              @endif
            <div id="preview_image" class="img_holder">{!! sc_image_render($infos->logo,'100px') !!}</div>

        </td>
      </tr>

      <tr>
        <td>{{ trans('store_info.phone') }}</td>
        <td><a href="#" class="fied-required editable editable-click" data-name="phone" data-type="number" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.phone') }}" data-value="{{ $infos->phone }}" data-original-title="" title="">{{$infos->phone }}</a></td>
      </tr>

      <tr>
        <td>{{ trans('store_info.long_phone') }}</td>
        <td><a href="#" class="fied-required editable editable-click" data-name="long_phone" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.long_phone') }}" data-value="{{ $infos->long_phone }}" data-original-title="" title="">{{$infos->long_phone }}</a></td>
      </tr>

      <tr>
        <td>{{ trans('store_info.time_active') }}</td>
        <td><a href="#" class="fied-required editable editable-click" data-name="time_active" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.time_active') }}" data-value="{{ $infos->time_active }}" data-original-title="" title="">{{$infos->time_active }}</a></td>
      </tr>

      <tr>
        <td>{{ trans('store_info.address') }}</td>
        <td><a href="#" class="fied-required editable editable-click" data-name="address" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.address') }}" data-value="{{ $infos->address }}" data-original-title="" title="">{{$infos->address }}</a></td>
      </tr>

      <tr>
        <td>{{ trans('store_info.email') }}</td>
        <td><a href="#" class="fied-required editable editable-click" data-name="email" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.email') }}" data-value="{{ $infos->email }}" data-original-title="" title="">{{$infos->email }}</a></td>
      </tr>

    </td>
  </tr>

@foreach ($infosDescription as $obj => $infoDescription)
  @if ($obj !='maintain_content')
  <tr>
    <td>{{ trans('store_info.'.$obj) }}</td>
    <td>
      @foreach ($infoDescription as $codeLanguage => $des)
        {{ $languages[$codeLanguage] }}:<br>
        <i><a href="#" class="fied-required editable editable-click" data-name="{{ $obj.'__'.$codeLanguage }}" data-type="text" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.'.$obj) }}" data-value="{{ $des }}" data-original-title="" title="">{{ $des }}</a></i><br>
        <br>
      @endforeach
    </td>
  </tr>
  @endif
@endforeach

    </tbody>
       </table>
      </div>
    </div>
  </div>


  <div class="col-md-6">
    <div class="box box-primary">
        @foreach ($infosDescription as $obj => $infoDescription)
          @if ($obj =='maintain_content')
            @foreach ($infoDescription as $codeLanguage => $des)
              <div class="box-header with-border">
                <h3 class="box-title">{{ trans('store_info.maintain_content') }} {{ $languages[$codeLanguage] }}</h3>
              </div>
              <div class="box-body table-responsive no-padding box-primary">
                    <a href="#" class="fied-required editable editable-click" data-name="{{ $obj.'__'.$codeLanguage }}" data-type="textarea" data-pk="" data-source="" data-url="{{ route('admin_store_info.update') }}" data-title="{{ trans('store_info.'.$obj) }}" data-value="{{ $des }}" data-original-title="" title="">{!!$des !!}</a>
              </div>
              @endforeach
            @endif
        @endforeach
    </div>
  </div>



</div>


@endsection


@push('styles')
<!-- Ediable -->
<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-editable.css')}}">
<style type="text/css">
  #maintain_content img{
    max-width: 100%;
  }
</style>
@endpush

@push('scripts')
<!-- Ediable -->
<script src="{{ asset('admin/plugin/bootstrap-editable.min.js')}}"></script>

<script type="text/javascript">
  // Editable
$(document).ready(function() {

       $.fn.editable.defaults.mode = 'inline';
      $.fn.editable.defaults.params = function (params) {
        params._token = "{{ csrf_token() }}";
        return params;
      };
        $('.fied-required').editable({
        validate: function(value) {
            if (value == '') {
                return '{{  trans('admin.not_empty') }}';
            }
        },
        success: function(data) {
          if(data.stt == 1){
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


  <script type="text/javascript">

    {!! $script_sort??'' !!}

  </script>

<script type="text/javascript">
{{-- sweetalert2 --}}
var selectedRows = function () {
    var selected = [];
    $('.grid-row-checkbox:checked').each(function(){
        selected.push($(this).data('id'));
    });

    return selected;
}

</script>
<script>
  // Update store_info

//Logo
  $('[name="logo"]').change(function(event) {
          $.ajax({
        url: '{{ route('admin_store_info.update') }}',
        type: 'POST',
        dataType: 'JSON',
        data: {"name": 'logo',"value":$(this).val(),"_token": "{{ csrf_token() }}",},
      })
      .done(function(data) {
        if(data.stt == 1){
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
      });
  });
//End logo


  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    }).on('ifChanged', function(e) {
    var isChecked = e.currentTarget.checked;
    isChecked = (isChecked == false)?0:1;
    var name = $(this).attr('name');
      $.ajax({
        url: '{{ route('admin_store_info.update') }}',
        type: 'POST',
        dataType: 'JSON',
        data: {"name": name,"value":isChecked,"_token": "{{ csrf_token() }}",},
      })
      .done(function(data) {
        if(data.stt == 1){
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
      });

      });

  });
  //End update store_info
</script>
@endpush
