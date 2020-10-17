<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = "foto";
    protected $fillable = ['id_user','foto'];

    public static function myfoto($id)
    {
        foreach(Foto::where('id_user', $id)->get('foto') as $foto)
        {
            return $foto->foto;
        }
    }
}
