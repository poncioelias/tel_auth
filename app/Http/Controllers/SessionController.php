<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SessionController extends Controller
{

    /**
     * view: retorna dados da sessao em json
     *
     * @param Request $request
     * @return void
     */
    public static function session(Request $request)
    {                
        if( $request->session()->get($request->uri)) {           

            Session::put( $request->uri.".logged_up" , date('Y-m-d H:i:s') );
       
            echo json_encode($request->session()->get($request->uri),JSON_UNESCAPED_UNICODE);
        }else{
            Session::flush();
            return redirect("/$request->uri");
        }          
    }

   


    

    // public static function storeSession(stdClass $sessionData)
    // {        
    //     $sessionData->session()->put('GSO',['idtel'=>'0102047227']);
       
    // }

    // public function session()
    // {   echo '<pre>';
        

    //     // Session::put('GSO',[
    //     //     'name'=>'cassio douglas',
    //     //     'idtel'=>'0102047227'
    //     //     ]);
    //     //     Session::put('MANOBRAPAR',[
    //     //         'name'=>'cassio douglas',
    //     //         'idtel'=>'0102047227'
    //     //         ]);
        
    //         // var_dump(Session::get());

    //     var_dump(Session::all());
    // }

    // public function storeSession(Type $args): void
    // {
    //     # code...
    // }


}
