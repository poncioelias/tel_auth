<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Session;


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
       
 
        $json['message'] = '<i class="fas fa-check-circle"></i> Registro efetuado! Verifique seu email.';
        $json['status'] = 'success';
        return response()->json($json);    

       
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

    /**
     * post: login
     *
     * @return void
     */
    public function login(Request $request)
    {     
        if( in_array('',$request->only('system','idtel', 'password')) ){
            $json['message'] = 'Campo(s) sem preenchimento. Verifique!';
            $json['status'] = 'warning';
            return response()->json($json);
        }    
        
        
        $login_data =  DB::select(
                        DB::raw("
                            SELECT 
                                USR.id,
                                USR.name,
                                USR.idtel,
                                USR.passwd,
                                USR.email,
                                USR.email_confirmation,
                                USR.reset_passwd,
                                FUNC.name function,
                                PRF.id id_profile,
                                PRF.name profile,
                                PRF.description profile_description,
                                SYS.id id_system,
                                SYS.name system,
                                SYS.uri uri

                            FROM _users.tbl_users USR
                            INNER JOIN _users.tbl_users_functions FUNC ON(FUNC.id = USR.id_function)
                            INNER JOIN _users.tbl_users_profiles PRF ON(PRF.id = USR.id_profile)
                            INNER JOIN _users.tbl_users_systems USRSYS ON(USRSYS.id_user = USR.id)
                            INNER JOIN _users.tbl_systems SYS ON(SYS.id = USRSYS.id_system)
                            WHERE 
                                SYS.id = :system
                                AND idtel = :idtel
                                AND passwd = :passwd
                        "),[
                            'system'=>$request->system,
                            'idtel'=>$request->idtel,
                            'passwd'=>$request->password,
                        ]
            );

        if( !$login_data ){
            $json['message'] = 'Usuário e/ou senha inválido(s)!';
            $json['status'] = 'warning';
            return response()->json($json);
        }     
 

        Session::put(
            $login_data[0]->uri,
            [
            'logged' => '1',
            'logged_in' => date('Y-m-d H:i:s'),
            'logged_up' => date('Y-m-d H:i:s'),
            'page_access_now' => '',
            'idtel'=> $login_data[0]->idtel,
            'name'=> $login_data[0]->name,
            'email'=> $login_data[0]->email,
            'email_confirmation'=> $login_data[0]->email_confirmation,
            'reset_passwd'=> $login_data[0]->reset_passwd,
            'profile'=> $login_data[0]->profile,
            'profile_description'=> $login_data[0]->profile_description,
            'function'=> $login_data[0]->function,
            ]
        );
    


        $json['message'] = '<i class="fas fa-check-circle"></i> Login efetuado! Redirecionando...';
        $json['status'] = 'success';

        if( $login_data[0]->reset_passwd == 0)
            $json['redirect'] = route('home');
        else    
            $json['redirect'] = route('resetpasswd');
        return response()->json($json);          
    }
}
