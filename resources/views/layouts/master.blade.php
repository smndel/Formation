<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Pour la mise ne place de la requête AJAX -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Post</title>

        <!-- Styles -->
        <!-- retourne le lien vers la feuille de style qui se trouve dans le dossier public -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- permet d'étendre le layout pour insérer une vue composite à l'intérieur -->
                @yield('content')
                
            </div>
        </div>
    </div>
    @section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script src= "{{asset('js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
    <script src= "{{asset('js/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8"></script>
    <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
    </script>
    @show 

    

    </body>
</html>

