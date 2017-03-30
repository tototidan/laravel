<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Commentaire extends Model
{
    protected $table = 'commentaires';
    protected $fillable = array("id", "auteur", "content", "created_at", "update_at", "user_id", "active");
    public static $rules = array(
        "create" => array(
            'user_id' => 'required|integer',
            'content' => 'required|string',
            'active' => 'boolean',
            'auteur' => 'required|string',
            'auteur_id' => 'required|integer'
        ),
        "update" => array(
            'user_id' => 'required|integer',
            'content' => 'required|string',
            'active' => 'boolean',
            'auteur' => 'required|string',
            'auteur_id' => 'required|integer'
        ),
        "valide" => array(
            "active" => 'boolean',
        )
    );

    public function users()
    {
        return $this->belongsTo("App\User", "user_id", "id");
    }

    public function reponses()
    {
        $this->hasMany("App\Reponse","user_id","id");
    }

}