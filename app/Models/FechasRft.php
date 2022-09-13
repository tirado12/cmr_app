<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechasRft extends Model
{
    protected $primaryKey = 'id_fechas_rft';
    protected $table = "fechas_rft";
    use HasFactory;
}
