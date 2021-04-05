<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido: #{{ $pedido->id }}</title>
</head>
<body>
<style>
    /*css*/
</style>

<h4>
    Pedido #{{ $pedido->id }}
    <small class="pull-right text-info badge">(En Espera)</small>
</h4>
<div class="checkout__order__products">Productos {{--<span>Total</span>--}}</div>
<ul>
    @foreach ($articulos as $articulo)
        <li>{{ ucwords($articulo->productos->nombre) }} <small>({{ $articulo->cantidad }})</small> <span>${{ formatoMillares($articulo->precio_pedido * $articulo->cantidad) }}</span></li>
    @endforeach
</ul>
<div class="checkout__order__subtotal">Subtotal <span>${{ formatoMillares($pedido->subtotal) }}</span></div>
@if ($pedido->delivery == "SI")
    <ul>
        <li>Delivery <span>${{ formatoMillares($pedido->costo_delivery) }}</span></li>
    </ul>
@endif
<div class="checkout__order__total">Total <span>${{ formatoMillares($pedido->total) }}</span></div>

<p class="text-justify">
    <b>Fecha: </b> {{ $pedido->fecha }} <br>
    <b>Cedula: </b> {{ $pedido->cedula }} <br>
    <b>Nombre: </b> {{ strtoupper($pedido->nombre) }} {{ strtoupper($pedido->apellidos) }} <br>
    <b>Telefono: </b> {{ $pedido->telefono }} <br>
</p>

@if ($pedido->delivery == "SI")
    <div class="checkout__input__checkbox">
        <label for="acc-or">
            Dirección de envio
        </label>
    </div>

    <p class="text-justify">
        {{ strtoupper($pedido->direccion_1) }} <br>
        {{ strtoupper($pedido->direccion_2) }} <br>
        {{ strtoupper($pedido->localidad) }} <br>
    </p>
@endif

<div class="checkout__input__checkbox">
    <label for="acc-or">
        Medoto de Pago
        {{-- <input type="checkbox" id="acc-or">
         <span class="checkmark"></span>--}}
    </label>
</div>
@foreach ($pagos as $pago)
    @if (!$pago->cuentas_id)
        <p class="text-justify">
            <b>EFECTIVO</b><br>
        </p>
    @else
        <p class="text-justify">
            <b>{{ $pago->metodo }}</b> <br>
            <b>Banco: </b> {{ $pago->banco }} <br>
            <b>Referencia: </b> {{ $pago->referencia }} <br>
        </p>
    @endif

@endforeach
@if ($pedido->nota_cliente)

    <div class="checkout__input__checkbox">
        <label for="acc-or">
            Información Adicional
            {{--<input type="checkbox" id="acc-or">
            <span class="checkmark"></span>--}}
        </label>
    </div>
    <p class="text-justify">
        {{ strtoupper($pedido->nota_cliente) }}
    </p>
@endif



</body>
</html>

