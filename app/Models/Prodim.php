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
        'firma_electronica',
        'revisado',
        'fecha_revisado',
        'validado',
        'fecha_validado',
        'convenio',
        'fecha_convenio',
        'acuse_prodim',
        'fuente_id'
    ];
}
