<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use Auth;
use App\Productos;


class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nosotras()
    {

        return view('landing.nosotras');
        //
    }

    public function productos()
    {

        return view('landing.products');
        //
    }

    public function inicio()
    {

        $productos = Productos::where('estatus','=',1)->get();
        return view('landing.principal', compact('productos'));
        //
    }

    public function contacto()
    {

        return view('landing.contact');
        //
    }

}
