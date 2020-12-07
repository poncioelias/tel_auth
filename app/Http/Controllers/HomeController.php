<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        if( empty($_POST) ){
            echo json_encode(['message'=>'Campo(s) sem preenchimento. Verifique!','status'=>'warning']);
            return;
        }     

        echo json_encode(['message'=>'<i class="fas fa-check-circle"></i> Registro efetuado! Verifique seu email.','status'=>'success']);
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

        echo json_encode(['message'=>'<i class="fas fa-check-circle"></i> Email enviado. Verifique nele o link de recuperação!','status'=>'success']);
    }

    /**
     * post: login
     *
     * @return void
     */
    public function login()
    {     
        if( empty($_POST) ){
            echo json_encode(['message'=>'Campo(s) sem preenchimento. Verifique!','status'=>'warning']);
            return;
        }   

  
        echo json_encode(['message'=>'<i class="fas fa-check-circle"></i> Login efetuado! Redirecionando...','status'=>'success']);
    }
}
