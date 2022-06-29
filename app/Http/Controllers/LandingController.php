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

        return view('landing.productos');
        //
    }

    public function inicio()
    {

        return view('landing.principal');
        //
    }

    public function contacto()
    {

        return view('landing.contacto');
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('material.create');

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // dd($request->all());

        $material = new Material();
        $material->nombre =$request->nombre;
        $material->usuario =Auth::user()->id;
        $material->save();

        return redirect()->action('MaterialController@index', ["created" => true, "material" => Material::all()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return view('material.edit', compact('material')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {

      $p = Material::find($request->id);
      $p->nombre =$request->nombre;
      $res = $p->update();
      return redirect()->action('MaterialController@index');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {

        $p = Material::find($request->id);
      $p->estatus =0;
      $res = $p->update();

        return redirect()->action('MaterialController@index');

        //
    }
}
