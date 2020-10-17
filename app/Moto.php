<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = "moto";
    protected $fillable = ['id_user','moto'];

    public function getMoto($id)
    {
        return $this->find($id)->moto;
    }
}
