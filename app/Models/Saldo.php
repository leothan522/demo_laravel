<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;
    protected $table = "saldos";
    protected $fillable = ['users_id', 'pedidos_id', 'monto'];
}
