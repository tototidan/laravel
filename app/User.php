<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $primaryKey = "id";
    protected $table = 'users';
    protected $fillable = array("id", "nom", "prenom", "IsAdmin", "login", "email", "password");
    protected $hidden = array("password");
    public static $rules = array(
        "create" => array(
            'nom' => 'required|string|min:2',
            'prenom' => 'required|string|min:2',
            'IsAdmin' => 'boolean',
            'login' => 'required|string|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:2|confirmed',
        ),
        "update" => array(
            'nom' => 'required|string|min:2',
            'prenom' => 'required|string|min:2',
            'IsAdmin' => 'boolean',
            'email' => 'required|email',

        )
    );

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }

    public function commentaires()
    {
        return $this->hasMany("App\Commentaire", "user_id", "id");
    }

    public function tags()
    {
        return $this->belongsToMany("App\Tag", "user_tag", "user_id", "tag_id");
    }

    public function notes()
    {
        return $this->hasMany("App\Note", "user_id", "id");
    }

}