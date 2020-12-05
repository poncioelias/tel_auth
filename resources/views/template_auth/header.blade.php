<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="shortcut icon" href="{{ asset('storage/svg/tel_black.svg') }}">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}" >

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <meta name='csrf-token' content="{{ csrf_token() }}">

  <title>{{ env('APP_NAME') }} @yield('title')</title>
</head>
<body>    
  
  @yield('content') 

  <script src="{{ asset('js/app.js') }}"></script>
  
</body>
</html>