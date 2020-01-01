@extends('admin.layout')

@section('main')
   <div class="row">
      <div class="col-md-12">
         <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title"></h2>
                <div class="box-tools">
                  {!! trans('admin.extensions_more') !!}
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body"   id="pjax-container">
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>{{ trans('admin.extension_manager.image') }}</th>
                  <th>{{ trans('admin.extension_manager.code') }}</th>
                  <th>{{ trans('admin.extension_manager.name') }}</th>
                  <th>{{ trans('admin.extension_manager.version') }}</th>
                  <th>{{ trans('admin.extension_manager.auth') }}</th>
                  <th>{{ trans('admin.extension_manager.link') }}</th>
                  <th>{{ trans('admin.extension_manager.sort') }}</th>
                  <th>{{ trans('admin.extension_manager.status') }}</th>
                  <th>{{ trans('admin.extension_manager.action') }}</th>
                </tr>
                </thead>
                <tbody>
                  @if (!$extensions)
                    <tr>
                      <td colspan="5" style="text-align: center;color: red;">{{ trans('admin.extension_manager.empty') }}</td>
                    </tr>
                  @else
                  @foreach ($extensions as $codeExtension => $extensionClassName)
                  @php
                    $classConfig = $extensionClassName.'\\AppConfig';
                    $extensionClass = new $classConfig;
                    if(!array_key_exists($codeExtension, $extensionsInstalled->toArray())){
                      $extensionStatusTitle = trans('admin.extension_manager.not_install');
                      $extensionAction = '<span onClick="installExtension($(this),\''.$codeExtension.'\');" title="'.trans('admin.extension_manager.install').'" type="button" class="btn btn-flat btn-success"><i class="fa fa-plus-circle"></i></span>';
                    }else{
                      if($extensionsInstalled[$codeExtension]['value']){
                        $extensionStatusTitle = trans('admin.extension_manager.actived');
                        $extensionAction ='<span onClick="disableExtension($(this),\''.$codeExtension.'\');" title="'.trans('admin.extension_manager.disable').'" type="button" class="btn btn-flat btn-warning btn-flat"><i class="fa fa-power-off"></i></span>&nbsp;';
                          if($extensionClass->config()){
                            $extensionAction .='<a href="'.url()->current().'?action=config&extensionKey='.$codeExtension.'"><span title="'.trans('admin.extension_manager.config').'" class="btn btn-flat btn-primary"><i class="fa fa-gears"></i></span>&nbsp;</a>';
                          }
                              $extensionAction .='<span onClick="uninstallExtension($(this),\''.$codeExtension.'\');" title="'.trans('admin.extension_manager.remove').'" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>';
                      }else{
                        $extensionStatusTitle = trans('admin.extension_manager.disabled');
                        $extensionAction = '<span onClick="enableExtension($(this),\''.$codeExtension.'\');" title="'.trans('admin.extension_manager.enable').'" type="button" class="btn btn-flat btn-primary"><i class="fa fa-paper-plane"></i></span>&nbsp;';
                          if($extensionClass->config()){
                            $extensionAction .='<a href="'.url()->current().'?action=config&extensionKey='.$codeExtension.'"><span title="'.trans('admin.extension_manager.config').'" class="btn btn-flat btn-primary"><i class="fa fa-gears"></i></span>&nbsp;</a>';
                          }
                              $extensionAction .='
                              <span onClick="uninstallExtension($(this),\''.$codeExtension.'\');" title="'.trans('admin.extension_manager.remove').'" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>';
                      }
                    }
                  @endphp
                    <tr>
                      <td>{!! sc_image_render($extensionClass->image,'50px') !!}</td>
                      <td>{{ $codeExtension }}</td>
                      <td>{{ $extensionClass->title }}</td>
                      <td>{{ $extensionClass->version??'' }}</td>
                      <td>{{ $extensionClass->auth??'' }}</td>
                      <td>{{ $extensionClass->link??'' }}</td>
                      <td>{{ $extensionsInstalled[$codeExtension]['sort']??'' }}</td>
                      <td>{{ $extensionStatusTitle }}</td>
                      <td>{!! $extensionAction !!}</td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
@endsection

@push('styles')

@endpush

@push('scripts')
{{-- //Pjax --}}
<script src="{{ asset('admin/plugin/jquery.pjax.js')}}"></script>


<script type="text/javascript">
  function enableExtension(obj,key) {
      $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_extension.enable') }}',
        data: {
          "_token": "{{ csrf_token() }}",
          "key":key,
          "group":"{{ $group }}"
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
  function disableExtension(obj,key) {
      $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_extension.disable') }}',
        data: {
          "_token": "{{ csrf_token() }}",
          "key":key,
          "group":"{{ $group }}"
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
  function installExtension(obj,key) {
      $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_extension.install') }}',
        data: {
          "_token": "{{ csrf_token() }}",
          "key":key,
          "group":"{{ $group }}"
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
  function uninstallExtension(obj,key) {

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
      }).then((result) => {
        if (result.value) {
            $('#loading').show()
            obj.button('loading');
            $.ajax({
              type: 'POST',
              dataType:'json',
              url: '{{ route('admin_extension.uninstall') }}',
              data: {
                "_token": "{{ csrf_token() }}",
                "key":key,
                "group":"{{ $group }}"
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
      })
  }

    $(document).ready(function(){
    // does current browser support PJAX
      if ($.support.pjax) {
        $.pjax.defaults.timeout = 2000; // time in milliseconds
      }
    });

</script>

@endpush
