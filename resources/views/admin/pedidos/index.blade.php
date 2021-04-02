@extends('layouts.admin.master')

@section('title', 'Pedidos')

@section('header', 'Pedidos')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pedidos Registrados</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    {{--FancyBox--}}
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    {{-- FancyBox--}}
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <script>
        jQuery(function ($) {
            $('.table').footable();
        });

        function accionLote(input) {
            var check = document.getElementById('hiddenCheck' + input)
            check.click();
        }

        function todosCheck(num) {
            for (var i = 1; i <= num; i++) {
                document.getElementById('customCheck' + i).click();
            }
        }

        var btn_aplicar = document.getElementById('btn_aplicar_lote');
        btn_aplicar.addEventListener('click', function () {
            var select = document.getElementById('select_lote');
            var acction = select[select.selectedIndex].value;
            if(acction == 100){
                alertaBorrar('form_lote');
            }else{
                document.getElementById('btn_enviar').click();
            }

        });

        document.getElementById("form_lote").reset();

        /*function cambiar(){
            var pdrs = document.getElementById('customFileLang').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }

        function readImage (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    //$('#blah').attr('class', 'img-thumbnail');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileLang").change(function () {
            // Código a ejecutar cuando se detecta un cambio de archivO
            readImage(this);
        });*/
    </script>
@endsection


@section('nav-buscar')
    {!! Form::open(['route' => 'pedidos.index', 'method' => 'get']) !!}
    <div class="input-group input-group-sm">
        <input type="search" name="buscar" class="form-control form-control-navbar"  placeholder="Buscar Pedido" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-md-11">
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Pedidos Registrados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-shopping-bag"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <ol class="breadcrumb">
                            @if ($ver != 100 || isset($_GET['buscar']))
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Todos <span class="text-muted">({{ cerosIzquierda($todos) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Todos ({{ cerosIzquierda($todos) }})</li>
                            @endif
                            @if ($ver != 0)
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.ver', 0) }}">Pendiente de Pago <span class="text-muted">({{ cerosIzquierda($pendiente_pago) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Pendiente de Pago <span class="text-muted">({{ cerosIzquierda($pendiente_pago) }})</span></li>
                            @endif
                            @if ($ver != 1)
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.ver', 1) }}">En Espera <span class="text-muted">({{ cerosIzquierda($en_espera) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">En Espera <span class="text-muted">({{ cerosIzquierda($en_espera) }})</span></li>
                            @endif
                            @if ($ver != 2)
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.ver', 2) }}">Procesando <span class="text-muted">({{ cerosIzquierda($procesando) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Procesando <span class="text-muted">({{ cerosIzquierda($procesando) }})</span></li>
                            @endif
                            @if ($ver != 3)
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.ver', 3) }}">Completado <span class="text-muted">({{ cerosIzquierda($completado) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Completado <span class="text-muted">({{ cerosIzquierda($completado) }})</span></li>
                            @endif
                            @if ($ver != 4)
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.ver', 4) }}">Cancelado <span class="text-muted">({{ cerosIzquierda($cancelado) }})</span></a></li>
                            @else
                                <li class="breadcrumb-item active">Cancelado <span class="text-muted">({{ cerosIzquierda($cancelado) }})</span></li>
                            @endif
                            @if ($ver == 99)
                                    <li class="breadcrumb-item active">Filtro <span class="text-muted">({{ cerosIzquierda($filtro) }})</span></li>
                            @endif

                        </ol>
                        <div class="row">
                            @php($i = 0)
                        @if (leerJson(Auth::user()->permisos, 'pedidos.edit') || Auth::user()->role == 100)
                        {!! Form::open(['route' => ['pedidos.acciones_lote'], 'method' => 'post', 'class' => 'col-md-4', 'id' => 'form_lote']) !!}
                            <div class="row">
                                @php($acciones = estadoPedido())
                                @if (leerJson(Auth::user()->permisos, 'productos.destroy') || Auth::user()->role == 100)
                                    @php($acciones[100] = "Mover a la Papelera")
                                @endif
                                {!! Form::select('accion', $acciones , null , ['class' => 'custom-select col-md-7', 'placeholder' => 'Acciones en lote', 'id' => 'select_lote', 'required']) !!}
                                <div class="d-none">
                                    @php($i = 0)
                                    @foreach ($pedidos as $producto)
                                        @php($i++)
                                        <input type="checkbox" name="pedidos_id_{{ $i }}" value="{{ $producto->id }}" id="hiddenCheck{{ $i }}">{{ $i }}
                                    @endforeach
                                    <input type="text" name="total" value="{{ $i }}">
                                    <input type="submit" id="btn_enviar" value="hola">
                                </div>
                                <button type="button" id="btn_aplicar_lote" class="btn btn-outline-primary col-md-4">Aplicar</button>
                            </div>
                        {!! Form::close() !!}
                        @endif

                        {!! Form::open(['route' => ['pedidos.filtrar'], 'method' => 'post', 'class' => 'col-md-7']) !!}
                            <div class="row">
                                {{--{!! Form::select('categorias_id', $categorias, null , ['class' => 'custom-select col-md-4', 'placeholder' => 'Elige una categoria']) !!}--}}
                                {{--{!! Form::select('estado', ['1' => 'Hay existecias', '0' => 'Agotado'] , null , ['class' => 'custom-select col-md-4 ml-1', 'placeholder' => 'Filtrar por inventario']) !!}--}}
                                {!! Form::date('fecha_filtrar', null /*\Carbon\Carbon::now()*/, ['class' => 'form-control col-md-3 ml-1']) !!}
                                {!! Form::text('cliente_filtrar', null, ['class' => 'form-control col-md-3 ml-1', 'placeholder' => 'Filtrar por cliente registrado']) !!}
                                {!! Form::select('delivery_filtrar', ['SI' => 'SI', 'NO' => 'NO'] , null , ['class' => 'custom-select col-md-3 ml-1', 'placeholder' => 'Filtrar por Delivery']) !!}
                                <button type="submit" class="btn btn-outline-primary col-md-2 ml-1">Filtrar</button>
                            </div>
                        {!! Form::close() !!}
                        </div>

                        <table class="table table-hover bg-light mt-3 table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                                <th scope="col" class="text-center" data-breakpoints="xs" width="5%">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" onclick="todosCheck('{{ $i }}')" class="custom-control-input accion-lote" id="customCheck0">
                                        <label class="custom-control-label" for="customCheck0">{{--{{ $i }}Check this custom checkbox--}}</label>
                                    </div>
                                </th>
                                @endif
                                <th scope="col">Pedido</th>
                                <th scope="col" data-breakpoints="xs">Fecha</th>
                                <th scope="col" data-breakpoints="xs">Estatus</th>
                                <th scope="col" data-breakpoints="xs" class="text-center">Delivery</th>
                                <th scope="col" class="text-right" data-breakpoints="xs">Total $</th>
                                <th scope="col" data-breakpoints="xs" style="width: 5%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 0)
                            @foreach ($pedidos as $pedido)
                                @php($i++)
                                <tr>
                                    @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                                    <th scope="row" class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" onclick="accionLote('{{ $i }}')" class="custom-control-input" id="customCheck{{ $i }}">
                                            <label class="custom-control-label" for="customCheck{{ $i }}">{{--{{ $i }}Check this custom checkbox--}}</label>
                                        </div>
                                    </th>
                                    @endif
                                    <td>
                                        <span class="text-bold">
                                            #{{ $pedido->id }}
                                        </span>
                                        <span>
                                            {{ ucwords($pedido->nombre) }}
                                            {{ ucwords($pedido->apellidos) }}
                                        </span>
                                    </td>
                                    <td>{{ fecha($pedido->fecha) }}</td>
                                    <td>
                                        <span class="{{ estadoClass($pedido->estatus) }}">{{ estatusPedido($pedido->estatus) }}</span>
                                    </td>
                                    <td class="text-center text-bold">
                                        @if ($pedido->delivery == "SI")
                                            <i class="fa fa-truck"></i>
                                        @endif {{ $pedido->delivery }}
                                    </td>
                                    <td class="text-right text-bold">
                                        <i class="fa fa-dollar-sign"></i> {{ formatoMillares($pedido->total) }}
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['productos.destroy', $pedido->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$pedido->id]) !!}
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'productos.edit') || Auth::user()->role == 100)
                                                {{--<button type="button" class="btn btn-info" --}}{{--data-toggle="modal" data-target="#modal-{{ $pedido->id }}"--}}{{-->
                                                    <i class="fas fa-eye"></i>
                                                </button>--}}
                                                <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                <button type="button" class="btn btn-info" {{--data-toggle="modal" data-target="#modal-{{ $pedido->id }}"--}}>
                                                    <i class="fas fa-file-pdf"></i>
                                                </button>
                                                {{--<a href="{{ route('productos.edit', $pedido->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>--}}
                                            @endif
                                            {{--@if (leerJson(Auth::user()->permisos, 'productos.destroy') || Auth::user()->role == 100)
                                                @if ($pedido->por_defecto != 1)
                                                    <button type="button" onclick="alertaBorrar('form_delete_{{ $pedido->id }}')" class="btn btn-info">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-info disabled"><i class="fas fa-trash"></i></button>
                                                @endif
                                            @endif--}}
                                        </div>
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $pedidos->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
