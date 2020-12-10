<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SessionController extends Controller
{

    public static function session(Request $request)
    {
        echo '<pre>';
        if( $request ) {
            echo var_dump($request->session());
        }else{
            echo "Session not exist";
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
