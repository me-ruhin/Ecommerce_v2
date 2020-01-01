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
                  <th>{{ trans('admin.module_manager.image') }}</th>
                  <th>{{ trans('admin.module_manager.code') }}</th>
                  <th>{{ trans('admin.module_manager.name') }}</th>
                  <th>{{ trans('admin.module_manager.version') }}</th>
                  <th>{{ trans('admin.module_manager.auth') }}</th>
                  <th>{{ trans('admin.module_manager.link') }}</th>
                  <th>{{ trans('admin.module_manager.sort') }}</th>
                  <th>{{ trans('admin.module_manager.status') }}</th>
                  <th>{{ trans('admin.module_manager.action') }}</th>
                </tr>
                </thead>
                <tbody>
                  @if (!$modules)
                    <tr>
                      <td colspan="5" style="text-align: center;color: red;">
                        {{ trans('admin.module_manager.empty') }}
                      </td>
                    </tr>
                  @else
                  @foreach ($modules as $codeModule => $moduleClassName)
                  @php
                    $classConfig = $moduleClassName.'\\AppConfig';
                    $moduleClass = new $classConfig;
                    if(!array_key_exists($codeModule, $modulesInstalled->toArray())){
                      $moduleStatusTitle = trans('admin.module_manager.not_install');
                      $moduleAction = '<span onClick="installModule($(this),\''.$codeModule.'\');" title="'.trans('admin.module_manager.install').'" type="button" class="btn btn-flat btn-success"><i class="fa fa-plus-circle"></i></span>';
                    }else{
                      if($modulesInstalled[$codeModule]['value']){
                        $moduleStatusTitle = trans('admin.module_manager.actived');
                        $moduleAction ='<span onClick="disableModule($(this),\''.$codeModule.'\');" title="'.trans('admin.module_manager.disable').'" type="button" class="btn btn-flat btn-warning btn-flat"><i class="fa fa-power-off"></i></span>&nbsp;';
                          if($moduleClass->config()){
                            $moduleAction .='<a href="'.url()->current().'?action=config&moduleKey='.$codeModule.'"><span title="'.trans('admin.module_manager.config').'" class="btn btn-flat btn-primary"><i class="fa fa-gears"></i></span>&nbsp;</a>';
                          }
                              $moduleAction .='<span onClick="uninstallModule($(this),\''.$codeModule.'\');" title="'.trans('admin.module_manager.remove').'" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>';
                      }else{
                        $moduleStatusTitle = trans('admin.module_manager.disabled');
                        $moduleAction = '<span onClick="enableModule($(this),\''.$codeModule.'\');" title="'.trans('admin.module_manager.enable').'" type="button" class="btn btn-flat btn-primary"><i class="fa fa-paper-plane"></i></span>&nbsp;';
                          if($moduleClass->config()){
                            $moduleAction .='<a href="'.url()->current().'?action=config&moduleKey='.$codeModule.'"><span title="'.trans('admin.module_manager.config').'" class="btn btn-flat btn-primary"><i class="fa fa-gears"></i></span>&nbsp;</a>';
                          }
                              $moduleAction .='
                              <span onClick="uninstallModule($(this),\''.$codeModule.'\');" title="'.trans('admin.module_manager.remove').'" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>';
                      }
                    }
                  @endphp
                    <tr>
                      <td>{!! sc_image_render($moduleClass->image,'50px') !!}</td>
                      <td>{{ $codeModule }}</td>
                      <td>{{ $moduleClass->title }}</td>
                      <td>{{ $moduleClass->version??'' }}</td>
                      <td>{{ $moduleClass->auth??'' }}</td>
                      <td>{{ $moduleClass->link??'' }}</td>
                      <td>{{ $modulesInstalled[$codeModule]['sort']??'' }}</td>
                      <td>{{ $moduleStatusTitle }}</td>
                      <td>{!! $moduleAction !!}</td>
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
  function enableModule(obj,key) {
      $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_module.enable') }}',
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
  function disableModule(obj,key) {
      $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_module.disable') }}',
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
  function installModule(obj,key) {
      $('#loading').show()
      obj.button('loading');
      $.ajax({
        type: 'POST',
        dataType:'json',
        url: '{{ route('admin_module.install') }}',
        data: {
          "_token": "{{ csrf_token() }}",
          "key":key,
          "group":"{{ $group }}"
        },
        success: function (response) {
          console.log(response);
              if(parseInt(response.error) ==0){
              location.reload();
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
  function uninstallModule(obj,key) {

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
              url: '{{ route('admin_module.uninstall') }}',
              data: {
                "_token": "{{ csrf_token() }}",
                "key":key,
                "group":"{{ $group }}"
              },
              success: function (response) {
                console.log(response);
              if(parseInt(response.error) ==0){
              location.reload();
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
