<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;
    protected $table = "precios";
    protected $fillable = [
        'precio',
        'cant_inicio',
        'cant_final',
        'productos_id'
    ];

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

}
