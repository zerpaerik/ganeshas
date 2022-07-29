<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Requerimientos;
use App\ActivosRequerimientos;
use App\Clientes;
use App\Creditos;
use App\Debitos;
use App\Pedidos;
use App\Pedido;
use App\Pacientes;
use App\Solicitudes;
use App\ProductosAlmacen;
use App\Analisis;
use App\User;
use App\Productos;
use Auth;
use Illuminate\Http\Request;
use DB;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if($request->inicio){

      /*  $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.estatus','a.cantidad','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto')
        ->join('productos as b','b.id','a.producto')
        ->where('a.created_at','=',$request->inicio)
        ->where('a.estatus','=',1)
        ->get(); */

        $f1 = $request->inicio;

        $pedidos = DB::table('pedido as a')
        ->select('a.*')
        //->join('productos as b','b.id','a.producto')
        ->where('a.estatus','=',1)
        ->where('a.cliente','=', Auth::user()->id)
        ->where('a.created_at', '=', $request->inicio)
        ->get(); 

        
          
        $soli = Pedido::where('created_at', '=',$f1)
        ->where('estatus','=',1)
        ->where('cliente','=', Auth::user()->id)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }
        $f1 = $request->inicio;
   

    }else {
        $pedidos = DB::table('pedido as a')
        ->select('a.*')
        //->join('productos as b','b.id','a.producto')
        ->where('a.estatus','=',1)
        ->where('a.cliente','=', Auth::user()->id)
        ->where('a.created_at', '=', date('Y-m-d'))
        ->get(); 

        $f1 =date('Y-m-d');

          
        $soli = Pedido::where('created_at', '=',$f1)
        ->where('estatus','=',1)
        ->where('cliente','=', Auth::user()->id)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }

    }

        return view('pedidos.index', compact('pedidos','f1','soli'));
        //
    }

    public function index1(Request $request)
    {


        if($request->inicio){

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.pedido','a.estatus','a.cantidad','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto','p.cliente')
        ->join('productos as b','b.id','a.producto')
        ->join('pedido as p','p.id','a.pedido')
        ->where('p.cliente','=',Auth::user()->id)
        ->where('a.created_at','=',$request->inicio)
        ->where('a.estatus','=',2)
        ->get(); 

        
        $soli = Pedidos::where('created_at', '=',$request->inicio)
        ->where('estatus','=',2)
        ->where('cliente','=',Auth::user()->id)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();







        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }
        $f1 = $request->inicio;
   

    }else {
        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.pedido','a.estatus','a.cantidad','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto','p.cliente')
        ->join('productos as b','b.id','a.producto')
        ->join('pedido as p','p.id','a.pedido')
        ->where('p.cliente','=',Auth::user()->id)
        ->where('a.estatus','=',2)
        ->where('a.created_at', '=', date('Y-m-d'))
        ->get(); 

        $f1 =date('Y-m-d');

          
        $soli = Pedidos::where('created_at', '=',$f1)
        ->where('estatus','=',2)
        ->where('cliente','=',Auth::user()->id)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }

    }

        return view('pedidos.index1', compact('pedidos','f1','soli'));
        //
    }

    public function indexr(Request $request)
    {


    if($request->inicio && is_null($request->cliente)){

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.estatus','a.cantidad','a.cliente','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto','c.name','c.lastname','p.cantidad as soli')
        ->join('productos as b','b.id','a.producto')
        ->join('users as c','c.id','a.cliente')
        ->join('productos_almacen as p','p.producto','a.producto')
        ->whereBetween('a.created_at', [$request->inicio,  $request->fin])
        ->where('a.estatus','=',1)
        ->get(); 

        
        $soli = Pedidos::whereBetween('created_at', [$request->inicio,  $request->fin])
        ->where('estatus','=',1)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }
        $f1 = $request->inicio;
        $f2 = $request->fin;

   
    }else if($request->inicio && !is_null($request->cliente)) {

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.estatus','a.cantidad','a.cliente','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto','c.name','c.lastname','p.cantidad as soli')
        ->join('productos as b','b.id','a.producto')
        ->join('users as c','c.id','a.cliente')
        ->join('productos_almacen as p','p.producto','a.producto')
        ->whereBetween('a.created_at', [$request->inicio,  $request->fin])
        ->where('a.cliente', '=',$request->cliente)
        ->where('a.estatus','=',1)
        ->get(); 

        
        $soli = Pedidos::whereBetween('created_at', [$request->inicio,  $request->fin])
        ->where('cliente', '=', $request->cliente)
        ->where('estatus','=',1)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }
        $f1 = $request->inicio;
        $f2 = $request->fin;


    }else {
        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.estatus','a.cantidad','a.cliente','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto','c.name','c.lastname','p.cantidad as soli')
        ->join('productos as b','b.id','a.producto')
        ->join('users as c','c.id','a.cliente')
        ->join('productos_almacen as p','p.producto','a.producto')
        ->where('a.estatus','=',1)
        ->where('a.created_at', '=', date('Y-m-d'))
        ->get(); 



        $f1 =date('Y-m-d');
        $f2 =date('Y-m-d');


          
        $soli = Pedidos::whereBetween('created_at', [$request->inicio,  $request->fin])
        ->where('estatus','=',1)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }

    }

        $clientes = DB::table('pedido as a')
        ->select('a.*','b.name','b.lastname','b.id')
        ->join('users as b','b.id','a.cliente')
        ->where('a.estatus','=',1)
        ->groupBy('b.id')
        ->get(); 



        return view('pedidos.indexr', compact('pedidos','f1','f2','soli','clientes'));
        //
    }


    public function indexp(Request $request)
    {


        if($request->inicio && is_null($request->cliente)){

         
      
              $pedidos = DB::table('pedido as a')
              ->select('a.*')
              //->join('productos as b','b.id','a.producto')
              ->where('a.estatus','=',2)
              ->whereBetween('a.created_at', [$request->inicio,  $request->fin])
              ->get(); 
      
              
                
              $soli = Pedido::whereBetween('created_at', [$request->inicio,  $request->fin])
              ->where('estatus','=',2)
              ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
              ->first();
      
              if ($soli->cantidad == 0) {
              $soli->monto = 0;
              }
              $f1 = $request->inicio;
              $f2 = $request->fin;
            }else if($request->inicio && !is_null($request->cliente)) {

                $pedidos = DB::table('pedido as a')
                ->select('a.*')
                //->join('productos as b','b.id','a.producto')
                ->where('a.estatus','=',2)
                ->where('a.cliente','=',$request->cliente)
                ->whereBetween('a.created_at', [$request->inicio,  $request->fin])
                ->get(); 
        
                
                  
                $soli = Pedido::whereBetween('created_at', [$request->inicio,  $request->fin])
                ->where('estatus','=',2)
                ->where('cliente','=',$request->cliente)
                ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
                ->first();

                if ($soli->cantidad == 0) {
                $soli->monto = 0;
                }
                $f1 = $request->inicio;
                $f2 = $request->fin;
 
         
      
          }else {
              $pedidos = DB::table('pedido as a')
              ->select('a.*')
              ->where('a.estatus','=',2)
              ->where('a.created_at', '=', date('Y-m-d'))
              ->get(); 

      
              $f1 =date('Y-m-d');
              $f2 =date('Y-m-d');

      
                
              $soli = Pedido::where('created_at', '=',$f1)
              ->where('estatus','=',2)
              ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
              ->first();
      
              if ($soli->cantidad == 0) {
              $soli->monto = 0;
              }
      
          }

          $clientes = DB::table('pedido as a')
          ->select('a.*','b.name','b.lastname','b.id')
          ->join('users as b','b.id','a.cliente')
          ->where('a.estatus','=',2)
          ->groupBy('b.id')
          ->get(); 
  

        return view('pedidos.indexp', compact('pedidos','f1','f2','soli','clientes'));
        //
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$request->pac = 232;
        $solicitudes = DB::table('solicitudes as a')
        ->select('a.id','a.huesped','a.cliente','a.habitacion','a.es_pagado','a.hora','a.precio','a.created_at','a.estatus','a.estado','a.observacion','b.nombre as nompac','b.responsable as apepac','an.nombre as hab')
        ->join('clientes as b','b.id','a.huesped')
        ->join('analisis as an','an.id','a.habitacion')
        ->where('a.estatus', '=', 1)
        ->get();

        $productos = Productos::where('estatus','=',1)->get();

        //$paciente = Pacientes::where('dni','=',$request->pac)->first();
        //print($paciente);
        return view('pedidos.create', compact('solicitudes','productos'));

    }

    public function procesarmultiple(Request $request)
    {


      if(isset($request->ped)){
     
        foreach ($request->ped as $pedido) {

          $ped_det = DB::table('pedidos as a')
          ->select('a.id','a.monto','a.pedido','a.estatus','a.cantidad','a.cliente','a.producto','a.total','a.usuario','a.tipopago','a.created_at','b.id as producto_id','b.nombre as producto','c.name','c.lastname','p.cantidad as soli')
          ->join('productos as b','b.id','a.producto')
          ->join('users as c','c.id','a.cliente')
          ->join('productos_almacen as p','p.producto','a.producto')
          ->where('a.id','=',$pedido)
          ->first(); 


          //VERIFICANDO QUE HAYA MAS STOCK QUE LO SOLICITADO PARA RESTAR
          if($ped_det->soli < $ped_det->cantidad){
            //ACTUALIZAR ITEM DE ORDEN - CANTIDAD DESPACHADA Y TOTAL DE ITEM - STATUS DE PEDIDO
            $a = Pedidos::where('id','=',$pedido)->first();
            $a->cantidad_despachada = $ped_det->soli;
            $a->total = $ped_det->soli * $ped_det->monto;
            $a->estatus = 2;
            $resa = $a->update();

            $pal = ProductosAlmacen::where('producto','=',$ped_det->producto_id)->first();
            //RESTAR DEL STOCK
            $pa = ProductosAlmacen::where('producto','=',$ped_det->producto_id)->first();
            $pa->cantidad =$pal->cantidad -  $ped_det->soli;
            $res = $pa->update();

            $p = Pedido::where('id','=',$ped_det->pedido)->first();
            $p->estatus = 2;
            $resp = $p->update();


          } else {
            //ACTUALIZAR STATUS DE PEDIDO

            $a = Pedidos::where('id','=',$pedido)->first();
            $a->estatus = 2;
            $a->cantidad_despachada =  $ped_det->cantidad;
            $resa = $a->update();

            $pal = ProductosAlmacen::where('producto','=',$ped_det->producto_id)->first();

            //RESTAR DEL STOCK
            $pa = ProductosAlmacen::where('producto','=',$ped_det->producto_id)->first();
            $pa->cantidad =$pal->cantidad -  $ped_det->cantidad;
            $res = $pa->update();

            $p = Pedido::where('id','=',$ped_det->pedido)->first();
            $p->estatus = 2;
            $resp = $p->update();

          }
        
        }
  
      } 
  
      return back();
    }


    public function datapac($id){

       

        $pacientes = DB::table('pacientes as a')
       ->select('a.id','a.dni','a.nombres','a.apellidos','a.direccion','a.telefono','a.fechanac')
       ->where('a.dni','=',$id)
       ->first();

       dd($pacientes);

          // $edad = Carbon::parse($pacientes->fechanac)->age;

       //return $pacientes;

           return view('solicitudes.pacientes',compact('pacientes'));


    }
    

    public function store(Request $request)
    {

      $pedido = new Pedido();
      $pedido->cliente = Auth::user()->id;
      $pedido->save();

      $sum = 0;

        if (isset($request->id_servicio)) {
             foreach ($request->id_servicio['servicios'] as $key => $servicio) {
               if (!is_null($servicio['servicio'])) {

                $ped_det = Pedido::where('id','=', $pedido->id)->first();


                $productos = Productos::where('id','=',$servicio['servicio'])->first();
                $pedidos = new Pedidos();
                $pedidos->producto =$servicio['servicio'];
                $pedidos->cantidad =$request->monto_ss['servicios'][$key]['montoss'];
                $pedidos->monto =$request->monto_s['servicios'][$key]['montos'];
                $pedidos->total =$request->monto_s['servicios'][$key]['montos'] * $request->monto_ss['servicios'][$key]['montoss'];
                $pedidos->cliente = Auth::user()->id;
                $pedidos->usuario = Auth::user()->id;
                $pedidos->pedido =$pedido->id;
                $pedidos->save();

                $sum = $sum + $pedidos->total;
       
               } 
             }
        }


        if($sum > 150 && $sum <= 350){
            $pedido_u = Pedido::find($pedido->id);
            $pedido_u->descuento =  25 ;
            $pedido_u->subtotal =  $sum ;
            $pedido_u->total = $sum - ($sum * 25 / 100);
            $res = $pedido_u->update();
 
        } else if ($sum > 350){
            $pedido_u = Pedido::find($pedido->id);
            $pedido_u->subtotal =  $sum ;
            $pedido_u->descuento =  28 ;
            $pedido_u->total =  $sum - ($sum * 28 / 100);
            $res = $pedido_u->update();
 
        } else {
            $pedido_u = Pedido::find($pedido->id);
            $pedido_u->subtotal =  $sum ;
            $pedido_u->descuento =  0 ;
            $pedido_u->total =  $sum;
            $res = $pedido_u->update();
 
        }

        return redirect()->action('PedidosController@index')
        ->with('success','Registrado Exitosamente!');

    }

    public function pago(Request $request)
    {

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.solicitud','a.descripcion','a.created_at','a.monto','a.estatus','b.huesped','b.habitacion','an.nombre as habita','h.nombre as nompac','h.responsable as apepac')
        ->join('solicitudes as b','b.id','a.solicitud')
        ->join('analisis as an','an.id','b.habitacion')
        ->join('clientes as h','h.id','b.huesped')
        ->where('a.solicitud', '=',$request->solicitud)
        ->first(); 

        $cli =Clientes::where('id','=',$pedidos->huesped)->first();

        $colection = json_decode($request->pedido);

        //dd($request->tipopago);

        if(!is_null($colection)){
            foreach ($colection as $key => $value) {

            $ped =Pedidos::where('id','=',$value->id)->first();

                $disp = Analisis::where('id','=',$pedidos->habitacion)->first();
                $disp->disponible =0;
                $disp->pedido =null;
                $disp->cliente ='';
                $disp->ult_ingreso ='';
                $res = $disp->update();

            $creditoso = new Creditos();
            $creditoso->solicitud =$request->solicitud;
            $creditoso->fecha =date('Y-m-d H:i:s');
            $creditoso->origen ='PEDIDO';
            $creditoso->nombre =$cli->nombre.' '.$cli->responsable;
            $creditoso->descripcion ='PEDIDO POR'.' '.$disp->nombre.' :'.$ped->descripcion;
            $creditoso->usuario =Auth::user()->id;
            $creditoso->tipopago =$request->tipopago;
            if($request->tipopago == 'TJ'){
            $creditoso->monto =$ped->monto + $ped->monto * 0.1;
            $creditoso->tarjeta =$ped->monto + $ped->monto * 0.1;
            } else {
            $creditoso->monto =$ped->monto;
            $creditoso->efectivo =$ped->monto;
            }
            $creditoso->save();

            if($request->tipopago == 'TJ'){

                $peds = Pedidos::where('id','=',$value->id)->first();
                $peds->estatus =1;
                $peds->monto =$peds->monto + $peds->monto * 0.1;
                $peds->tipopago ='TJ';
                $res = $peds->update();
            } else {
                $peds = Pedidos::where('id','=',$value->id)->first();
                $peds->estatus =1;
                $peds->tipopago ='EF';
                $res = $peds->update();                }
                
            }
           }

       
                
                $chk = Solicitudes::where('id','=',$request->solicitud)->first();
                $chk->estatus =2;
                $res = $chk->update();


                return redirect()->action('HomeController@index')
                ->with('success','Pagado Exitosamente!');

        

    }
  

    public function ver($id)
    {
	  
        $solicitudes = DB::table('solicitudes as a')
        ->select('a.id','a.paciente','a.cliente','a.analisis','a.es_pagado','a.hora','a.precio','a.created_at','a.estatus','a.estado','a.observacion','b.nombres as nompac','b.apellidos as apepac','an.nombre as laboratorio')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('analisis as an','an.id','a.analisis')
        ->where('a.id', '=', $id)
        ->first(); 


     


	  
      return view('solicitudes.ver', compact('solicitudes'));
    }	 
    
    

    public function pagar($id)
    {



     

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.solicitud','a.descripcion','a.monto','a.created_at','a.estatus','b.huesped','b.habitacion','an.nombre as habita','h.nombre as nompac','h.responsable as apepac')
        ->join('solicitudes as b','b.id','a.solicitud')
        ->join('analisis as an','an.id','b.habitacion')
        ->join('clientes as h','h.id','b.huesped')
        ->where('a.solicitud','=',$id)
        ->get(); 

        
        $soli = Pedidos::where('solicitud', '=',$id)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($soli->cantidad == 0) {
        $soli->monto = 0;
        }  

        $sol = $id;


     
      return view('pedidos.pagar', compact('pedidos','soli','sol'));
        
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Equipos::find($id);

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.solicitud','a.descripcion','a.monto','a.created_at','a.estatus','b.huesped','b.habitacion','an.nombre as habita','h.nombre as nompac','h.responsable as apepac')
        ->join('solicitudes as b','b.id','a.solicitud')
        ->join('analisis as an','an.id','b.habitacion')
        ->join('clientes as h','h.id','b.huesped')
        ->where('a.solicitud','=',$id)
        ->first(); 

        $productos = Productos::where('estatus','=',1)->get();
        $hab = Analisis::where('id','=',$pedidos->habitacion)->first();



        return view('pedidos.edit', compact('pedido','producto','hab')); //
    }

    public function ticket($id)
    {


        $pedido_detalle = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.pedido','a.estatus','a.cantidad','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto')
        ->join('productos as b','b.id','a.producto')
        ->where('a.pedido','=',$id)
        ->where('a.estatus','=',1)
        ->get(); 



        $pedido = DB::table('pedido as a')
        ->select('a.*')
        //->join('productos as b','b.id','a.producto')
        ->where('a.estatus','=',1)
        ->where('a.id', '=', $id)
        ->first(); 

        $view = \View::make('pedidos.ticket', compact('pedido_detalle','pedido'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
        return $pdf->stream('ticket-pedido'.'.pdf');
    }

    public function ticketp($id)
    {


        $pedido_detalle = DB::table('pedidos as a')
        ->select('a.id','a.monto','a.pedido','a.estatus','a.cantidad','a.total','a.usuario','a.tipopago','a.created_at','a.producto','b.nombre as producto')
        ->join('productos as b','b.id','a.producto')
        ->where('a.pedido','=',$id)
        ->where('a.estatus','=',2)
        ->get(); 

        
        $pedido_c = DB::table('pedidos as a')
        ->select('a.id','a.cliente','b.name as nombre','b.lastname as apellido')
        ->join('users as b','b.id','a.cliente')
        ->where('a.pedido','=',$id)
        ->first(); 

        



        $pedido = DB::table('pedido as a')
        ->select('a.*')
        //->join('productos as b','b.id','a.producto')
        ->where('a.estatus','=',2)
        ->where('a.id', '=', $id)
        ->first(); 

        $view = \View::make('pedidos.ticket', compact('pedido_detalle','pedido','pedido_c'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
        return $pdf->stream('ticket-pedido'.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $Clientes)
    {

      $p = Equipos::find($request->id);
      $p->nombre =$request->nombre;
      $p->descripcion =$request->descripcion;
      $p->marca =$request->marca;
      $p->serial =$request->serial;
      $p->modelo =$request->modelo;
      $p->precio =$request->precio;
      $p->estado =$request->estado;
      $p->estatus =1;
      $p->usuario =Auth::user()->id;
      $p->empresa = Auth::user()->empresa;
      $res = $p->update();
      return redirect()->action('EquiposController@index');

        //
    }

  

    public function reversar($id)
    {

        $p = Solicitudes::where('id','=',$id)->first();
        $p->es_pagado =0;
        $p->fecha_pago =NULL;
        $res = $p->update();

        $cr = Creditos::where('solicitud','=',$id)->first();
        $cr->delete();

        $de = Debitos::where('solicitud','=',$id)->first();
        $de->delete();

      return back();

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $equipos = Equipos::find($id);
        $equipos->estatus = 0;
        $equipos->save();

        return redirect()->action('EquiposController@index');

        //
    }
}

