<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $table = "postingans";
    protected $fillable = ['id_user','postingan'];
}
