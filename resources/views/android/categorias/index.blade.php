@extends('layouts.android.master')

@section('content')

    <div class="row">

        @foreach($categorias as $categoria)
            <div class="col-md-12">
                <a onclick="verCargando();" href="@if($categoria->disponibles > 0) {{ route('android.categorias.show', [Auth::user()->id, $categoria->id]) }} @else # @endif">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-info">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="@if ($categoria->imagen != null){{ asset('img/categorias/'.$categoria->file_path.'/t_'.$categoria->imagen) }}
                                @else
                                {{ asset('img/img-placeholder-320x320.png') }}
                                @endif" alt="{{ $categoria->nombre }}">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{ strtoupper($categoria->nombre) }}</h3>
                            <h5 class="widget-user-desc">{{ formatoMillares($categoria->disponibles, 0) }} Productos</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

@endsection
