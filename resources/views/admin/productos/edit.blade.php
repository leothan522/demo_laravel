@extends('layouts.admin.master')

@section('title', 'Productos')

@section('header', 'Productos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos Registrados</a></li>
    <li class="breadcrumb-item active">Actualizar Producto</li>
@endsection

@section('link')
    <!-- Producto Galeria -->
    <link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">

    {{--FancyBox--}}
    <link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">
@endsection

@section('script')
    <!-- Producto Galeria -->
    <script src="{{ asset('js/galeria.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    {{-- FancyBox--}}
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(function () {
            // Summernote
            $('.textarea').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            })
        })

        function cambiar(){
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
        });

        $('#select_estado').change(function () {
            var clase = null;
            var estado = document.getElementById('select_estado');
            //document.f1.municipios_id[document.f1.municipios_id.selectedIndex].value
            var opcion = estado[estado.selectedIndex].value;
            if(opcion == 1){
                opcion = "Actualizar Producto";
                clase = "btn btn-block btn-primary";
            }else{
                opcion = "Guardar Borrador"
                clase = "btn btn-block btn-info";
            }
            $('#boton_publicar').attr('value', opcion).attr('class', clase)
        });

        document.addEventListener('DOMContentLoaded', function () {
            var clase = null;
            var estado = document.getElementById('select_estado');
            var opcion = estado[estado.selectedIndex].value;
            if(opcion == 1){
                opcion = "Actualizar Producto";
                clase = "btn btn-block btn-primary";
            }else{
                opcion = "Guardar Borrador"
                clase = "btn btn-block btn-info";
            }
            $('#boton_publicar').attr('value', opcion).attr('class', clase)
        });

        function guardarPrecio() {
            var enviar = document.getElementById('botonEnviarPrecio');
            var precio = document.getElementById('x_precio').value;
            var cant_inicio = document.getElementById('x_cant_inicio').value;
            var cant_final = document.getElementById('x_cant_final').value;
            var input_precio = document.getElementById('z_precio');
            var input_cant_inicio = document.getElementById('z_cant_inicio');
            var input_cant_final = document.getElementById('z_cant_final');
            //enviar.click();

            if (precio.length == 0 || cant_inicio.length == 0){

                Swal.fire({
                    //toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'No dejar campos vacios',
                    showConfirmButton: false,
                    timer: 1500
                })

            }else{
                input_precio.value = precio;
                input_cant_inicio.value = cant_inicio;
                if (cant_final.length != 0){
                    input_cant_final.value = cant_final;
                }
                enviar.click();
                //alert(precio);
            }




        }



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
            <div class="col-sm-4">
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

            </div>
        </div>

        {!! Form::open(['route' => ['productos.update', $producto->id], 'method' => 'PUT', 'files' => true, 'id' => 'form1']) !!}

        <div class="row justify-content-center">

                <div class="col-md-6">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Actualizar Producto</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-box"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                            </div>
                                            {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre del producto']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">SKU</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            {!! Form::text('sku', strtoupper($producto->sku), ['class' => 'form-control', 'placeholder' => 'Codigo unico del producto']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Categoria</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    {!! Form::select('categorias_id', $categorias , $producto->categorias_id , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione']) !!}
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Precio</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            {!! Form::number('precio', $producto->precio, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Inventario</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                            </div>
                                            {!! Form::number('cant_inventario', $producto->cant_inventario, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+"]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Poca existencia</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-level-down-alt"></i></span>
                                            </div>
                                            {!! Form::number('poca_existencia', $producto->poca_existencia, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                     'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Peso</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                            </div>
                                            {!! Form::number('peso', $producto->peso, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Und. Peso</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                                            </div>
                                            {!! Form::select('und_peso', undPeso() , $producto->und_peso , ['class' => 'custom-select']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Max. Carrito </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                                            </div>
                                            {!! Form::number('max_carrito', $producto->max_carrito, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($producto->venta_individual != 1)

                            @if (!$precios->isEmpty())
                                <hr class="bg-purple">
                                @foreach ($precios as $precio)

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Precio al Mayor</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    </div>
                                                    {!! Form::number('x_precio', $precio->precio, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                            'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01', 'readonly']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cant. Minima</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                                    </div>
                                                    {!! Form::number('x_cant_inicio', $precio->cant_inicio, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                            'min' => 0, 'pattern' => "^[0-9]+", 'readonly']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Cant. Maxima</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                    </div>
                                                    {!! Form::number('x_cant_final', $precio->cant_final, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                             'min' => 1, 'pattern' => "^[0-9]+", 'readonly']) !!}
                                                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="alertaBorrar(null, '{{ route('productos.precio_delete', [$producto->id, $precio->id]) }}')"><i class="fa fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif

                            <hr class="bg-purple">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Precio al Mayor</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            {!! Form::number('x_precio', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01', 'id' => 'x_precio']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Cant. Minima</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                            </div>
                                            {!! Form::number('x_cant_inicio', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'id' => 'x_cant_inicio']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Cant. Maxima</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                            </div>
                                            {!! Form::number('x_cant_final', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                     'min' => 1, 'pattern' => "^[0-9]+", 'id' => 'x_cant_final']) !!}
                                            <button type="button" class="btn btn-primary btn-sm ml-1" onclick="guardarPrecio()"><i class="fa fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif

                            <hr class="bg-purple">

                            <div class="form-group">
                                <label for="name">Vendido individualmente</label>
                                <div class="custom-control custom-checkbox">
                                    <input name="venta_individual" class="custom-control-input" type="checkbox" id="customCheckbox2" value="1"
                                    @if ($producto->venta_individual != 0)
                                        checked
                                    @endif
                                    >
                                    <label for="customCheckbox2" class="custom-control-label text-sm text-muted">
                                        Activa esto para permitir que solo se pueda comprar uno de estos artículos en cada pedido</label>
                                </div>
                            </div>

                            <hr class="bg-purple">

                            <div class="form-group">
                                <label for="name">Descripción corta del producto</label>
                                <textarea name="descripcion" class="textarea" placeholder="Place some text here"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $producto->descripcion }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Publicar</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Estado</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    </div>
                                    {!! Form::select('estado', estadoProducto() , $producto->estado , ['class' => 'custom-select', 'id' => 'select_estado', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">En Oferta <span class="text-xs text-danger">(descuento)</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="visibilidad" value="1" @if($producto->visibilidad) checked @endif class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"><i class="fas fa-dollar-sign"></i></label>
                                        </div>
                                        </span>
                                    </div>
                                    {{--{!! Form::select('visibilidad', visibilidadProducto() , 0 , ['class' => 'custom-select', 'required']) !!}
                                    --}}{!! Form::number('descuento', $producto->descuento, ['class' => 'form-control', 'placeholder' => 'Descuento',
                                                    'min' => 0, 'pattern' => "^[0-9]+", 'step' => '0.01']) !!}
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <input type="submit" id="boton_publicar" class="btn btn-block btn-info" value="Guardar Borrador">
                            </div>

                        </div>
                    </div>
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Imagen del Producto</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-image"></i></span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                {{--<label for="exampleInputEmail1">Imagen</label>--}}
                                <div class="attachment-block clearfix">
                                    @if (!is_null($producto->imagen) && file_exists('img/productos/'.$producto->file_path.'/'.$producto->imagen))
                                        @php($imagen = asset('img/productos/'.$producto->file_path.'/'.$producto->imagen))
                                    @else
                                        @php($imagen = asset('img/img-placeholder-320x320.png'))
                                    @endif
                                    <a href="{{ $imagen }}" data-fancybox data-caption="{{ strtoupper($producto->nombre) }}">
                                        <img id="blah" class="attachment-img" src="{{ $imagen }}" alt="Producto Imagen">
                                    </a><div class="attachment-pushed">
                                        <div class="attachment-text">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" name="imagen" class="custom-file-input" id="customFileLang" onchange='cambiar()' lang="es" accept="image/jpeg, image/png">
                                                    <label class="custom-file-label" for="customFileLang" data-browse="Elegir" id="info">Archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-purple">
                        <div class="card-header">
                            <h5 class="card-title">Galeria del Producto</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fa fa-images"></i></span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="producto_galeria">
                                <div class="tumbs">
                                    <a href="#" id="btn_galeria_imagen"><i class="fas fa-plus"></i></a>
                                    @foreach ($producto->galerias as $img)
                                        @if (!is_null($producto->imagen) && file_exists('img/productos_galeria/'.$img->file_path.'/'.$img->imagen))
                                            @php($imagen = asset('img/productos_galeria/'.$img->file_path.'/'.$img->imagen))
                                            @php($imagen_t = asset('img/productos_galeria/'.$img->file_path.'/t_'.$img->imagen))
                                        @else
                                            @php($imagen = asset('img/img-placeholder-320x320.png'))
                                            @php($imagen_t = asset('img/img-placeholder-320x320.png'))
                                        @endif

                                        <div class="tumb">
                                            <button type="button" onclick="alertaBorrar(null, '{{ route('productos.galeria_delete', [$producto->id, $img->id]) }}')" class="btn_delete_galeria"><i class="fa fa-trash"></i></button>
                                            {{--<a href="{{ route('productos.galeria_delete', [$producto->id, $img->id]) }}" class="btn_delete_galeria"><i class="fa fa-trash"></i></a>--}}
                                            <a href="{{ $imagen }}" data-fancybox data-caption="{{ strtoupper($img->nombre) }}">
                                                <img src="{{ $imagen_t }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


        </div>
        {!! Form::close() !!}

        {{-- Galeria de Imagenes--}}
        {!! Form::open(['route' => ['productos.galeria_add', $producto->id], 'method' => 'post', 'files' => true, 'id' => 'formGaleria']) !!}
            {!! Form::file('imagen', ['id' => 'galeria_imagen', 'accept' => 'image/jpeg, image/png', 'required']) !!}
        {!! Form::close() !!}

        {{--Precios al Mayor--}}
        {!! Form::open(['route' => ['productos.precio_add', $producto->id], 'method' => 'post', 'id' => 'formPrecio', 'class' => 'd-none']) !!}
            <input type="text" name="precio" value="" placeholder="precio" id="z_precio" required>
            <input type="text" name="cant_inicio" value="" placeholder="z_cant_inicio" id="z_cant_inicio" required>
            <input type="text" name="cant_final" value="" placeholder="z_cant_final" id="z_cant_final">
            <input type="submit" value="Enviar" id="botonEnviarPrecio">
        {!! Form::close() !!}

    </div>


@endsection
