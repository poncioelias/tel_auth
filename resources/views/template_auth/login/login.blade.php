
<form  method='POST' action='{{ url('login') }}' action-verify-user="{{ url('user/verify') }}">


  
  <div class='title mb-3'>Login</div>

  <div class="material-design mb-5">    
    <select class="verify-user"  name="id_system" aria-describedby="id_system" required>
      <option></option>
      @foreach($systems as $item)
        <option value='{{ $item->id }}' {{ $item->uri == $uri_system ? 'SELECTED' :'' }}> {{ $item->name  }} </option>
      @endforeach      
    </select>    
    <span class='bar'></span>   
    <label for="system">Sistema</label>
    <small class="form-text text-muted">Escolha o sistema para logar.</small>
  </div>

  <div class="material-design">    
    <input type='text' class="verify-user" name="idtel"  aria-describedby="idtel" autocomplete='off' required value='0102047227'>      
    <span class='bar'></span> 
    <label for="idtel">IdTel</label>
    <small class="form-text text-muted response-verify">Informe seu Id tel.</small>
  </div>

  <div class="material-design">    
    <input type='password' class="" name="password"  aria-describedby="password" required value='123'>     
    <span class='bar'></span>  
    <label for="idtel">Senha</label>
    <small class="form-text text-muted">Informe sua senha.</small>
  </div>

  <div class="material-design">  
    <button type='submit' class="success"> <img src='{{ asset('storage/svg/enter.svg') }}' height="20">  Entrar </button>
  </div>



  <div class="material-design d-flex justify-content-between align-items-center mt-1">  

    <div class=''>
      <button  class='form-change' name='view-register'> Não tem login? </button>
    </div>

    <div class=''>
      <button  class='form-change' name='view-recover'> Esqueceu a senha? </button>
    </div>
   
  </div>


  <div class="material-design alert alert-back">  
    ...
  </div>
  

</form>
