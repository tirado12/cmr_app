<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_municipio';
    
    protected $table = "municipios";

    protected $fillable = [
        'nombre',
        'rfc',
        'direccion',
        'distrito_id'
    ];
}
