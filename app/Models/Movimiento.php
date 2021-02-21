<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $table = "movimientos";
    protected $fillable = ['pedidos_id', 'cuentas_id', 'referencia', 'monto', 'capture', 'estatus', 'tipo', 'reembolsos_id', 'users_id'];
}
