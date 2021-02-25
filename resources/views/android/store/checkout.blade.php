@extends('layouts.android.master-ogani')

@section('content')
    <section>
        <div class="container">
            {{--<div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <div class="m-3">
                            <a href="javascript:history.back()" class="text-primary"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="checkout__order">
                        <h4>Pedido #{{ $pedido->id }}</h4>
                        <div class="checkout__order__products">Productos <span>Total</span></div>
                        <ul>
                            @foreach ($articulos as $articulo)
                            <li>{{ ucwords($articulo->productos->nombre) }} <small>({{ $articulo->cantidad }})</small> <span>${{ formatoMillares($articulo->precio_pedido * $articulo->cantidad) }}</span></li>
                            @endforeach
                        </ul>
                        <div class="checkout__order__subtotal">Subtotal <span>${{ formatoMillares($pedido->subtotal) }}</span></div>
                        <ul>
                            <li>Delivery <span>${{ formatoMillares($pedido->costo_delivery) }}</span></li>
                        </ul>
                        <div class="checkout__order__total">Total <span>${{ formatoMillares($pedido->total) }}</span></div>
                        {!! Form::open(['route' => ['android.checkout.store', $pedido->id], 'method' => 'post']) !!}

                        @if (!$cliente)


                        <div class="checkout__input__checkbox">
                            <label for="acc-or">
                                ¿Facturación?
                                {{--<input type="checkbox" id="acc-or">
                                <span class="checkmark"></span>--}}
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Cedula') }}</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>--}}
                                {!! Form::number('cedula', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>--}}
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Apellidos</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>--}}
                                {!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder' => 'Apellidos', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Teléfono</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>--}}
                                {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono', 'required'/*, 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask'*/]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Dirección de envio</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                --}}{!! Form::text('direccion_1', null, ['class' => 'form-control', 'placeholder' => 'Número de la casa y nombre de la calle', 'required']) !!}
                            </div>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                --}}{!! Form::text('direccion_2', null, ['class' => 'form-control', 'placeholder' => 'Apartamento, habitación, etc. (opcional)']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Localidad / Ciudad</label>
                            <div class="input-group mb-3">
                                {{--<div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                </div>--}}
                                {!! Form::text('localidad', null, ['class' => 'form-control', 'placeholder' => 'Sector / Urbanización / Barrio', 'required']) !!}
                            </div>
                        </div>

                            @else

                            <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    ¿Dirección de Envio?
                                    {{--<input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>--}}
                                </label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="direccion_principal" class="custom-control-input" id="customCheck4" checked value="SI" content="NO">
                                <label class="custom-control-label" for="customCheck4">
                                    Usar Direccion Principal
                                    <small><a href="#" class="text-primary" data-toggle="modal" data-target="#exampleModalCenter4">(Ver Dirección)</a></small>
                                </label>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1Title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenter1Title">Dirección Principal</h5>
                                            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>--}}
                                        </div>
                                        <div class="modal-body">

                                            <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-subtitle mb-2 text-muted">{{ strtoupper($cliente->direccion_1) }}</h5>
                                                        <h5 class="card-subtitle mb-2 text-muted">{{ strtoupper($cliente->direccion_2) }}</h5>
                                                        <h5 class="card-subtitle mb-2 text-muted">{{ strtoupper($cliente->localidad) }}</h5>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <p><input type="hidden" name="id_cliente" value="{{ $cliente->id }}"></p>

                            <div id="direccion_local">

                            </div>
                            <p></p>

                        @endif

                        <div class="checkout__input__checkbox">
                            <label for="acc-or">
                                ¿Metodo de Pago?
                                {{--<input type="checkbox" id="acc-or">
                                <span class="checkmark"></span>--}}
                            </label>
                        </div>

                        <p class="text-justify">Realiza tu pago directamente en nuestra cuenta bancaria. Por favor, usa el número del pedido
                            como referencia de pago. Tu pedido no se procesará hasta que se haya recibido el importe en
                            nuestra cuenta.</p>



                        @if ($pago_transferencia == "true")
                            <div class="input-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="mpago_transferencia" class="custom-control-input" id="customCheck1" {{--onclick="delivery()"--}} value="SI" content="NO">
                                    <label class="custom-control-label" for="customCheck1">
                                        Transferencia Directa
                                        <small><a href="#" class="text-primary" data-toggle="modal" data-target="#exampleModalCenter1">(Ver Cuentas)</a></small>
                                    </label>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenter1Title">Transferencia Directa</h5>
                                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>--}}
                                            </div>
                                            <div class="modal-body">

                                                @foreach ($cuentas as $cuenta)
                                                    @if ($cuenta->tipo == "PAGO_MOVIL")
                                                        @continue(true)
                                                    @endif
                                                <div class="card" {{--style="width: 18rem;"--}}>
                                                    <div class="card-body">
                                                        <h5 class="card-subtitle mb-2 text-muted"><b>Banco: </b>{{ $cuenta->banco }}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted"><b>Tipo: </b>{{ $cuenta->tipo }}</h6>
                                                        <h6 class="card-subtitle mb-2 text-muted"><b>Numero: </b>{{ str_replace('-', '', $cuenta->numero) }}</h6>
                                                        <h6 class="card-subtitle mb-2 text-muted"><b>Titular: </b>{{ $cuenta->titular }}</h6>
                                                        <h6 class="card-subtitle mb-2 text-muted"><b>RIF: </b>{{ $cuenta->rif_cedula }}</h6>
                                                    </div>
                                                </div>

                                                @endforeach

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div id="mpago_transferencia">

                            </div>
                        @endif
                        @if ($pago_movil == "true")
                            <div class="input-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="mpago_movil" class="custom-control-input" id="customCheck2" {{--onclick="delivery()"--}} value="SI" content="NO">
                                    <label class="custom-control-label" for="customCheck2">
                                        Pago Movil
                                        <small><a href="#" class="text-primary" data-toggle="modal" data-target="#exampleModalCenter">(Ver Detalles)</a></small>
                                    </label>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Pago Movil</h5>
                                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>--}}
                                            </div>
                                            <div class="modal-body">


                                                @foreach ($cuentas as $cuenta)
                                                    @if ($cuenta->tipo != "PAGO_MOVIL")
                                                        @continue(true)
                                                    @endif
                                                    <div class="card" {{--style="width: 18rem;"--}}>
                                                        <div class="card-body">
                                                            {{--<h5 class="card-title">{{ $cuenta->banco }}</h5>--}}
                                                            <h6 class="card-subtitle mb-2 text-muted">{{ $cuenta->banco }} {{ $cuenta->numero }} {{ $cuenta->rif_cedula }}</h6>
                                                        </div>
                                                    </div>

                                                @endforeach


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="mpago_movil">

                            </div>
                        @endif
                        @if ($pago_divisas == "true")
                            <div class="input-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="mpago_divisas" class="custom-control-input" id="customCheck3" {{--onclick="delivery()"--}} value="SI" content="NO">
                                    <label class="custom-control-label" for="customCheck3">
                                        Efectivo
                                        <small><a {{--class="text-primary"--}}>(Divisas)</a></small>
                                    </label>
                                </div>
                            </div>
                            <div id="mpago_divisas">

                            </div>
                        @endif
                        <p></p>
                        <div class="checkout__input__checkbox">
                            <label for="acc-or">
                                ¿Información Adicional?
                                {{--<input type="checkbox" id="acc-or">
                                <span class="checkmark"></span>--}}
                            </label>
                        </div>
                        <div class="input-group">
                            {!! Form::text('notas_cliente', null, ['class' => 'form-control', 'placeholder' => '(Opcional)']) !!}
                        </div>

                        @if ($pago_transferencia != "true" && $pago_movil != "true" && $pago_divisas != "true")
                            <p class="text-justify text-danger">En estos Momentos no tenemos un metodo de pago disponible para tu zona.</p>
                            <button type="submit" class="site-btn" disabled>REGISTRAR PAGO</button>
                            @else
                            <button type="submit" class="site-btn">REGISTRAR PAGO</button>
                        @endif
                        {{--<div class="checkout__input__checkbox">
                            <label for="paypal">
                                Paypal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>--}}


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var mpago_transferencia = document.getElementById('customCheck1');
        mpago_transferencia.addEventListener('change', function () {
            var div = document.getElementById('mpago_transferencia');
            if(this.checked) {
                var fieldHTML = '<div id="idRemover_transferencia" class="input-group justify-content-center">' +
                    '<div class="col-md-12">' +
                    '<?php echo (Form::select('cuenta_id_transferencia', $transferencias , 0 , ['class' => 'form-control', 'placeholder' => strtoupper('Seleccione Cuenta'), 'required']))?>' +
                    '</div><div class="col-md-12">' +
                    '<?php echo (Form::text('referencia_transferencia', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la referencia de la transferencia', 'required']))?>' +
                    '           </div></div>';
                div.innerHTML = fieldHTML;
            }else{
                var select = document.getElementById('idRemover_transferencia');
                var padre = select.parentNode;
                padre.removeChild(select);
            }
        });

        var mpago_movil = document.getElementById('customCheck2');
        mpago_movil.addEventListener('change', function () {
            var div = document.getElementById('mpago_movil');
            if(this.checked) {
                var fieldHTML = '<div id="idRemover_movil" class="input-group justify-content-center">' +
                    '<div class="col-md-12">' +
                    '<?php echo (Form::select('cuenta_id_movil', $movil , 0 , ['class' => 'form-control', 'placeholder' => strtoupper('Seleccione Cuenta'), 'required']))?>' +
                    '</div><div class="col-md-12">' +
                    '<?php echo (Form::text('referencia_movil', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la referencia del pago movil', 'required']))?>' +
                    '           </div></div>';
                div.innerHTML = fieldHTML;
            }else{
                var select = document.getElementById('idRemover_movil');
                var padre = select.parentNode;
                padre.removeChild(select);
            }
        });

        var direccion_local = document.getElementById('customCheck4');
        direccion_local.addEventListener('change', function () {
            var div = document.getElementById('direccion_local');
            if(!this.checked) {
                var fieldHTML = '<div id="idRemover_direccion">' +
                    '<div class="form-group">' +
                    '<label for="email">Dirección de envio</label>' +
                    '<div class="input-group mb-3">' +
                    '<?php echo (Form::text('direccion_1', null, ['class' => 'form-control', 'placeholder' => 'Número de la casa y nombre de la calle', 'required']))?>' +
                    '</div>' +
                    '<div class="input-group mb-3">' +
                    '<?php echo (Form::text('direccion_2', null, ['class' => 'form-control', 'placeholder' => 'Apartamento, habitación, etc. (opcional)']))?>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="exampleInputEmail1">Localidad / Ciudad</label>' +
                    '<div class="input-group mb-3">' +
                    '<?php echo (Form::text('localidad', null, ['class' => 'form-control', 'placeholder' => 'Sector / Urbanización / Barrio', 'required']))?>' +
                    '           </div></div>';
                div.innerHTML = fieldHTML;
            }else{
                var select = document.getElementById('idRemover_direccion');
                var padre = select.parentNode;
                padre.removeChild(select);
            }
        });


    </script>
@endsection

