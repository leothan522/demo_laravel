<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $table = "articulos";
    protected $fillable = ['pedidos_id', 'productos_id', 'cantidad', 'precio_pedido'];

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

}
