<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraObservaciones extends Model
{
    use HasFactory;

    protected $table = "obra_observaciones";

    protected $fillable = [
        'obra_id',
        'observacion',
    ];
    
}
