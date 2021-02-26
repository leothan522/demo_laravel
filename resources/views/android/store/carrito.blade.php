@extends('layouts.android.master-ogani')

@section('content')
    <!-- Shoping Cart Section Begin -->
    @if (!$carrito->isEmpty())

    <section class="mt-3">
        <div class="container">
{{--            abrir --}}
            {!! Form::open(['route' => ['android.carrito.checkout', Auth::user()->id], 'method' => 'post', 'name' => 'f1']) !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Productos</th>
                                {{--<th>Price</th>--}}
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--<tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-1.jpg') }}" alt="">
                                    <h5>Vegetable’s Package</h5>
                                    $55.00
                                </td>
                                --}}{{--<td class="shoping__cart__price">
                                    $55.00
                                </td>--}}{{--
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $110.00
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-2.jpg') }}" alt="">
                                    <h5>Fresh Garden Vegetable</h5>
                                    $39.00
                                </td>
                                --}}{{--<td class="shoping__cart__price">
                                    $39.00
                                </td>--}}{{--
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $39.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>--}}
                            @php($total = 0)
                            @foreach ($carrito as $parametro)
                                @php($i++)
                                <tr class="remover_{{ $parametro->valor }}">
                                    <td class="{{--shoping__cart__item--}}">
                                        <img src="{{ asset('img/productos/'.$parametro->file_path.'/t_'.$parametro->imagen) }}" class="img-thumbnail" alt="">
                                        <span>{{ ucwords($parametro->nombre_producto) }}</span>
                                        <span style="font-size: 18px; color: #1c1c1c; font-weight: 700;">${{ formatoMillares($parametro->precio) }}</span>
                                        <input type="hidden" name="id_producto_{{ $i }}" value="{{ $parametro->valor }}">
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" name="cantidad_{{ $i }}" id="{{ $parametro->valor }}" value="{{ $parametro->cantidad }}" content="{{ $parametro->precio }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $<span id="mostrar_precio_{{ $parametro->valor }}">{{ formatoMillares($parametro->subtotal) }}</span>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="#" id="remover_{{ $parametro->valor }}" content="{{ $parametro->valor }}"
                                           class="btn_remover {{--@if ($producto->carrito) fondo-favoritos @endif--}}">
                                            <span class="icon_close"></span>
                                        </a>
                                    </td>
                                </tr>
                                @php($total = $total + $parametro->subtotal)
                            @endforeach
                            {{--<tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-3.jpg') }}" class="img-thumbnail" alt="">
                                    <span>Organic Bananas</span>
                                    <span style="font-size: 18px; color: #1c1c1c; font-weight: 700;">$699.00</span>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $699.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="#"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="--}}{{--shoping__cart__item--}}{{--">
                                    <img src="{{ asset('ogani/img/cart/cart-3.jpg') }}" class="img-thumbnail" alt="">
                                    <span>Organic Bananas</span>
                                    <span style="font-size: 18px; color: #1c1c1c; font-weight: 700;">$699.00</span>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" content="5">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    $699.99
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="#"><span class="icon_close"></span></a>
                                </td>
                            </tr>--}}
                            </tbody>
                        </table>
                        <input type="hidden" name="total_item" value="{{ $i }}">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" {{--onclick="delivery()"--}} value="SI" content="NO">
                        <label class="custom-control-label" for="customCheck1">Incluir Delivery</label>
                    </div>
                    <div id="select_delivery">

                    </div>
                    {{--{!! Form::select('delivery', $zonas , 0 , ['id'=> 'select_delivery', 'class' => 'd-none', 'placeholder' => strtoupper('Seleccione la zona para el envio'), 'required']) !!}
                    --}}    {{--<a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>--}}
                </div>
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <ul>
                            <li>Delivery {{--<i class="fa fa-dollar"></i>--}} <span id="mostrarCostoD">-</span></li>
                        </ul>
                        <h5>Total</h5>
                        <ul>
                            <li><i class="fa fa-dollar"></i> <span id="total_dolar" content="{{ $total }}">${{ formatoMillares($total) }}</span></li>
                            <li>Bs. <span id="total_bs" content="{{ $dolarPrecio }}">{{ precioBolivares($total) }}</span></li>
                        </ul>
                        <input type="hidden" id="envioCosto" name="paraControl" value="hola" content="hola">
                        <input id="totalPedido" type="hidden" name="total" value="{{ $total }}">
                        <input type="submit" class="primary-btn btn-block" value="FINALIZAR COMPRA">
                        {{--<a href="{{ route('android.shop_checkout') }}" class="primary-btn">REALIZAR PEDIDO</a>--}}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        {{-- cerrar --}}
        </div>
    </section>
    <br/>
    <!-- Shoping Cart Section End -->
    @else
        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__search">
                            {{--<div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>{{ $telefono_numero }}</h5>
                                    <span>{{ $telefono_texto }}</span>
                                </div>
                            </div>--}}
                        </div>
                        <div class="hero__item set-bg" data-setbg="{{ asset('img/banner_2.png') }}">
                            <div class="hero__text">
                                <span>#TELOCOMPRO</span>
                                <h2>{{--Frase <br/>Publicitaria--}}</h2>
                                <p>¡Tu carrito esta vacio!</p>
                                <a href="{{ route('android.store.index', Auth::user()->id) }}" id="btn_statusHours" class="btn btn-info">
                                    <strong style="color: white;">{{--<i class="icon fa fa-exclamation-circle"></i>--}} Ir a Store</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    @endif

@endsection

@section('nice-select')
    <script src="{{ asset('ogani/js/jquery.nice-select.min.js') }}"></script>
@endsection

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn_remover").click(function(e){
            e.preventDefault();
            Swal.fire({
                toast: true,
                //title: 'Cargando...',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var span = document.getElementById('total_dolar');
            var span_bs = document.getElementById('total_bs');
            var total_actual = span.getAttribute('content');
            var producto = this.getAttribute('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.remover') }}",
                data: {id_producto:producto, total:total_actual},
                success: function (data) {
                    if(data.content === 0){
                        window.location = "{{ route('android.carrito', Auth::user()->id) }}";
                    }else{

                        Swal.fire({
                            //toast: true,
                            icon: data.type,
                            title: data.title,
                            //text: data.message,
                            html: data.message,
                            //showConfirmButton: false,
                            //confirmButtonColor: '#3085d6',
                        });
                        span.setAttribute('content', data.content);
                        $(span).html('$' + data.total);
                        $(span_bs).html(data.bs);
                        var oferta = document.getElementsByClassName(data.clase);
                        if (oferta) {
                            for (var i = 0; i < oferta.length; i++) {
                                //oferta[i].classList.add('fondo-favoritos');
                                oferta[i].remove();
                            }
                        }
                        //window.location = "{{ route('android.carrito', Auth::user()->id) }}"
                        //document.getElementById(data.id).classList.add('fondo-favoritos');
                    }

                }
            });
        });

        var checkbox = document.getElementById('customCheck1');
        checkbox.addEventListener('change', function () {
            var div = document.getElementById('select_delivery');
            if(this.checked) {
                var fieldHTML = '<div id="idRemover" class="input-group justify-content-center">' +
                    '<?php echo (Form::select('delivery', $zonas , 0 , ['id' => 'select_zona', 'onchange' => 'montoZona()', 'class' => 'form-control', 'placeholder' => strtoupper('Seleccione la zona para el envio'), 'required']))?>' +
                    '           </div>';
                div.innerHTML = fieldHTML;
            }else{

                var envio = document.getElementById('envioCosto');
                var mostrarEnvio = document.getElementById('mostrarCostoD');
                var costoActual;
                if (envio.getAttribute('value') === "hola"){
                    costoActual = 0;
                }else {
                    costoActual = parseFloat(envio.getAttribute('value'));
                }

                //imput totalpedido
                var totalPedido = document.getElementById('totalPedido');

                if (true /*precio != ""*/) {
                    var totalDollar = document.getElementById('total_dolar');
                    var dolarPrecio = document.getElementById('total_bs');
                    const formatterEuro = new Intl.NumberFormat('de-DE', {
                        //style: 'currency',
                        //currency: 'EUR'
                        minimumFractionDigits: 2
                    });
                    envio.setAttribute('value', "hola");
                    mostrarEnvio.innerHTML = "-";
                    var actual = parseFloat(totalDollar.getAttribute('content')) - parseFloat(costoActual);
                    var nuevoTotal = parseFloat(actual);
                    totalDollar.setAttribute('content', parseFloat(nuevoTotal));
                    totalDollar.innerHTML = formatterEuro.format(nuevoTotal);
                    totalPedido.setAttribute('value', nuevoTotal.toFixed(2));
                    var totalBs = parseFloat(dolarPrecio.getAttribute('content')) * nuevoTotal;
                    dolarPrecio.innerHTML = formatterEuro.format(totalBs);
                }

                var select = document.getElementById('idRemover');
                var padre = select.parentNode;
                padre.removeChild(select);
            }
        });

        function montoZona() {
            //tomo el valor del select elegido
            var precio;
            precio = document.f1.select_zona[document.f1.select_zona.selectedIndex].value;

            //para trabajar on el costo de envio
            var envio = document.getElementById('envioCosto');
            var mostrarEnvio = document.getElementById('mostrarCostoD');
            var costoActual;
            if (envio.getAttribute('value') === "hola"){
                costoActual = 0;
            }else {
                costoActual = parseFloat(envio.getAttribute('value'));
            }

            //imput totalpedido
            var totalPedido = document.getElementById('totalPedido');

            if (true /*precio != ""*/) {
                if (precio === ""){ precio = 0; }
                var totalDollar = document.getElementById('total_dolar');
                var dolarPrecio = document.getElementById('total_bs');
                const formatterEuro = new Intl.NumberFormat('de-DE', {
                    //style: 'currency',
                    //currency: 'EUR'
                    minimumFractionDigits: 2
                });
                envio.setAttribute('value', precio);
                mostrarEnvio.innerHTML = formatterEuro.format(precio);
                var actual = parseFloat(totalDollar.getAttribute('content')) - parseFloat(costoActual);
                var nuevoTotal = parseFloat(actual) + parseFloat(precio);
                totalDollar.setAttribute('content', parseFloat(nuevoTotal));
                totalDollar.innerHTML = formatterEuro.format(nuevoTotal);
                totalPedido.setAttribute('value', nuevoTotal.toFixed(2));
                var totalBs = parseFloat(dolarPrecio.getAttribute('content')) * nuevoTotal;
                dolarPrecio.innerHTML = formatterEuro.format(totalBs);
            }
        }

    </script>
@endsection
