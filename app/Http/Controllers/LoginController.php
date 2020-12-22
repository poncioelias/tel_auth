<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Session;
use \App\Http\Controllers\SessionController;
use \Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /**
     * view: retorna a tela inicial
     *
     * @param string $uri_system
     * @return void
     */
    public function index(string $uri_system = null)
    {   

        $systems = DB::table('_users.tbl_systems')
                        ->select('*')  
                        ->orderByRaw('name ASC')         
                        ->get();

        $functions = DB::table('_users.tbl_users_functions')
                        ->select('id','name')  
                        ->orderByRaw('id ASC')         
                        ->get();

        if(!$systems || !$functions){
            return redirect()->route('error');
        }
       
        return view('template_auth.login.index',[
            'uri_system'=>$uri_system,
            'systems'=>$systems,            
            'functions'=>$functions
            ]);
    }

    /**
     * post: login
     *
     * @return void
     */
    public function store(Request $request)
    {     
       
        if( in_array('',$request->only('id_system','idtel', 'password')) ){
            $json['message'] = 'Campo(s) sem preenchimento. Verifique!';
            $json['status'] = 'warning';
            return response()->json($json);
        }     

              
        $user = UserModel::user( $request->id_system, $request->idtel); 
        if( is_object($user) )       
            $confirm = Hash::check($request->password, $user->password);
          

        if( empty($confirm) || !is_object($user) ){
            $json['message'] = 'Usuário e/ou senha inválido(s)!';
            $json['status'] = 'warning';
            return response()->json($json);
        }   

        $session = new SessionController($user); 
        Session::put( $user->uri, $session->all()); 
     
        $json['message'] = '<i class="fas fa-check-circle"></i> Login efetuado! Redirecionando...';
        $json['status'] = 'success';

        if( $user->reset_passwd == 0 )            
            $json['redirect'] = $user->link;         
        else    
            $json['redirect'] = url('/resetpasswd');  

        $json['json'] = $session->all();
        $json['route_session'] = $user->link . "/public/session";    
        return response()->json($json);   
    }

    /**
     * post: register
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {        
        if( in_array('',$request->only('system','idtel', 'password')) ){
            $json['message'] = 'Campo(s) sem preenchimento. Verifique!';
            $json['status'] = 'warning';
            return response()->json($json);
        }   

        if( !filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json['message'] = 'Informe um email válido!';
            $json['status'] = 'warning';
            return response()->json($json);    
        }


        if( $request->password != $request->passwd_confirm){
            $json['message'] = 'Senhas não conferem!';
            $json['status'] = 'warning';
            return response()->json($json);    
        }

        DB::table('tbl_users')->insert([
          
          
            'name' => '',
            'idtel' => '',
            'password' => '',
            'email' => '',            
            'id_profile' => '',        
            'profile_description' => '',
            'id_system' => '',           
           
        ]);

       
 
        $json['message'] = '<i class="fas fa-check-circle"></i> Registro efetuado! Verifique seu email.';
        $json['status'] = 'success';
        return response()->json($json);    
       
    }

    /**
     * post: register/verify
     *
     * @param Request $request
     * @return void
     */
    public function userVerify(Request $request)
    {        
        $return = [
            ['cod'=>'0', 'message'=>'<i class="fas fa-check"></i> Este usuário já existe e está vinculado neste sistema.', 'status'=>'success'],
            ['cod'=>'1', 'message'=>'<i class="fas fa-exclamation-triangle"></i> Este usuário já existe mas não está vinculado ao sistema selecionado.<br>Peça para o adminstrador do sistema liberá-lo no mesmo.<br>
            <a href=# class="mt-2 btn btn-outline-info"  data-idmodal="modalDoubt" data-href="'.url('/modal/doubt').'">Dúvidas?</a></p>', 'status'=>'info'],
            ['cod'=>'2', 'message'=>'Informe seu Id tel.', 'status'=>''],
            ['cod'=>'3', 'message'=>'<i class="fas fa-exclamation-triangle"></i> O idtel deve conter 10 caracteres.', 'status'=>'warning'],
            ['cod'=>'4', 'message'=>'<i class="fas fa-exclamation-triangle"></i> O idtel deve conter apenas números.', 'status'=>'warning'],
         ];

        if( ctype_alpha($request->idtel) ){
            return response()->json($return[4]);
        }   
       

        if( mb_strlen($request->idtel) != 10){
            return response()->json($return[3]);
        }
        

        $user_system = UserModel::user( $request->id_system, $request->idtel); 
        $user = UserModel::user( null, $request->idtel); 
       
        if($user_system){
            return response()->json($return[0]);
        }

        if($user){
            return response()->json($return[1]);
        }

        return response()->json($return[2]);
    }

    /**
     * post: recover
     *
     * @return void
     */
    public function recover()
    {       
        if( empty($_POST['idtel']) ){
            echo json_encode(['message'=>'<i class="fas fa-info-circle"></i> Campo(s) sem preenchimento. Verifique!','status'=>'warning']);
            return;
        }   

        $json['message'] = '<i class="fas fa-check-circle"></i> Email enviado. Verifique nele o link de recuperação!';
        $json['status'] = 'success';
        return response()->json($json);
        
    }    

    /**
     * view: redefinicao de senha
     *
     * @return void
     */
    public function resetpasswd()
    {
       echo 'resetpasswd';
    }

   
}
