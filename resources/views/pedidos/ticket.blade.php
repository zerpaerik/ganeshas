<head>
    <style type="text/css">
      {
        margin: 0;
        padding: 0;
      }
      .table-main{
       margin-left:-55px;
       margin-right:-56px;
      }
      .truncate {
        width: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      @page {
        header: page-header;
        footer: page-footer;
      }
      footer {
        border:solid red;
      }
    </style>

    <meta charset="utf-8">

  </head>

    <body style="width:100%; position:fixed: top: 1px; ">

    <br><br>
    <center><img src="logo_nuevo.png" class="img-circle elevation-1" alt="User Image" width="200"></center>

    <div  style="font-size: 15px; text-align: center;margin-bottom:-60px;margin-top: -20px;">
		<p><strong>RESUMEN DE ORDEN DE COMPRA</strong></p>
	
	   <p style="margin-top: -20px;"><strong>NÚMERO DE RECIBO ELECTRÓNICO: {{$pedido->id}}</strong></p>

	</div>
    <br><br>
    <br><br>


    <div  style="font-size: 15px; text-align: left;margin-bottom:-60px;margin-top: -30px;">
    <p>FECHA: <strong> {{date('d-M-y', strtotime($pedido->created_at))}}</strong> </p>

    @if($pedido->estatus == 2)
    <p>CLIENTE: <strong>{{$pedido_c->apellido}} {{$pedido_c->nombre}}</strong> </p>
    @endif
	
	</div>
  <br><br><br>

    <table width="90%" class="table-main">
      <thead>
        <tr>
          <th style="font-size: 15px"><center>Producto.<center></th>
          <th style="font-size: 15px"><center>Cantidad.<center></th>
          <th style="font-size: 15px"><center>P.Unit.<center></th>
          <th style="font-size: 15px"><center>Total<center></th>
        </tr>
      </thead>
      <tbody>
        @foreach($pedido_detalle as $line)
          <tr>
            <td style="font-size: 15px; line-height: 10px;" align="center">{{$line->producto}}</td>
            <td style="font-size: 15px; line-height: 10px;" align="center">{{$line->cantidad}}</td>
            <td style="font-size: 15px; line-height: 10px;" align="center">{{$line->monto}}</td>
            <td style="font-size: 15px; line-height: 10px;" align="center">{{$line->total}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <br>

    <table width="100%">
      <tbody>
        <tr>
          <td style="width: 100%;">
            <table width="100%">
              <tbody>
                   
                    <tr>
                      <td align="right" style="font-size: 15px"><strong>SUBTOTAL</strong></td>
                      <td align="right" style="font-size: 15px">{{$pedido->subtotal}}</td>
                    </tr>
                    <tr>
                      <td align="right" style="font-size: 15px"><strong>DESCUENTO</strong></td>
                      <td align="right" style="font-size: 15px">{{$pedido->descuento}} %, {{$pedido->subtotal - $pedido->total}} </td>
                    </tr>
                    <tr>
                      <td align="right" style="font-size: 15px"><strong>VALOR TOTAL</strong></td>
                      <td align="right" style="font-size: 15px">{{$pedido->total}}</td>
                    </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

    

    </body>
