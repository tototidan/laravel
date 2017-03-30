<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_tag extends Model
{
    protected $table = 'user_tag';
    protected $fillable = array("id", "user_id","tag_id");

}
