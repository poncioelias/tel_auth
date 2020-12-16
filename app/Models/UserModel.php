<?php

namespace App\Models;

use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users_login';#users_login é uma view no mysql
    
    protected $fillable = [
        'insert_in',
        'updated_at',
        'id',
        'name',
        'idtel',
        'password',
        'email',
        'email_confirmation',
        'reset_passwd',
        'function',
        'id_profile',
        'profile',
        'profile_description',
        'id_system',
        'system',
        'uri',
        'link'
    ];

    protected $hidden = [ 
             
    ];  

    /**
     * privado: retorna a propriedade tabela
     *
     * @return void
     */
    public function table()
    {
        return $this->table;
    }

    /**
     * privado: retorna a propriedade colunas (retira as escondidas)
     *
     * @return void
     */
    public function columns(): array
    {        
        return array_diff($this->fillable, $this->hidden);
    } 

    /**
     * retorna um unico usuario
     *
     * @param integer $id_system
     * @param string $idtel
     * @return void
     */
    public static function user(?int $id_system, string $idtel, string $password = null): ?object
    {
        $UserModel = new UserModel();

        if(!$password && !$id_system){

            return DB::table( $UserModel->table())
                        ->select($UserModel->columns())                        
                        ->where('idtel', $idtel )                     
                        ->first();
        }
        
        if(!$password){

            return DB::table( $UserModel->table())
                        ->select($UserModel->columns())
                        ->where('id_system', $id_system )
                        ->where('idtel', $idtel )                     
                        ->first();
        }

        return DB::table( $UserModel->table())
                    ->select($UserModel->columns())
                    ->where('id_system', $id_system )
                    ->where('idtel', $idtel )   
                    ->where('password', $password )                          
                    ->first();


    }

    /**
     * retorna uma coleção de usuarios por sistema
     *
     * @param integer $id_system
     * @return void
     */
    public static function users(int $id_system)
    {
        $UserModel = new UserModel();

        return DB::table( $UserModel->table())
                    ->select($UserModel->columns())
                    ->where('id_system', $id_system )                            
                    ->get();
    }

   
   


}
