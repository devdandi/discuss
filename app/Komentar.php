<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = "_komentar_tabel";
    protected $fillable = ['id_postingan','id_user','komentar'];
}
