<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; 
   
    protected $table = 'users_login';

    protected $primaryKey = 'id';

    public $timestamps = true;

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

    // protected $hidden = [ 
    //     'password',
    //     'remember_token'
    // ];


}
