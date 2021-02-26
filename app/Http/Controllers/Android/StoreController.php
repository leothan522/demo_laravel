<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Galeria;
use App\Models\Movimiento;
use App\Models\Parametro;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $exite = Parametro::where('nombre', 'telefono_numero')->first();
        if ($exite) {
            $telefono_numero = $exite->valor;
        } else {
            $telefono_numero = "(0424) 338.66.00";
        }
        $exite = Parametro::where('nombre', 'telefono_texto')->first();
        if ($exite) {
            $telefono_texto = $exite->valor;
        } else {
            $telefono_texto = "support 24/7 time";
        }

        $categorias = Categoria::orderBy('num_productos', 'DESC')->get();
        $ultimos_productos = Producto::where('estado', 1)->where('precio', '>', 0)->orderBy('updated_at', 'DESC')->paginate(6);
        $productos = Producto::where('estado', 1)->where('precio', '>', 0)->orderBy('cant_ventas', 'DESC')->paginate(12);
        $productos->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        return view('android.store.index')
            ->with('telefono_numero', $telefono_numero)
            ->with('telefono_texto', $telefono_texto)
            ->with('categorias', $categorias)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('productos', $productos)
            ->with('i', 1);
    }

    public function categorias($id, $categoria, $store = null)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $ultimos_productos = Producto::where('categorias_id', $categoria)->where('precio', '>', 0)->orderBy('updated_at', 'DESC')->paginate(6);
        $en_oferta = Producto::where('visibilidad', 1)->where('precio', '>', 0)->where('estado', 1)->where('cant_inventario', '>', 0)->orderBy('updated_at', 'DESC')->get();
        $en_oferta->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        $productos = Producto::where('categorias_id', $categoria)->where('precio', '>', 0)->get();
        $productos->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        $total = $productos->count();
        return view('android.store.categorias')
            ->with('store', $store)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('en_oferta', $en_oferta)
            ->with('productos', $productos)
            ->with('total', $total)
            ->with('i', 1);
    }

    public function detalles($id, $producto)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $detalle = Producto::findOrFail($producto);
        if (!$detalle->estado || $detalle->precio <= 0) {
            return back();
        }

        $detalle->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $detalle->id)->first();
        $galeria = Galeria::where('productos_id', $producto)->get();
        $relacionados = Producto::where('categorias_id', $detalle->categorias_id)->where('id', '!=', $detalle->id)->where('precio', '>', 0)->paginate(4);
        $relacionados->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });
        return view('android.store.detalles')
            ->with('producto', $detalle)
            ->with('galeria', $galeria)
            ->with('relacionados', $relacionados);
    }

    public function ajaxFavoritos(Request $request)
    {
        $id_usuario = Auth::user()->id;
        $id_producto = $request->id_producto;
        $favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', $id_usuario)->where('valor', $id_producto)->first();
        if (!$favoritos) {
            $parametros = new Parametro();
            $parametros->nombre = "favoritos";
            $parametros->tabla_id = $id_usuario;
            $parametros->valor = $id_producto;
            $parametros->save();
            $json = ['type' => 'success', 'message' => 'Agregado a tus favoritos.', 'id' => "favoritos_$id_producto", 'clase' => "favoritos_$id_producto"];
        } else {
            $favoritos->delete();
            $json = ['type' => 'error', 'message' => 'Eliminado de tus favoritos', 'id' => "favoritos_$id_producto", 'clase' => "favoritos_$id_producto"];
        }
        return response()->json($json);
    }

    public function favoritos($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->get();
        $favoritos->each(function ($parametro) {
            $producto = Producto::find($parametro->valor);
            $parametro->precio = $producto->precio;
            $parametro->estado = $producto->estado;
            $parametro->cant_inventario = $producto->cant_inventario;
            $parametro->visibilidad = $producto->visibilidad;
            $parametro->descuento = $producto->descuento;
            $parametro->file_path = $producto->file_path;
            $parametro->imagen = $producto->imagen;
            $parametro->nombre_producto = $producto->nombre;
        });
        return view('android.store.favoritos')
            ->with('favoritos', $favoritos)
            ->with('i', 1);
    }

    public function carrito($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        $dolar = Parametro::where('nombre', 'precio_dolar')->first();
        $carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->get();
        $agrupados = $carrito->groupBy('valor');
        $agrupados->each(function ($parametro) {
            $i = 0;

            foreach ($parametro as $producto) {
                $i++;
                $parametro->valor = $producto->valor;
                $producto = Producto::find($parametro->valor);
                $parametro->precio = $producto->precio;
                $parametro->estado = $producto->estado;
                $parametro->cant_inventario = $producto->cant_inventario;
                $parametro->visibilidad = $producto->visibilidad;
                $parametro->descuento = $producto->descuento;
                $parametro->file_path = $producto->file_path;
                $parametro->imagen = $producto->imagen;
                $parametro->nombre_producto = $producto->nombre;
                //$parametro->i = $i;
                break;
            }
            $parametro->cantidad = $parametro->count();
            $parametro->subtotal = $parametro->cantidad * $parametro->precio;
        });

        //dd($agrupados->all());
        /*$carrito->each(function ($parametro){
            $producto = Producto::find($parametro->valor);
            $parametro->precio = $producto->precio;
            $parametro->estado = $producto->estado;
            $parametro->cant_inventario = $producto->cant_inventario;
            $parametro->visibilidad = $producto->visibilidad;
            $parametro->descuento = $producto->descuento;
            $parametro->file_path = $producto->file_path;
            $parametro->imagen = $producto->imagen;
            $parametro->nombre_producto = $producto->nombre;
        });*/

        $zonas = Zona::orderBy('nombre', 'ASC')->pluck('nombre', 'precio_delivery');

        return view('android.store.carrito')
            ->with('carrito', $agrupados)
            ->with('dolarPrecio', $dolar->valor)
            ->with('zonas', $zonas)
            ->with('i', 0);
    }

    public function ajaxCarrito(Request $request)
    {
        $json = array();
        $id_usuario = Auth::user()->id;
        $producto = Producto::find($request->id_producto);
        $id_producto = $producto->id;
        $venta_individual = $producto->venta_individual;
        $max = $producto->max_carrito;
        $inventario = $producto->cant_inventario;
        $estado = $producto->estado;
        $precio = $producto->precio;
        $carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', $id_usuario)->where('valor', $id_producto)->count();
        $json = ['type' => 'success', 'title' => '¡Agregado!', 'message' => '', 'id' => "carrito_$id_producto", 'clase' => "carrito_$id_producto"];
        $parametro = new Parametro();
        $parametro->nombre = "carrito";
        $parametro->tabla_id = $id_usuario;
        $parametro->valor = $id_producto;

        if ($inventario && $estado && $precio > 0) {


            if (!$carrito) {
                $parametro->save();
                $carrito++;
                $json['message'] = "Tienes  en el carrito:<br/><strong>" . cerosIzquierda($carrito) . "</strong> " . ucwords($producto->nombre);
            } else {
                if ($venta_individual) {
                    $json['type'] = "error";
                    $json['title'] = "Venta Individual";
                    $json['message'] = "Solo puedes agregar uno al carrito";
                } else {
                    if (($carrito < $max || !$max) && $carrito < $inventario) {
                        $parametro->save();
                        $carrito++;
                        $json['message'] = "Tienes  en el carrito:<br/><strong>" . cerosIzquierda($carrito) . "</strong> " . ucwords($producto->nombre);
                    } else {
                        if ($carrito == $inventario) {
                            $max = $inventario;
                        }
                        $json['type'] = "error";
                        $json['title'] = "Maximo alcanzado";
                        $json['message'] = "Solo puedes agregar <strong>" . cerosIzquierda($max) . "</strong> al carrito";
                    }
                }
            }


        } else {
            $json['type'] = "error";
            $json['title'] = "Producto agotado";
            $json['message'] = "";
        }

        return response()->json($json);
    }

    public function ajaxRemover(Request $request)
    {
        $json = array();
        $id_usuario = Auth::user()->id;
        $id_producto = $request->id_producto;
        $total_actual = $request->total;
        $json = ['type' => 'success', 'title' => '¡Removido!', 'message' => '', 'id' => "remover_$id_producto", 'clase' => "remover_$id_producto"];

        $producto = Producto::find($id_producto);
        $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id_usuario)->where('valor', $id_producto)->get();
        $cantidad = $parametros->count();
        $descontar = $cantidad * $producto->precio;
        foreach ($parametros as $parametro) {
            $parametro->delete();
        }
        $json['message'] = ucwords($producto->nombre);
        $json['total'] = formatoMillares($total_actual - $descontar);
        $json['content'] = $total_actual - $descontar;
        $json['bs'] = precioBolivares($total_actual - $descontar);

        return response()->json($json);
    }

    public function guardarPedido(Request $request, $id)
    {
        $validar = Pedido::where('users_id', $id)->where('estatus', 0)->first();
        if ($validar){
            verSweetAlert2('Usted tiene un Pedido Pendiente por Pago, NO puede realizar mas pedidos hasta procesar el anterior', null, 'warning');
            return back();
        }
        $total_item = $request->total_item;
        for ($i = 1; $i <= $total_item; $i++) {

            $id_producto = $request->get('id_producto_' . $i);
            $cantidad = $request->get('cantidad_' . $i);

            $producto = Producto::find($id_producto);
            $precio = $producto->precio;
            $cant_inventario = $producto->cant_inventario;
            $venta_individual = $producto->venta_individual;
            $max_carrito = $producto->max_carrito;
            $estado = $producto->estado;
            $visibilidad = $producto->visibilidad;
            $descuento = $producto->descuento;

            if ($estado != 1) {
                $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id)->where('valor', $id_producto)->get();
                foreach ($parametros as $parametro) {
                    $parametro->delete();
                }
                verSweetAlert2("Actualizando carrito...", null, 'warning', null, 'Producto Agotado');
                return back();
            }

            if ($cantidad > $cant_inventario) {
                verSweetAlert2("Actualizando carrito...", null, 'warning', null, 'Canditad NO Disponible');
                $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id)->where('valor', $id_producto)->get();
                $max = 0;
                foreach ($parametros as $parametro) {
                    $max++;
                    if ($max > $cant_inventario) {
                        $parametro->delete();
                    }
                }
                return back();
            }

            if ($venta_individual) {
                if ($cantidad > 1) {
                    $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id)->where('valor', $id_producto)->get();
                    $uno = true;
                    foreach ($parametros as $parametro) {
                        if ($uno) {
                            $uno = false;
                        } else {
                            $parametro->delete();
                        }
                    }
                    verSweetAlert2("Actualizando carrito...", null, 'warning', null, 'Cant. Maxima Superada');
                    return back();
                }
            } else {
                if ($cantidad > $max_carrito) {
                    $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id)->where('valor', $id_producto)->get();
                    $max = 0;
                    foreach ($parametros as $parametro) {
                        $max++;
                        if ($max > $max_carrito) {
                            $parametro->delete();
                        }
                    }
                    verSweetAlert2("Actualizando carrito...", null, 'warning', null, 'Cant. Maxima Superada');
                    return back();
                }
            }

        }

        //dd($request->all());

        //empezamos a guardar el pedido
        $pedido = new Pedido();
        $pedido->users_id = $id;
        $pedido->total = $request->total;

        if ($request->paraControl != "hola") {
            $pedido->delivery = "SI";
            $pedido->costo_delivery = $request->delivery;
            $pedido->subtotal = $request->total - $request->delivery;
        } else {
            $pedido->delivery = "NO";
            $pedido->subtotal = $request->total;
        }

        $pedido->fecha = date("Y-m-d");

        $cliente = Cliente::where('users_id', $id)->first();
        if ($cliente) {
            $pedido->cedula = $cliente->cedula;
            $pedido->nombre = $cliente->nombre;
            $pedido->apellidos = $cliente->apellidos;
            $pedido->telefono = $cliente->telefono;
            $pedido->direccion_1 = $cliente->direccion_1;
            $pedido->direccion_2 = $cliente->direccion_2;
            $pedido->localidad = $cliente->localidad;
        }

        $pedido->save();

        //guardamos cada item del pedido en la tabla articulos

        for ($i = 1; $i <= $total_item; $i++) {

            $id_producto = $request->get('id_producto_' . $i);
            $cantidad = $request->get('cantidad_' . $i);

            $producto = Producto::find($id_producto);
            $precio = $producto->precio;

            $articulo = new Articulo();
            $articulo->pedidos_id = $pedido->id;
            $articulo->productos_id = $id_producto;
            $articulo->cantidad = $cantidad;
            $articulo->precio_pedido = $precio;
            $articulo->save();
        }

        //vaciamos el carrito

        $parametros = Parametro::where('nombre', 'carrito')->where('tabla_id', $id)->get();
        foreach ($parametros as $parametro){
            $parametro->delete();
        }

        //verSweetAlert2('Su pedido ha sido reservado', 'toast');
        return redirect()->route('android.checkout', $id);
    }


    public function checkout($id)
    {
        $pedido = Pedido::where('users_id', $id)->orderBy('id', 'DESC')->first();
        $articulos = Articulo::where('pedidos_id', $pedido->id)->get();
        $pago_divisas = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 1)->first();
        if ($pago_divisas){ $valor_divisas = $pago_divisas->valor; }else{ $valor_divisas = false; }
        $pago_transferencias = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 2)->first();
        if ($pago_transferencias){ $valor_transferencia = $pago_transferencias->valor; }else{ $valor_transferencia = false; }
        $pago_movil = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 3)->first();
        if ($pago_movil){ $valor_movil = $pago_movil->valor; }else{ $valor_movil = false; }

        $cuentas = Cuenta::all();
        $trasnferencias = Cuenta::where('tipo', '!=', 'PAGO_MOVIL')->pluck('banco', 'id');
        $movil = Cuenta::where('tipo', 'PAGO_MOVIL')->pluck('banco', 'id');

        $cliente = Cliente::where('users_id', Auth::user()->id)->first();


        return view('android.store.checkout')
            ->with('pedido', $pedido)
            ->with('articulos', $articulos)
            ->with('pago_divisas', $valor_divisas)
            ->with('pago_transferencia', $valor_transferencia)
            ->with('pago_movil', $valor_movil)
            ->with('cuentas', $cuentas)
            ->with('transferencias', $trasnferencias)
            ->with('movil', $movil)
            ->with('cliente', $cliente);
    }

    public function checkoutStore(Request $request, $id)
    {
        if (!$request->mpago_transferencia && !$request->mpago_movil && !$request->mpago_divisas){
            verSweetAlert2('Elija un metodo de pago.', null, 'error');
            return back();
        }

        $pedido = Pedido::find($id);

        if ($pedido->estatus){
            //verSweetAlert2('Tu pedido esta en espera de confirmacion del pago');
            return redirect()->route('android.pedidos.show', [$id, $pedido->id]);
        }

        if (!$request->direccion_principal){
            if ($request->id_cliente){
                $pedido->direccion_1 = $request->direccion_1;
                $pedido->direccion_2 = $request->direccion_2;
                $pedido->localidad = $request->localidad;
                $pedido->update();
            }else{
                $cliente = new Cliente($request->all());
                $cliente->users_id = Auth::user()->id;
                $cliente->save();
                $pedido->cedula = $cliente->cedula;
                $pedido->nombre = $cliente->nombre;
                $pedido->apellidos = $cliente->apellidos;
                $pedido->telefono = $cliente->telefono;
                $pedido->direccion_1 = $cliente->direccion_1;
                $pedido->direccion_2 = $cliente->direccion_2;
                $pedido->localidad = $cliente->localidad;
                $pedido->update();
            }
        }

        if ($request->mpago_transferencia){
            $pago = new Movimiento();
            $pago->pedidos_id = $pedido->id;
            $pago->cuentas_id = $request->cuenta_id_transferencia;
            $pago->referencia = $request->referencia_transferencia;
            $pago->tipo = "Pago";
            $pago->users_id = Auth::user()->id;
            $pago->save();
        }

        if ($request->mpago_movil){
            $pago = new Movimiento();
            $pago->pedidos_id = $pedido->id;
            $pago->cuentas_id = $request->cuenta_id_movil;
            $pago->referencia = $request->referencia_movil;
            $pago->tipo = "Pago";
            $pago->users_id = Auth::user()->id;
            $pago->save();
        }

        if ($request->mpago_divisas){
            $pago = new Movimiento();
            $pago->pedidos_id = $pedido->id;
            $pago->cuentas_id = 0;
            $pago->tipo = "Pago";
            $pago->users_id = Auth::user()->id;
            $pago->save();
        }

        if ($request->notas_cliente != ""){
            $pedido->nota_cliente = $request->notas_cliente;
        }

        $pedido->estatus = 1;
        $pedido->update();

        verSweetAlert2('Pago registrado');
        return redirect()->route('android.pedidos.show', [$id, $pedido->id]);
    }


}
