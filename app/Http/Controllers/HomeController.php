<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creditos;
use App\Debitos;
use App\Analisis;
use App\SoliUs;
use App\Sedes;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $sedes = Sedes::all();

        return view('home',compact('sedes'));
    }

    public function solicitudes(Request $request)
    {

        $soliu = SoliUs::all();
        return view('soliu.index', compact('soliu'));
    
    }




}
