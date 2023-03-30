<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContracts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements AuthenticatableContracts{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';//mudando o nome da primary key
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_birthday',
        'user_email',
        'user_password',
        'remember_token'
    ];

    /**
     * The attributes that should not be mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'created_at',	
        'updated_at'
    ];

    public function getAuthIdentifierName()
    {
        // Return the name of the custom primary key column
        return 'user_id';
    }

    public function getAuthIdentifier()
    {
        // Return the value of the custom primary key column
        return $this->user_id;
    }

    public function getAuthPassword()
    {
        // Return the plain text password for the user
        return $this->user_password;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
