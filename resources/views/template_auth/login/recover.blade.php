
<form method='POST' action='{{ url('recover') }}'>

  @csrf

  <div class='title mb-3'>Redefinir senha</div>

  <div class="material-design">    
    <input type='text' class="" name="idtel"  aria-describedby="idtel" autocomplete='off' required>      
    <span class='bar'></span> 
    <label for="idtel">IdTel</label>
    <small class="form-text text-muted">Informe seu Id tel.</small>
  </div>

  <div class="material-design alert alert-back">  
    ...
  </div>
  

  <div class="material-design d-flex justify-content-between align-items-center mt-5">
    <div class=''>
      <button  type='submit' class='success' name='view-login'> <img src='{{ asset('storage/svg/send.svg') }}' height="15"> Enviar solicitação </button>
    </div>
    <div class=''>
      <button  class='form-change' name='view-login'> Voltar ao login? </button>
    </div>   
  </div>
  

</form>
