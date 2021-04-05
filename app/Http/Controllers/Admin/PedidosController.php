<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Movimiento;
use App\Models\Pedido;
use App\Models\Producto;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::buscar($request->buscar)->orderBy('created_at', 'DESC')->paginate(30);
        $todos = Pedido::count();
        $pendiente_pago = Pedido::where('estatus', 0)->count();
        $en_espera = Pedido::where('estatus', 1)->count();
        $procesando = Pedido::where('estatus', 2)->count();
        $completado = Pedido::where('estatus', 3)->count();
        $cancelado = Pedido::where('estatus', 4)->count();
        $ver = 100;
        return view('admin.pedidos.index')
            ->with('pedidos', $pedidos)
            ->with('todos', $todos)
            ->with('pendiente_pago', $pendiente_pago)
            ->with('en_espera', $en_espera)
            ->with('procesando', $procesando)
            ->with('completado', $completado)
            ->with('cancelado', $cancelado)
            ->with('ver', $ver);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);
        return view('admin.pedidos.show')
            ->with('pedido', $pedido);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ver($estatus)
    {
        $pedidos = Pedido::where('estatus', $estatus)->orderBy('created_at', 'DESC')->paginate(30);
        $todos = Pedido::count();
        $pendiente_pago = Pedido::where('estatus', 0)->count();
        $en_espera = Pedido::where('estatus', 1)->count();
        $procesando = Pedido::where('estatus', 2)->count();
        $completado = Pedido::where('estatus', 3)->count();
        $cancelado = Pedido::where('estatus', 4)->count();
        $ver = $estatus;
        return view('admin.pedidos.index')
            ->with('pedidos', $pedidos)
            ->with('todos', $todos)
            ->with('pendiente_pago', $pendiente_pago)
            ->with('en_espera', $en_espera)
            ->with('procesando', $procesando)
            ->with('completado', $completado)
            ->with('cancelado', $cancelado)
            ->with('ver', $ver);
    }

    public function accionesLote(Request $request)
    {
        $total = count($request->all());
        $num = $request->total;
        if ($total <= 3) {
            verSweetAlert2('Ningun pedido fue seleccionado.', 'toast', 'warning');
            return back();
        }
        for ($i = 1; $i <= $num; $i++) {
            $id = $request->input('pedidos_id_' . $i);
            $pedido = Pedido::where('id', $id)->first();
            if ($pedido) {
                if ($request->accion != 100) {
                    $pedido->estatus = $request->accion;
                    $pedido->update();
                } else {
                    //$id_categoria = $pedido->categorias_id;
                    $pedido->delete();
                    /*$categoria = Categoria::find($id_categoria);
                    $categoria->num_pedidos = $categoria->num_pedidos - 1;
                    $categoria->update();*/
                }
            }
        }
        if ($request->accion != 100) {
            verSweetAlert2('Pedidos actualizados correctamente.');
        } else {
            verSweetAlert2('Pedidos borrados correctamente.', 'iconHtml', 'error');
        }
        return back();
    }

    public function filtrar(Request $request)
    {
        $fecha = $request->fecha_filtrar;
        $cliente = $request->cliente_filtrar;
        $delivery = $request->delivery_filtrar;

        //campos vacios todos
        if ($fecha == null && $cliente == null && $delivery == null){
            return redirect()->route('pedidos.index');
        }
        //***************

        //buscar un solo valor
        if ($fecha != null && $cliente == null && $delivery == null){
            $pedidos = Pedido::where('fecha', $fecha)->orderBy('created_at', 'DESC')->paginate(30);
        }

        if ($fecha == null && $cliente != null && $delivery == null){
            $pedidos = Pedido::where('nombre', 'LIKE', "%$cliente%")->orderBy('created_at', 'DESC')->paginate(30);
        }

        if ($fecha == null && $cliente == null && $delivery != null){
            $pedidos = Pedido::where('delivery', $delivery)->orderBy('created_at', 'DESC')->paginate(30);
        }
        //***********************

        //buscar dos valores
        if ($fecha != null && $cliente != null && $delivery == null){
            $pedidos = Pedido::where('fecha', $fecha)->where('nombre', 'LIKE', "%$cliente%")->orderBy('created_at', 'DESC')->paginate(30);
        }
        if ($fecha != null && $cliente == null && $delivery != null){
            $pedidos = Pedido::where('fecha', $fecha)->where('delivery', $delivery)->orderBy('created_at', 'DESC')->paginate(30);
        }
        if ($fecha == null && $cliente != null && $delivery != null){
            $pedidos = Pedido::where('nombre', 'LIKE', "%$cliente%")->where('delivery', $delivery)->orderBy('created_at', 'DESC')->paginate(30);
        }
        //************************

        //buscar tres valores
        if ($fecha != null && $cliente != null && $delivery != null){
            $pedidos = Pedido::where('fecha', $fecha)->where('nombre', 'LIKE', "%$cliente%")->where('delivery', $delivery)->orderBy('created_at', 'DESC')->paginate(30);
        }

        $todos = Pedido::count();
        $pendiente_pago = Pedido::where('estatus', 0)->count();
        $en_espera = Pedido::where('estatus', 1)->count();
        $procesando = Pedido::where('estatus', 2)->count();
        $completado = Pedido::where('estatus', 3)->count();
        $cancelado = Pedido::where('estatus', 4)->count();
        $ver = 99;
        return view('admin.pedidos.index')
            ->with('pedidos', $pedidos)
            ->with('todos', $todos)
            ->with('pendiente_pago', $pendiente_pago)
            ->with('en_espera', $en_espera)
            ->with('procesando', $procesando)
            ->with('completado', $completado)
            ->with('cancelado', $cancelado)
            ->with('filtro', $pedidos->count())
            ->with('ver', $ver);
    }

    public function generarPDF($id)
    {
        $pedido = Pedido::find($id);
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
        $data = [
          'pedido' => $pedido,
          'articulos' => $articulos,
          'pagos'   => $pagos
        ];
        $pdf = \PDF::loadView('admin.pedidos.pdf_pedido', $data);
        return $pdf->download("Pedido_Nro_$pedido->id.pdf");
    }


}
