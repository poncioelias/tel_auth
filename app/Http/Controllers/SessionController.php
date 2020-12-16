<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\PermissionsModel;

class SessionController extends Controller
{
    protected $fillable = [
        'logged_in',
        'logged_up',
        'page_now',
        'permissions',  
    ];

    protected $hidden = [
        'password',               
    ];

    private $fields = [];

    private $data = [];

    public function __construct($user)
    {        
        $this->addFields();
        $this->addData($user);        
    }

    /**
     * cria os campos da sessao
     *
     * @return void
     */
    private function addFields()
    {
       $columnsUser = (new UserModel())->columns();

       $this->fields = array_diff($columnsUser, $this->hidden);
       foreach($this->fillable as $item){
        array_push( $this->fields , $item);
       }       

       return $this;
    }

    /**
     * add os dados nos campos criados da sessao
     *
     * @param [type] $user
     * @return void
     */
    private function addData(object $user)
    {        
        foreach($user as $index=>$item){
            if( in_array($index, $this->fields) )
                $this->data[$index] = $item;
        }

        foreach($this->fillable as $item){
           $this->data[$item] = '';
        }  


        foreach(PermissionsModel::user_permissions($user->id_system,  $user->idtel) as $item){
            $permissions[$item->cod]= $item->name;
        }

        $this->data['logged_in'] = $this->data['logged_up'] =  date('Y-m-d H:i:s');     
        $this->data['permissions'] = $permissions;
        return $this;
    }

    /**
     * retorna os dados da sessao
     *
     * @return void
     */
    public function all()
    {
        return $this->data;
    }

 





}
