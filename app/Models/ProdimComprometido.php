<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdimComprometido extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_comprometido';

    protected $table = "prodim_comprometido";
}
