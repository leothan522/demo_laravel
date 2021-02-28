<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "pedidos";
    protected $fillable = [
        'users_id', 'subtotal', 'total', 'nota_cliente', 'estatus', 'fecha','cedula', 'nombre', 'apellidos', 'telefono', 'direccion_1', 'direccion_2', 'localidad',
        'ip_cliente', 'delivery'
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function scopeBuscar($query, $id)
    {
        return $query->where('id', 'LIKE', "%$id%");
    }

}
