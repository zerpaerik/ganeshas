<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use Auth;


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

        return view('landing.principal');
        //
    }

    public function contacto()
    {

        return view('landing.contact');
        //
    }

}
