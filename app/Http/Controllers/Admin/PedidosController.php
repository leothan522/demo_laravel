<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

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
        //
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


}
