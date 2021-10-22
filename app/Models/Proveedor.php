<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_proveedor';

    protected $table = "proveedores";

    protected $fillable = [
        'rfc',
        'tipo_rfc',
        'razon_social',
        'representante_legal'
    ];
}
