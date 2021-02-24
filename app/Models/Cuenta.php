<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuenta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "cuentas";
    protected $fillable = ['banco', 'tipo', 'numero', 'titular', 'rif_cedula'];
}
