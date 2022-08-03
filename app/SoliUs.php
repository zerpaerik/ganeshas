<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoliUs extends Model
{

    protected $table="soli_usuarios";


    protected $fillable = [
        'nombre', 'cedula', 'telefono','fecha','direccion'
    ];
    //
}
