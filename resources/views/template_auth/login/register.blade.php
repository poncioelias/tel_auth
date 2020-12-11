
<form  method='POST' action='{{ url('register') }}'>

  @csrf

  <div class='title mb-3'>Novo acesso</div>

  <div class="material-design">    
    <select class=""  name="system"  aria-describedby="system" required>
      <option></option>
      @foreach($systems as $item)
        <option value='1' {{ $item->uri == $uri_system ? 'SELECTED' :'' }}> {{ $item->name  }} </option>
      @endforeach  
    </select>    
    <span class='bar'></span>   
    <label for="system">Sistema</label>
    <small class="form-text text-muted">Escolha os sistemas para acessar.</small>
  </div>

  <div class="material-design">    
    <input type='text' class="" name="idtel"  aria-describedby="idtel" autocomplete='off' required>      
    <span class='bar'></span> 
    <label for="idtel">IdTel</label>
    <small class="form-text text-muted">Informe seu Id tel.</small>
  </div>

  
  <div class="material-design">    
    <input type='text' class="" name="name"  aria-describedby="name" autocomplete='off' required>      
    <span class='bar'></span> 
    <label for="name">Nome</label>
    <small class="form-text text-muted">Informe seu nome completo.</small>
  </div>

  <div class="material-design">    
    <select class="" name="id_function"  aria-describedby="id_function" required>
      @foreach($functions as $item)
        <option value='{{ $item->id }}'>{{ $item->name }}</option>
      @endforeach
    </select>    
    <span class='bar'></span>   
    <label for="id_function">Função</label>
    <small class="form-text text-muted">Escolha sua função.</small>
  </div>

  <div class="material-design">    
    <input type='text' class="" name="email"  aria-describedby="email" autocomplete='off' required>      
    <span class='bar'></span> 
    <label for="email">Email</label>
    <small class="form-text text-muted">Informe seu email.</small>
  </div>

  <div class="material-design">    
    <input type='password' class="" name="passwd"  aria-describedby="passwd" autocomplete='off' required>      
    <span class='bar'></span> 
    <label for="passwd">Senha</label>
    <small class="form-text text-muted">Informe uma senha de no minimo 6 caracteres.</small>
  </div>

  <div class="material-design">    
    <input type='password' class="" name="passwd_confirm" aria-describedby="passwd_confirm" autocomplete='off' required>      
    <span class='bar'></span> 
    <label for="passwd_confirm">Confirme a senha</label>
    <small class="form-text text-muted">Confirme a senha.</small>
  </div>



  <div class="material-design d-flex justify-content-between align-items-center">

    <div class=''>
      <button  type='submit' class='success' name='view-login'> <img src='{{ asset('storage/svg/send.svg') }}' height="15"> Enviar solicitação </button>
    </div>

    <div class=''>
      <button  class='form-change' name='view-login'> Voltar ao login? </button>
    </div>
   
  </div>
  

  <div class="material-design alert alert-back">  
    ...
  </div>
  

</form>
