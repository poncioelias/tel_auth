<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionsModel extends Model
{
    use HasFactory;

    protected $table = 'users_permissions';#users_login é uma view no mysql
    
    protected $fillable = [
        'cod',
        'name',        
    ];

    protected $hidden = [];  

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
     * retorna uma coleção de permissões do susuario por sistema
     *
     * @param integer $id_system
     * @param string $idtel
     * @return void
     */
    public static function user_permissions(int $id_system , string $idtel): object
    {
        $PermissionsModel = new PermissionsModel();

        return DB::table( $PermissionsModel->table())
                    ->select($PermissionsModel->columns())
                    ->where('id_system', $id_system )
                    ->where('idtel', $idtel )                             
                    ->get();
    }

    public static function permissions(string $uri)
    {
        return session()->get($uri)['permissions'];       
    }
}
