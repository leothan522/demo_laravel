<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Galeria;
use App\Models\Movimiento;
use App\Models\Parametro;
use App\Models\Pedido;
use App\Models\Precio;
use App\Models\Producto;
use App\Models\Zona;
use App\Http\Requests\Android\FacturacionEnvioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index()
	{
		//dd("hola");
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
		$ultimos_productos = Producto::where('estado', 1)->where('precio', '>', 0)->orderBy('updated_at', 'DESC')->paginate(6);


        $categorias = Categoria::where('num_productos', '>', 0)->orderBy('num_productos', 'DESC')->get();

		//productos disponibles
		$productos = Producto::where('estado', 1)->where('precio', '>', 0)->orderBy('cant_ventas', 'DESC')->paginate(24);
        $productos->each(function ($producto) {
            $producto->favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
            $producto->carrito = Parametro::where('nombre', 'carrito')->where('tabla_id', Auth::user()->id)->where('valor', $producto->id)->first();
        });

        return view('web.store.index')
            ->with('telefono_numero', $telefono_numero)
            ->with('telefono_texto', $telefono_texto)
            ->with('categorias', $categorias)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('productos', $productos)
            ->with('i', 1);
	}

	public function favoritos()
    {

		$categorias = Categoria::where('num_productos', '>', 0)->orderBy('num_productos', 'DESC')->get();

        $favoritos = Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::user()->id)->paginate(24);
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
			$parametro->slug = $producto->categorias->slug;
			$parametro->id_produto = $producto->id;
			$parametro->favoritos = true;
        });
        return view('web.store.favoritos')
			->with('categorias', $categorias)
            ->with('favoritos', $favoritos)
            ->with('i', 1);
    }

	public function categorias()
    {
        $categorias = Categoria::orderBy('nombre', 'ASC')->get();
        $categorias->each(function ($categoria){
            $productos = Producto::where('categorias_id', $categoria->id)->where('estado', 1)->count();
            if ($productos){
                $categoria->disponibles = $productos;
            }else{
                $categoria->disponibles = null;
            }
        });
        return view('web.store.categorias')
            ->with('categorias', $categorias);
    }

	public function categoriasShow($categoria)
    {
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

        $ver_categoria = Categoria::find($categoria);

        return view('web.store.categorias_show')
            ->with('categoria', $ver_categoria)
            ->with('ultimos_productos', $ultimos_productos)
            ->with('en_oferta', $en_oferta)
            ->with('productos', $productos)
            ->with('total', $total)
            ->with('i', 1);
    }

	public function cuentaIndex()
    {

        $cliente = Cliente::where('users_id', Auth::user()->id)->first();
        if ($cliente){
            $id_cliente = $cliente->id;
            $cedula = $cliente->cedula;
            $nombre = $cliente->nombre;
            $apellidos = $cliente->apellidos;
            $telefono = $cliente->telefono;
            $direccion_1 = $cliente->direccion_1;
            $direccion_2 = $cliente->direccion_2;
            $localidad = $cliente->localidad;
            $boton = "Guardar Cambios";
            $class = "btn-primary";
            $opcion = "update";
        }else{
            $id_cliente = null;
            $cedula = null;
            $nombre = null;
            $apellidos = null;
            $telefono = null;
            $direccion_1 = null;
            $direccion_2 = null;
            $localidad = null;
            $boton = "Guardar";
            $class = "btn-success";
            $opcion = "save";
        }
        return view('web.store.cuenta')
            ->with('id_cliente', $id_cliente)
            ->with('cedula', $cedula)
            ->with('nombre', $nombre)
            ->with('apellidos', $apellidos)
            ->with('telefono', $telefono)
            ->with('direccion_1', $direccion_1)
            ->with('direccion_2', $direccion_2)
            ->with('localidad', $localidad)
            ->with('boton', $boton)
            ->with('class', $class)
            ->with('opcion', $opcion);
    }

    public function cuentaUpdate(FacturacionEnvioRequest $request)
    {
        $opcion = $request->opcion;
        if ($opcion == "save"){
            $cliente = new Cliente($request->all());
            $cliente->users_id = Auth::user()->id;
            $cliente->save();
            verSweetAlert2('Datos guardados correctamente.');
        }else{
            $cliente = Cliente::find($request->id_cliente);
            $array_db = $cliente->toArray();
            $array_form = $request->all();
            unset($array_form['_token']);
            unset($array_form['opcion']);
            unset($array_form['id_cliente']);
            unset($array_db['id']);
            unset($array_db['codigo_postal']);
            unset($array_db['estados_id']);
            unset($array_db['municipios_id']);
            unset($array_db['parroquias_id']);
            unset($array_db['num_pedidos']);
            unset($array_db['gasto_bs']);
            unset($array_db['gasto_dolar']);
            unset($array_db['ultima_compra']);
            unset($array_db['users_id']);
            unset($array_db['created_at']);
            unset($array_db['updated_at']);
            if (array_diff($array_db, $array_form)){
                $cliente->fill($request->all());
                $cliente->update();
                verSweetAlert2('Datos guardados correctamente.');
            }else{
                //verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                verSweetAlert2('No se realizo ningun cambio.', 'android', 'warning');
            }

        }
        $class = "primary";
        //flash('Datos Guardados Exitosamente', $class)->important();

        return back();
    }

	public function carrito()
    {

        $dolar = Parametro::where('nombre', 'precio_dolar')->first();
        if ($dolar){
            $precio_dolar = $dolar->precio;
        }else{
            $precio_dolar = null;
        }
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

        return view('web.store.carrito')
            ->with('carrito', $agrupados)
            ->with('dolarPrecio', $precio_dolar)
            ->with('zonas', $zonas)
            ->with('i', 0);
    }

	public function pedidosIndex()
    {
        $pedidos = Pedido::where('users_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('web.store.pedidos')
            ->with('pedidos', $pedidos)
            ->with('i', 0);
    }

    public function pedidosShow($id_pedido)
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


        return view('web.store.pedidos_show')
            ->with('pedido', $pedido)
            ->with('articulos', $articulos)
            ->with('cliente', $cliente)
            ->with('pagos', $pagos);
    }

}
