<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Parametro;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{

    public function index()
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
        return view('android.categorias.index')
            ->with('categorias', $categorias);
    }

    public function show($id, $categoria)
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
        return view('android.categorias.show')
            ->with('ultimos_productos', $ultimos_productos)
            ->with('en_oferta', $en_oferta)
            ->with('productos', $productos)
            ->with('total', $total)
            ->with('i', 1);
    }
}
