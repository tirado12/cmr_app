<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObrasFuentes extends Model
{
    use HasFactory;

    protected $table = "obras_fuentes";

    protected $fillable = [
        'fuente_financiamiento_cliente_id',
        'obra_id',
        'monto',
    ];

    public function fuentes(){
        return $this->hasMany(FuentesCliente::class, 'id_fuente_financ_cliente', 'fuente_financiamiento_cliente_id'); //arg1 - Model, arg2 - foreign key
    }
}
