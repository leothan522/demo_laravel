@extends('layouts.admin.master')

@section('title', 'Pedidos')

@section('header', 'Pedidos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos Registrados</a></li>
    <li class="breadcrumb-item active">Pedido #{{ $pedido->id }}</li>
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

            <div class="col-md-6">
                <div class="card card-purple">
                    <div class="card-header">
                        <h5 class="card-title">Detalles del Pedido #{{ $pedido->id }}</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-shopping-bag"></i></span>
                        </div>
                    </div>
                    <div class="card-body">




                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-purple">
                    <div class="card-header">
                        <h5 class="card-title">Acciones del Pedido</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Estatus</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                </div>
                                {!! Form::select('estado', estatusPedido() , $pedido->estatus, ['class' => 'custom-select', 'id' => 'select_estado', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <input type="submit" id="boton_publicar" class="btn btn-block btn-primary" value="Actualizar">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
