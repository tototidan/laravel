<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'image';
    protected $fillable = array("id", "user_id","file_path");
    public static $rules = array(
        "create" => array(
            'user_id' => 'required|integer',
            'file_path' => 'required|string'
        )
    );
}
