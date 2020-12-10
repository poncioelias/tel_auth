@extends('template_auth.header')
@section('title', 'Erro')
@section('content')

<div class='box-container'>
  
  <div class='box-all'>     
   
    <div class='row content'>

      <div class="left order-2 order-md-1 order-lg-1 col-12 col-md-6 col-lg-6">
        <div class=''>
          <h1>Oops!</h1>        
          Está página não foi encontrada ou está fora do ar!
        </div>
    
      </div>

      <div class="right order-1  order-md-2 order-lg-2 col-12 col-md-6 col-lg-6">

        <div class='logo animate__animated animate__fadeIn'> <img src='{{ asset('storage/svg/tel_black.svg') }}'> </div>

        <div class='footer'>App Autenticação. Desenvolvido pelo setor Apoio Técnico. Versão {{ env('APP_VERSION') }}</div>
        
      </div>

    </div>

  </div>


</div>

@endsection