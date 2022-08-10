<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodim extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_prodim';

    protected $table = "prodim";

    protected $fillable = [
        'presentado',
        'revisado',
        'fecha_revisado',
        'aprobado',
        'fecha_aprobado',
        'convenio',
        'fecha_convenio',
        'acuse_prodim',
        'fuente_id'
    ];
}
