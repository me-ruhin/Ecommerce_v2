<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <style type="text/css">
            #msg{
                text-align: center;
            }
            .error,.failed{
                color: #ff0000;
                font-weight: normal;
            }
            .success,.passed{
                color: #418802;
            }
        </style>
</head>
<body>
<div class="container">
    <div class="row" style=" margin-top:10px">
    <div class="col-md-12  col-sm-offset-1">

    <div class="col-md-4 col-sm-8">
        <div style="text-align: center;display: inline"><img alt="Logo-Scart" title="Logo-Scart" src="images/scart-min.png" style="width: 130px; max-height: 50px;padding: 5px;">
        </div>

        <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown"><img src="https://s-cart.org/data/language/flag_uk.png" style="height: 25px;">
        <span class="caret"></span>
      </button>
          <ul class="dropdown-menu" >
              <li><a href="install.php"><img src="https://s-cart.org/data/language/flag_uk.png" style="height: 25px;"></a></li>
              <li><a href="install.php?lang=vi"><img src="https://s-cart.org/data/language/flag_vn.png" style="height: 25px;"></a></li>
          </ul>
        </div>
        <div style="clear: both;display: block;">
            <p>
                {{ trans('install.info.about') }}<br>
                {!! trans('install.info.about_us') !!}<br>
                {!! trans('install.info.document') !!}<br>
            </p>
            <p><b>{{ trans('install.info.version') }}</b>: {{ config('scart.version') }}</p>
            <p>{!! trans('install.info.terms') !!}</p>
        </div>

<h3>{{ trans('install.requirement_check') }}</h3>
@if (count($requirements))
    <ul>
        @foreach ($requirements as $label => $result)
            @php
                $status = $result ? 'passed' : 'failed';
            @endphp
                <li>{{ $label }} ... <span class='{{ $status }}'>{{ $status }}</span></li>
        @endforeach
    </ul>
@endif

    </div>
    <div id="signupbox"  class="mainbox col-md-6  col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1>{{ $title }}</h1>
            </div>
            <div class="panel-body" >
                    <form  class="form-horizontal" id="formInstall">
                        <div id="div_database_host" class="form-group required">
                            <label for="database_host"  required class="control-label col-md-4  requiredField"> {{ trans('install.database_host') }} </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" id="database_host"  name="database_host" placeholder="{{ trans('install.database_host') }}" style="margin-bottom: 10px" type="text" value="127.0.0.1" />
                            </div>
                        </div>
                        <div id="div_database_port" class="form-group required">
                            <label for="database_port"  required class="control-label col-md-4  requiredField"> {{ trans('install.database_port') }} </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" id="database_port"  name="database_port" placeholder="{{ trans('install.database_port') }}" style="margin-bottom: 10px" type="number" value="3306" />
                            </div>
                        </div>
                        <div id="div_database_name" class="form-group required">
                            <label for="database_name"  required class="control-label col-md-4  requiredField"> {{ trans('install.database_name') }} </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" id="database_name"  name="database_name" placeholder="{{ trans('install.database_name') }}" style="margin-bottom: 10px" type="text" value="s-cart" />
                            </div>
                        </div>
                        <div id="div_database_user" class="form-group required">
                            <label for="database_user"  required class="control-label col-md-4  requiredField"> {{ trans('install.database_user') }} </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" id="database_user"  name="database_user" placeholder="{{ trans('install.database_user') }}" style="margin-bottom: 10px" type="text" value="root" />
                            </div>
                        </div>
                        <div id="div_database_password" class="form-group required">
                            <label for="database_password"  required class="control-label col-md-4  requiredField"> {{ trans('install.database_password') }} </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md  textinput textInput form-control" id="database_password"  name="database_password" placeholder="{{ trans('install.database_password') }}" style="margin-bottom: 10px" type="password" value="" />
                            </div>
                        </div>
                        <div id="div_admin_url" class="form-group required">
                            <label for="admin_url"  required class="control-label col-md-4  requiredField"> {{ trans('install.admin_url') }} </label>
                            <div class="controls col-md-8">
                                <input class="input-md  textinput textInput form-control" id="admin_url"  name="admin_url" placeholder="{{ trans('install.admin_url') }}" style="margin-bottom: 10px" type="text" value="sc_admin" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls col-md-offset-4 col-md-8 ">
                                <input required class="input-md checkboxinput" id="id_terms" name="terms" style="margin-bottom: 10px" type="checkbox" />
                                         {!! trans('install.terms') !!}

                            </div>
                        </div>
                        <div id="msg" class="form-group"></div>
                        <div class="form-group">
                            <div class="controls col-md-4 "></div>
                            <div class="controls col-md-8 ">
                                <input type="button" {{ max($requirements)?'':'disabled'}} data-loading-text="{{ trans('install.installing_button') }}"  value="{{ trans('install.installing') }}" class="btn btn-primary btn btn-info" id="submit-install" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress" style="display: none;">
                                  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

</div>

    </div>
</div>
</div>

<script type="text/javascript">
$('#submit-install').click(function(event) {
    validateForm();
    if($("#formInstall").valid()){
        $(this).button('loading');
        $('.progress').show();
        $('#msg').removeClass('error');
        $('#msg').removeClass('success');
            $('#msg').html('{{ trans('install.env.process') }}');
            $.ajax({
                url: 'install.php{{ $path_lang }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    database_host:$('#database_host').val(),
                    database_port:$('#database_port').val(),
                    database_name:$('#database_name').val(),
                    database_user:$('#database_user').val(),
                    admin_url:$('#admin_url').val(),
                    database_password:$('#database_password').val(),
                    step:'step1',
                },
            })
            .done(function(data) {

                error= parseInt(data.error);
                if(error != 1 && error !=0){
                    $('#msg').removeClass('success');
                    $('#msg').addClass('error');
                    $('#msg').html(data);
                }
                else if(error ===0)
                {
                    $('#msg').addClass('success');
                    $('#msg').html(data.msg);
                    $('.progress-bar').css("width","25%");
                    $('.progress-bar').html("25%");
                    setTimeout(installDatabase, 1000);
                }else{
                    $('#msg').removeClass('success');
                    $('#msg').addClass('error');
                    $('#msg').html(data.msg);
                }
            })
            .fail(function() {
                $('#msg').removeClass('success');
                $('#msg').addClass('error');
                $('#msg').html('{{ trans('install.env.error') }}');

            })
    }
});

function installDatabase(){
    $('#msg').removeClass('error');
    $('#msg').removeClass('success');
    $('#msg').html('{{ trans('install.database.process') }}');
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step2'},
    })
    .done(function(data) {

        $('#msg').removeClass('success');
        $('#msg').removeClass('error');
         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').addClass('error');
            $('#msg').html(data);
        }
        else if(error === 0)
        {
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","75%");
            $('.progress-bar').html("75%");
            setTimeout(completeInstall, 2000);
        }else{
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
        }

    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.database.error') }}');
    })
}

function completeInstall(){
    $('#msg').removeClass('error');
    $('#msg').removeClass('success');
    $('#msg').html('{{ trans('install.complete.process') }}');
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step3'},
    })
    .done(function(data) {

        $('#msg').removeClass('success');
        $('#msg').removeClass('error');
         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').addClass('error');
            $('#msg').html(data);
        }
        else if(error ===0)
        {
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","100%");
            $('.progress-bar').html("100%");
            $('#msg').html('{{ trans('install.complete.process_success') }}');
            setTimeout(function(){ window.location.replace($('#admin_url').val()); }, 2000);
        }else{
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
        }
    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.complete.error') }}');
    })
}

function validateForm(){
        $("#formInstall").validate({
        rules: {
            "database_host": {
                required: true,
            },
            "database_port": {
                required: true,
                number:true,
            },
            "admin_url": {
                required: true,
            },
            "database_name": {
                required: true,
            },
            "database_user": {
                required: true,
            },
        },
        messages: {
            "database_host": {
                required: "{{ trans('install.validate.database_host_required') }}",
            },
            "database_port": {
                required: "{{ trans('install.validate.database_port_required') }}",
                number: "{{ trans('install.validate.database_port_number') }}",
            },
            "admin_url": {
                required: "{{ trans('install.validate.admin_url_required') }}",
            },
            "database_name": {
                required: "{{ trans('install.validate.database_name_required') }}",
            },
            "database_user": {
                required: "{{ trans('install.validate.database_user_required') }}",
            }
        }
    }).valid();
}

</script>

</body>
</html>
