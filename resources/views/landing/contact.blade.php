@extends('layouts.admin')

@section('content')
<div class="banner-wrapper has_background">
    <img src="contact-heading.jpg"
         class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    <div class="banner-wrapper-inner">
        <h1 class="page-title" style="color: #ad296d;">Contacto</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="{{route('inicio.index')}}"><span>Home</span></a></li>
                <li class="trail-item trail-end active"><span>Contacto</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="site-main main-container no-sidebar">
   
    <div class="section-042">
        <div class="container">
            <div class="row">
                <div class="col-md-12 offset-xl-1 col-xl-10 col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="az_custom_heading">Estamos Ubicados:</h4>
                            <p>SANTIAGO DE SURCO - LIMA PERÙ.<br>
                                Whatsapp: 934545223</p>
                            <h4 class="az_custom_heading">Horario</h4>
                            <p>Lunes-Viernes 19am-7pm PE<br>
                                Sabados 9am-2pm PE</p>
                           
                        </div>
                        <div class="col-md-6">
                            <div role="form" class="wpcf7">
                            <form role="form" method="post" action="soliu/create" class="wpcf7-form">
				        	{{ csrf_field() }}   
                                    <p><label> Nombre Completo *<br>
                                        <span class="wpcf7-form-control-wrap your-name">
                                            <input name="nombre" value="" size="40"
                                                   class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                   type="text"></span>
                                    </label></p>
                                    <p><label> DNI / CE *<br>
                                        <span class="wpcf7-form-control-wrap your-email">
                                            <input name="cedula" value="" size="40"
                                                   class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                   type="text"></span>
                                    </label></p>
                                    <p><label> Telèfono*<br>
                                        <span class="wpcf7-form-control-wrap your-email">
                                            <input name="telefono" value="" size="40"
                                                   class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                   type="text"></span>
                                    </label></p>
                                    <p><label> Fecha de Nacimiento *<br>
                                        <span class="wpcf7-form-control-wrap your-email">
                                            <input name="fecha" value="" size="40"
                                                   class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                   type="date"></span>
                                    </label></p>
                                    <p><label> Direcciòn *<br>
                                        <span class="wpcf7-form-control-wrap your-message">
                                            <textarea name="direccion"
                                                      cols="40" rows="10"
                                                      class="wpcf7-form-control wpcf7-textarea"></textarea></span>
                                    </label></p>
                                    <p><input value="Enviar" class="wpcf7-form-control wpcf7-submit" type="submit"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection