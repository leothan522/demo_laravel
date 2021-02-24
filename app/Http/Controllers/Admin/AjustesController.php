<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use App\Models\Parametro;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjustesController extends Controller
{
    public function index()
    {
        $vacio = (object) array('valor' => null, 'updated_at' => null, 'id' => null);
        $dolar = Parametro::where('nombre', 'precio_dolar')->first();
        if (!$dolar){ $dolar = $vacio; }
        $telefono_numero = Parametro::where('nombre', 'telefono_numero')->first();
        if (!$telefono_numero){  $telefono_numero = $vacio; }
        $telefono_texto = Parametro::where('nombre', 'telefono_texto')->first();
        if (!$telefono_texto){  $telefono_texto = $vacio; }

        $zonas = Zona::all();
        $cuentas = Cuenta::all();

        $pago_divisas = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 1)->first();
        if ($pago_divisas){ $valor_divisas = $pago_divisas->valor; }else{ $valor_divisas = false; }
        $pago_transferencias = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 2)->first();
        if ($pago_transferencias){ $valor_transferencia = $pago_transferencias->valor; }else{ $valor_transferencia = false; }
        $pago_movil = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 3)->first();
        if ($pago_movil){ $valor_movil = $pago_movil->valor; }else{ $valor_movil = false; }


        return view('admin.ajustes.index')
            ->with('dolar', $dolar)
            ->with('telefono_numero', $telefono_numero)
            ->with('telefono_texto', $telefono_texto)
            ->with('zonas', $zonas)
            ->with('cuentas', $cuentas)
            ->with('pago_divisas', $valor_divisas)
            ->with('pago_transferencia', $valor_transferencia)
            ->with('pago_movil', $valor_movil)
            ->with('i', 1);

    }

    public function store(Request $request)
    {
        $alert = false;
        //dd($request->id_dolar);
        if ($request->id_dolar){
            $this->parametros('precio_dolar', $request->precio_dolar, Auth::user()->id);
            $alert = true;
        }

        if ($request->id_telefono){
            $this->parametros('telefono_numero', $request->telefono_numero);
            $this->parametros('telefono_texto', $request->telefono_texto);
            $alert = true;
        }

        if ($alert){
            verSweetAlert2('Ajustes guardados correctamente', 'toast');
        }else{
            verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
        }
        return back();
    }

    public function parametros($nombre, $valor, $tabla_id = null)
    {
        $existe = Parametro::where('nombre', $nombre)->first();

        if ($existe){
            $parametros = Parametro::find($existe->id);
            $parametros->nombre = $nombre;
            $parametros->valor = $valor;
            $parametros->tabla_id = $tabla_id;
            $parametros->update();
        }else{
            $parametros = new Parametro();
            $parametros->nombre = $nombre;
            $parametros->valor = $valor;
            $parametros->tabla_id = $tabla_id;
            $parametros->save();
        }

    }

    public function zonas(Request $request)
    {
        //dd($request->all());
        $zona = new Zona($request->all());
        $zona->precio_delivery = $request->precio_delivery;
        $zona->save();
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

    public function zonasUpdate(Request $request, $id)
    {
        $zona = Zona::find($id);
        $zona->nombre = $request->nombre;
        $zona->precio_delivery = $request->precio_delivery;
        $zona->update();
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

    public function zonaDelete($id)
    {
        $zona = Zona::find($id);
        $zona->delete();
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

    public function metodosPago(Request $request)
    {
        $cuenta = new Cuenta();
        $cuenta->banco = strtoupper($request->banco);
        $cuenta->tipo = strtoupper($request->tipo);
        $cuenta->numero = $request->numero;
        $cuenta->titular = strtoupper($request->titular);
        $cuenta->rif_cedula = strtoupper($request->rif_cedula);
        $cuenta->save();
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

    public function metodosPagoUpdate(Request $request, $id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->banco = strtoupper($request->banco);
        $cuenta->tipo = strtoupper($request->tipo);
        $cuenta->numero = $request->numero;
        $cuenta->titular = strtoupper($request->titular);
        $cuenta->rif_cedula = strtoupper($request->rif_cedula);
        $cuenta->Update();
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

    public function metodosPagoDestroy($id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->delete();
        verSweetAlert2('Ajustes guardados correctamente', 'toast');
        return back();
    }

    public function ajaxMetodos(Request $request)
    {
        $nombre = $request->nombre;
        $valor = $request->valor;
        $metodoPago = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', $nombre)->first();
        if (!$metodoPago) {
            $parametros = new Parametro();
            $parametros->nombre = "metodo_pago";
            $parametros->tabla_id = $nombre;
            $parametros->valor = $valor;
            $parametros->save();
            $json = ['valor' => true];
        } else {
            $json = ['valor' => false];
            $metodoPago->valor = $valor;
            $metodoPago->update();
        }
        return response()->json($json);
    }

}
