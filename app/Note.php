<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $fillable = array("id", "user_id", "note", "coeff");
    public static $rules = array(
        "create" => array(

            'user_id' => 'required|integer',
            'note' => 'required|integer',
            'coeff' => 'required|integer',
        ),
        "update" => array(
            'note' => 'required|integer',
            'coeff' => 'required|integer',
        )



    );


}
