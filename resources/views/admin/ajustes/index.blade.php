@extends('layouts.admin.master')

@section('title', 'Ajustes')

@section('header', 'Ajustes')

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Ajustes Registradas</a></li>--}}
    <li class="breadcrumb-item active">Ajustes</li>
@endsection

@section('link')
    <!-- Datatables -->
    {{--<link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    --}}{{--FancyBox--}}{{--
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">--}}
@endsection

@section('script')
    {{--<!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    --}}{{-- FancyBox--}}{{--
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
--}}
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('[data-mask]').inputmask()

        var pdivisas = document.getElementById('customControlValidation1');
        pdivisas.addEventListener('change', function () {
            //var div = document.getElementById('select_delivery');
            var nombre = 1;
            var valor;
            if(this.checked) {
                //check
                //alert('chequeado activo');
                valor = true;
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('ajax.mpago') }}",
                        data: {nombre:nombre, valor:valor},
                        success: function (data) {
                            //pdivisas.checked = !data.valor;
                        }
                    });
            }else{
                //no check
                //alert('chequeado no activo');
                valor = false;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.mpago') }}",
                    data: {nombre:nombre, valor:valor},
                    success: function (data) {
                        /*if(data.valor === true){
                            //window.location = "{{ route('android.carrito', Auth::user()->id) }}";
                        }else{

                        }*/
                    }
                });
            }
        });

        var ptransferencias = document.getElementById('customControlValidation2');
        ptransferencias.addEventListener('change', function () {
            //var div = document.getElementById('select_delivery');
            var nombre = 2;
            var valor;
            if(this.checked) {
                //check
                //alert('chequeado activo');
                valor = true;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.mpago') }}",
                    data: {nombre:nombre, valor:valor},
                    success: function (data) {
                        //ptransferencias.checked = !data.valor;
                    }
                });
            }else{
                //no check
                //alert('chequeado no activo');
                valor = false;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.mpago') }}",
                    data: {nombre:nombre, valor:valor},
                    success: function (data) {
                        /*if(data.valor === true){
                            //window.location = "{{ route('android.carrito', Auth::user()->id) }}";
                        }else{

                        }*/
                    }
                });
            }
        });

        var pmovil = document.getElementById('customControlValidation3');
        pmovil.addEventListener('change', function () {
            //var div = document.getElementById('select_delivery');
            var nombre = 3;
            var valor;
            if(this.checked) {
                //check
                //alert('chequeado activo');
                valor = true;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.mpago') }}",
                    data: {nombre:nombre, valor:valor},
                    success: function (data) {
                        //pmovil.checked = !data.valor;
                    }
                });
            }else{
                //no check
                //alert('chequeado no activo');
                valor = false;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.mpago') }}",
                    data: {nombre:nombre, valor:valor},
                    success: function (data) {
                        /*if(data.valor === true){
                            //window.location = "{{ route('android.carrito', Auth::user()->id) }}";
                        }else{

                        }*/
                    }
                });
            }
        });

        /*$.ajax({
            type: 'POST',
            url: "{{ route('ajax.remover') }}",
            data: {id_producto:producto, total:total_actual},
            success: function (data) {
                if(data.content === 0){
                    //window.location = "{{ route('android.carrito', Auth::user()->id) }}";
                }else{

                }

            }
        });*/



    </script>
@endsection

{{--
@section('nav-buscar')
    {!! Form::open(['route' => 'usuarios.index', 'method' => 'get']) !!}
    <div class="input-group input-group-sm">
        <input type="search" name="buscar" class="form-control form-control-navbar"  placeholder="Buscar Usuario" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
--}}

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Ajustes</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-dollar-sign"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' =>  'ajustes.store', 'method' => 'POST', 'id' => 'form1']) !!}

                            <div class="form-group">
                                <label for="name">Precio del Dolar</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{--<i class="fas fa-dollar-sign"></i>--}}Taza actual</span>
                                    </div>
                                    <label class="form-control bg-light">{{ formatoMillares($dolar->valor) }} Bs.</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold">Bs.</span>
                                    </div>
                                    {!! Form::number('precio_dolar', $dolar->valor, ['class' => 'form-control', 'placeholder' => 'Monto en Bs.',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                </div>
                            </div>--}}
                            {{--<div class="form-group">
                                <label for="exampleInputEmail1">Modulo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cogs"></i></span>
                                    </div>
                                    {!! Form::select('modulo', moduloCategoria() , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>--}}
                            @if ($errors->any())
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group text-right">
                                <input type="hidden" name="id_dolar" value="true">
                                <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                            </div>
                            <div class="input-group">
                                @if ($dolar->id)
                                    <span class="text-danger text-xs">Ultima actualización: {{ haceCuanto($dolar->updated_at) }} por {{ $dolar->usuarios->name }}</span>
                                @endif
                            </div>


                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Telefono</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-phone-alt"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' =>  'ajustes.store', 'method' => 'POST', 'id' => 'form1']) !!}

                            <div class="form-group">
                                <label for="name">Numero</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold"><i class="fa fa-phone-alt"></i></span>
                                    </div>
                                    {!! Form::text('telefono_numero', $telefono_numero->valor, ['class' => 'form-control', 'data-inputmask' => '"mask": "(9999) 999.99.99"', 'data-mask']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Texto a Mostrar</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold"><i class="fa fa-text-height"></i></span>
                                    </div>
                                    {!! Form::text('telefono_texto', $telefono_texto->valor, ['class' => 'form-control', 'placeholder' => 'texto corto']) !!}
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group text-right">
                                <input type="hidden" name="id_telefono" value="true">
                                <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-purple">
                    <div class="card-header">
                        <h5 class="card-title">Delivery</h5>
                        <div class="card-tools">
                            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-delivery"><i class="fa fa-truck"></i></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center" data-breakpoints="xs">#</th>
                                <th scope="col">Zona</th>
                                <th scope="col" data-breakpoints="xs" class="text-right">Precio</th>
                                <th scope="col" data-breakpoints="xs" style="width: 5%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($zonas as $zona)
                                <tr>
                                    <th scope="row" class="text-center">{{ $i++ }}</th>
                                    <td>{{ ucwords($zona->nombre) }}</td>
                                    <td class="text-right text-bold">${{ formatoMillares($zona->precio_delivery) }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['ajustes.zonas.delete', $zona->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$zona->id]) !!}
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.show') || Auth::user()->role == 100)
                                                <button class="btn btn-info" data-toggle="modal" data-target="#modal-delivery-{{ $zona->id }}"><i class="fas fa-edit"></i></button>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.edit') || Auth::user()->role == 100)
                                                    <button type="button" onclick="alertaBorrar('form_delete_{{ $zona->id }}')" class="btn btn-info">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-delivery-{{ $zona->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Zona</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        {!! Form::open(['route' => ['ajustes.zonas.update', $zona->id], 'method' => 'PUT']) !!}

                                                        <div class="form-group">
                                                            <label for="name">Nombre</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                                </div>
                                                                {!! Form::text('nombre', ucwords($zona->nombre), ['class' => 'form-control', 'placeholder' => 'Nombre de la zona']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Precio del envio</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                </div>
                                                                {!! Form::number('precio_delivery', $zona->precio_delivery, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                                            </div>
                                                            <span class="text-danger text-xs">Dejar el precio vacio si el envio sera gratuito</span>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                                        </div>

                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Modal -->

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nueva Zona</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        {!! Form::open(['route' => ['ajustes.zonas'], 'method' => 'POST']) !!}

                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                </div>
                                                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la zona']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Precio del envio</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                {!! Form::number('precio_delivery', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                            </div>
                                            <span class="text-danger text-xs">Dejar el precio vacio si el envio sera gratuito</span>
                                        </div>
                                        <div class="form-group text-right">
                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                        </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal -->

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-purple">
                    <div class="card-header">
                        <h5 class="card-title">Metodos de Pago</h5>
                        <div class="card-tools">
                            <a class="btn btn-tool" {{--data-toggle="modal" data-target="#modal-mpagos"--}}><i class="fa fa-credit-card"></i></a>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['class' => 'was-validated']) !!}
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customControlValidation1" @if ($pago_divisas == "true") checked @endif required>
                                <label class="custom-control-label" for="customControlValidation1">Pago con Divisas <small>(Efectivo)</small></label>
                                <div class="invalid-feedback">Metodo de pago inactivo</div>
                            </div>
                        {!! Form::close() !!}
                        {!! Form::open(['class' => 'was-validated']) !!}
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customControlValidation2" @if ($pago_transferencia == "true") checked @endif required>
                                <label class="custom-control-label" for="customControlValidation2">Tranferencias Directas</label>
                                <div class="invalid-feedback">Metodo de pago inactivo</div>
                            </div>
                        {!! Form::close() !!}
                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center" data-breakpoints="xs">#</th>
                                <th scope="col">Banco</th>
                                <th scope="col" data-breakpoints="xs">Tipo</th>
                                <th scope="col" data-breakpoints="xs">Numero</th>
                                <th scope="col" data-breakpoints="xs">Titular</th>
                                <th scope="col" data-breakpoints="xs">RIF</th>
                                <th scope="col" data-breakpoints="xs" class="text-center" style="width: 5%;">
                                    <button class="btn btn-tool" data-toggle="modal" data-target="#modal-mpagos"><i class="fa fa-plus-square"></i></button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach ($cuentas as $cuenta)
                                @if ($cuenta->tipo == "PAGO_MOVIL")
                                    @continue(true)
                                @endif
                                <tr>
                                    <th scope="row" class="text-center">{{ $i++ }}</th>
                                    <td>{{ ucwords($cuenta->banco) }}</td>
                                    <td>{{ ucwords($cuenta->tipo) }}</td>
                                    <td>{{ ucwords($cuenta->numero) }}</td>
                                    <td>{{ ucwords($cuenta->titular) }}</td>
                                    <td>{{ ucwords($cuenta->rif_cedula) }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['ajustes.mpago.destroy', $cuenta->id], 'method' => 'DELETE', 'id' => 'form_delete_mpago'.$cuenta->id]) !!}
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.show') || Auth::user()->role == 100)
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-mpago-{{ $cuenta->id }}"><i class="fas fa-edit"></i></button>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.edit') || Auth::user()->role == 100)
                                                <button type="button" onclick="alertaBorrar('form_delete_mpago{{ $cuenta->id }}')" class="btn btn-info">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}

                                    <!-- Modal -->
                                        <div class="modal fade" id="modal-mpago-{{ $cuenta->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Cuenta</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        {!! Form::open(['route' => ['ajustes.mpago.update', $cuenta->id], 'method' => 'PUT']) !!}

                                                        <div class="form-group">
                                                            <label for="name">Banco</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                                </div>
                                                                {!! Form::text('banco', $cuenta->banco, ['class' => 'form-control', 'placeholder' => 'Nombre del Banco', 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Tipo de cuenta</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                                </div>
                                                                {!! Form::select('tipo', ['CORRIENTE' => 'CORRIENTE', 'AHORRO' => 'AHORRO'] , $cuenta->tipo , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Numero de cuenta</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                                                                </div>
                                                                {!! Form::text('numero', $cuenta->numero, ['class' => 'form-control', 'placeholder' => 'Numero', 'required', 'data-inputmask' => '"mask": "9999-9999-9999-9999-9999"', 'data-mask']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Titular de la cuenta</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                                                </div>
                                                                {!! Form::text('titular', $cuenta->titular, ['class' => 'form-control', 'placeholder' => 'Nombre del Titular', 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">RIF / Cedula</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                                                </div>
                                                                {!! Form::text('rif_cedula', $cuenta->rif_cedula, ['class' => 'form-control', 'placeholder' => 'RIF', 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                                        </div>

                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Modal -->

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        {!! Form::open(['class' => 'was-validated']) !!}
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customControlValidation3" @if ($pago_movil == "true") checked @endif required>
                                <label class="custom-control-label" for="customControlValidation3">Pago Movil</label>
                                <div class="invalid-feedback">Metodo de pago inactivo</div>
                            </div>
                        {!! Form::close() !!}

                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center" data-breakpoints="xs">#</th>
                                <th scope="col">Banco (Codigo)</th>
                                <th scope="col" data-breakpoints="xs">Telefono</th>
                                <th scope="col" data-breakpoints="xs">Cedula</th>
                                <th scope="col" data-breakpoints="xs" class="text-center" style="width: 5%;">
                                    <button class="btn btn-tool" data-toggle="modal" data-target="#modal-mpagomovil"><i class="fa fa-plus-square"></i></button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach ($cuentas as $cuenta)
                                @if ($cuenta->tipo != "PAGO_MOVIL")
                                    @continue(true)
                                @endif
                                <tr>
                                    <th scope="row" class="text-center">{{ $i++ }}</th>
                                    <td>{{ ucwords($cuenta->banco) }}</td>
                                    <td>{{ ucwords($cuenta->numero) }}</td>
                                    <td>{{ ucwords($cuenta->rif_cedula) }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['ajustes.mpago.destroy', $cuenta->id], 'method' => 'DELETE', 'id' => 'form_delete_mpago'.$cuenta->id]) !!}
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.show') || Auth::user()->role == 100)
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-mpagomovil-{{ $cuenta->id }}"><i class="fas fa-edit"></i></button>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.edit') || Auth::user()->role == 100)
                                                    <button type="button" onclick="alertaBorrar('form_delete_mpago{{ $cuenta->id }}')" class="btn btn-info">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            @endif
                                        </div>
                                    {!! Form::close() !!}

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-mpagomovil-{{ $cuenta->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Zona</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        {!! Form::open(['route' => ['ajustes.mpago.update', $cuenta->id], 'method' => 'PUT']) !!}

                                                        <div class="form-group">
                                                            <label for="name">Banco (Codigo)</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-code"></i></span>
                                                                </div>
                                                                {!! Form::text('banco', $cuenta->banco, ['class' => 'form-control', 'placeholder' => 'Codigo del Banco', 'required', 'data-inputmask' => '"mask": "9999"', 'data-mask']) !!}
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="tipo" value="pago_movil">
                                                        <div class="form-group">
                                                            <label for="name">Numero de telefono</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                </div>
                                                                {!! Form::text('numero', $cuenta->numero, ['class' => 'form-control', 'placeholder' => 'Numero', 'required', 'data-inputmask' => '"mask": "99999999999"', 'data-mask']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Cedula</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                                                </div>
                                                                {!! Form::text('rif_cedula', $cuenta->rif_cedula, ['class' => 'form-control', 'placeholder' => 'Numero', 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                                        </div>

                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Modal -->

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-mpagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nueva Cuenta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        {!! Form::open(['route' => ['ajustes.mpago'], 'method' => 'POST']) !!}

                                        <div class="form-group">
                                            <label for="name">Banco</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                </div>
                                                {!! Form::text('banco', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Banco', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tipo de cuenta</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                </div>
                                                {!! Form::select('tipo', ['Corriente' => 'Corriente', 'Ahorro' => 'Ahorro'] , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Numero de cuenta</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                                                </div>
                                                {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Titular de la cuenta</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                                </div>
                                                {!! Form::text('titular', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Titular', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">RIF / Cedula</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                                </div>
                                                {!! Form::text('rif_cedula', null, ['class' => 'form-control', 'placeholder' => 'RIF', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                        </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="modal-mpagomovil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Pago Movil</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        {!! Form::open(['route' => ['ajustes.mpago'], 'method' => 'POST']) !!}

                                        <div class="form-group">
                                            <label for="name">Banco (Codigo)</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-code"></i></span>
                                                </div>
                                                {!! Form::text('banco', null, ['class' => 'form-control', 'placeholder' => 'Codigo del Banco', 'required', 'data-inputmask' => '"mask": "9999"', 'data-mask']) !!}
                                            </div>
                                        </div>
                                        <input type="hidden" name="tipo" value="pago_movil">
                                        <div class="form-group">
                                            <label for="name">Numero de telefono</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'required', 'data-inputmask' => '"mask": "99999999999"', 'data-mask']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Cedula</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                                </div>
                                                {!! Form::text('rif_cedula', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                        </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal -->

                    </div>
                </div>
            </div>
        </div>


    </div>


        {{--<div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="javascript:history.back()"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>--}}
    </div>


@endsection
