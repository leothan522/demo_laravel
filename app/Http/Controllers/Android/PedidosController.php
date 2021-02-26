<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Movimiento;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $pedidos = Pedido::where('users_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('android.pedidos.index')
            ->with('pedidos', $pedidos)
            ->with('i', 0);
    }

    public function show($id, $id_pedido)
    {
        $pedido = Pedido::find($id_pedido);
        $articulos = Articulo::where('pedidos_id', $pedido->id)->get();
        $cliente = Cliente::where('users_id', Auth::user()->id)->first();
        $pagos = Movimiento::where('pedidos_id', $pedido->id)->get();
        $pagos->each(function ($pago){
            if ($pago->cuentas_id != 0) {
                $cuenta = Cuenta::find($pago->cuentas_id);
                if ($cuenta->tipo != "PAGO_MOVIL") {
                    $pago->metodo = "TRANSFERENCIA";
                } else {
                    $pago->metodo = "PAGO MOVIL";
                }
                $pago->banco = $cuenta->banco;
            }
        });


        return view('android.pedidos.show')
            ->with('pedido', $pedido)
            ->with('articulos', $articulos)
            ->with('cliente', $cliente)
            ->with('pagos', $pagos);
    }

}
