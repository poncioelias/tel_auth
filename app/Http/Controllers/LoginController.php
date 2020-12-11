<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;
use Illuminate\Auth\Events\Login;


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
        // $user = User::where('id',1)->first();
        // $user->passwd = bcrypt('123');
        // $user->save();

        
        $user = Auth::user();

        // var_dump($user);
        

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

        $credentials = [
            'id_system'=>$request->id_system,
            'idtel'=>$request->idtel,
            'password'=>$request->passwd,
        ];

        // $password = Hash::make($request->passwd);
        // var_dump($credentials);
        // var_dump(Hash::check($request->passwd, $password ));
       


        if(!Auth::attempt($credentials) ){
            // var_dump(Auth::attempt($credentials));
            $json['message'] = 'Usuário e/ou senha inválido(s)!';
            $json['status'] = 'warning';
            return response()->json($json);
        }


        $json['message'] = '<i class="fas fa-check-circle"></i> Login efetuado! Redirecionando...';
        $json['status'] = 'success';     
        $json['redirect'] = route('login.logged');
        return response()->json($json);
        


        // $login_data = Login::where([
        //     'id_system'=>$request->system,
        //     'idtel'=>$request->idtel,
        //     'passwd'=>$request->password
        //     ])->first();
   

        // if( !$login_data ){
        //     $json['message'] = 'Usuário e/ou senha inválido(s)!';
        //     $json['status'] = 'warning';
        //     return response()->json($json);
        // }   

        
        // $request->authenticate();

        // $request->session()->regenerate();

        // var_dump( $request->authenticate());

        // return redirect(RouteServiceProvider::HOME);


        // $json['message'] = '<i class="fas fa-check-circle"></i> Login efetuado! Redirecionando...';
        // $json['status'] = 'success';

        // if( $login_data->reset_passwd == 0)
        //     $json['redirect'] = route('login.logged');
        // else    
        //     $json['redirect'] = route('login.resetpasswd');

        // return response()->json($json);        
        
       

        // $SESSION = [
        //     $login_data->uri => [
        //         'logged' => '1',
        //         'logged_in' => date('Y-m-d H:i:s'),
        //         'logged_up' => date('Y-m-d H:i:s'),
        //         'page_access_now' => '',
        //         'link' => $login_data->link,
        //         'idtel'=> $login_data->idtel,
        //         'name'=> $login_data->name,
        //         'email'=> $login_data->email,
        //         'email_confirmation'=> $login_data->email_confirmation,
        //         'reset_passwd'=> $login_data->reset_passwd,
        //         'profile'=> $login_data->profile,
        //         'profile_description'=> $login_data->profile_description,
        //         'function'=> $login_data->function,
        //     ]
        // ];
    


        // $json['message'] = '<i class="fas fa-check-circle"></i> Login efetuado! Redirecionando...';
        // $json['status'] = 'success';

        // if( $login_data->reset_passwd == 0)
        //     $json['redirect'] = route('login.logged', $SESSION );
        // else    
        //     $json['redirect'] = route('login.resetpasswd');
        // return response()->json($json);          
    }

    /**
     * destroy a sessao autenticada
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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


}
