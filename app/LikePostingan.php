<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikePostingan extends Model
{
    protected $table = "like_postingan";
    protected $fillable = ['id_postingan','id_user'];
}
