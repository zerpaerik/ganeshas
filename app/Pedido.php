<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="pedido";

    protected $fillable = [
        'id','descuento','total','subtotal','estatus','cliente'
    ];
    //
}
