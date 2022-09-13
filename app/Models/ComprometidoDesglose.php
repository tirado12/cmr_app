<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprometidoDesglose extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_desglose'; 
    protected $table = "comprometido_desglose";

    protected $fillable = [
        'comprometido_id',
        'concepto',
        'monto_desglose',
    ];
}
