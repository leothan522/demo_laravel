@extends('layouts.android.master')

@section('content')

    <div class="row">

        @foreach($categorias as $categoria)
            @if (!is_null($categoria->imagen) && file_exists('img/categorias/'.$categoria->file_path.'/'.$categoria->imagen))
                @php($imagen = asset('img/categorias/'.$categoria->file_path.'/'.$categoria->imagen))
            @else
                @php($imagen = asset('img/img-placeholder-320x320.png'))
            @endif
			@if(!$categoria->disponibles)
				@continue
			@endif
            <div class="col-md-12">
                <a onclick="verCargando();" href="@if($categoria->disponibles > 0) {{ route('wordpress.categorias.show', $categoria->id) }} @else # @endif">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-info">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="{{ $imagen }}" alt="{{ $categoria->nombre }}">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><small>{{ strtoupper($categoria->nombre) }}</small></h3>
                            <h5 class="widget-user-desc"><small>{{ formatoMillares($categoria->disponibles, 0) }} Productos</small></h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach


    </div>

@endsection
