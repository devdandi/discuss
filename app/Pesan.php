<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = "pesan";
    protected $fillable = ['id_pengirim','id_penerima','pesan'];
}
