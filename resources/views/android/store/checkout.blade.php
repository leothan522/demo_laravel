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
                        <div class="checkout__input__checkbox">
                            <label for="payment">
                                Check Payment
                                <input type="checkbox" id="payment">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="paypal">
                                Paypal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn">REGISTRAR PAGO</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
