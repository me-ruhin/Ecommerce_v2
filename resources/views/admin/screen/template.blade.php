@extends('admin.layout')

@section('main')
   <div class="row">
      <div class="col-md-12">
         <div class="box">
            <!-- /.box-header -->
            <div class="box-body" id="pjax-container">
             <table id="main-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th>{{ trans('template.name') }}</th>
                  <th>{{ trans('template.auth') }}</th>
                  <th>{{ trans('template.email') }}</th>
                  <th>{{ trans('template.website') }}</th>
                  <th>{{ trans('template.version') }}</th>
                  <th>{{ trans('template.status') }}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($templates as $key => $template)
                    <tr>
                     <td>{!!sc_image_render($template['config']['image']??'','50px')!!}</td>
                     <td>{{ $template['config']['name']??'' }}</td>
                     <td>{{ $template['config']['auth']??'' }}</td>
                     <td>{{ $template['config']['email']??'' }}</td>
                     <td>{{ $template['config']['website']??'' }} <a href="{{ $template['config']['website']??'' }}" target=_new><i class="fa fa-share" aria-hidden="true"></i></a></td>
                     <td>{{ $template['config']['version']??'' }}</td>
                      <td>{!! ($templateCurrent == $key)?'<button title="'.trans('template.activated').'"  class="btn btn-flat action-teplate">'.trans('template.activated').'</button >':'<button  onClick="enableTemplate($(this),\''.$key.'\');" title="'.trans('template.inactive').'" data-loading-text="'.trans('template.installing').'" class="btn btn-flat btn-primary action-teplate">'.trans('template.inactive').'</button >' !!}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
      <!-- /.row -->
      </div>
    </div>
  </div>

@endsection


@push('styles')

@endpush

@push('scripts')
<script type="text/javascript">
  function enableTemplate(obj,key) {
    $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_template.changeTemplate') }}',
        data: {
          "_token": "{{ csrf_token() }}",
          "key":key,
        },
        success: function (response) {
          console.log(response);
          if(parseInt(response.error) ==0){
              $.pjax.reload({container:'#pjax-container'});
                Swal.fire(
                'Success!',
                '',
                'success'
                )
          }else{
            Swal.fire(
              response.msg,
              'You clicked the button!',
              'error'
              )
          }
          $('#loading').hide();
          obj.button('reset');
        }
      });

  }
</script>


    {{-- //Pjax --}}
   <script src="{{ asset('admin/plugin/jquery.pjax.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
    // does current browser support PJAX
      if ($.support.pjax) {
        $.pjax.defaults.timeout = 2000; // time in milliseconds
      }
    });
  </script>
    {{-- //End pjax --}}

@endpush
