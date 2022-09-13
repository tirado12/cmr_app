<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rft extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_rft';

    protected $table = "rft";

    protected $fillable = [
        'obra_id',
        'primer_trimestre',
        'segundo_trimestre',
        'tercer_trimestre',
        'cuarto_trimestre'
    ];
}
