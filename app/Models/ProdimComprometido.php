<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdimComprometido extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_comprometido';

    protected $table = "prodim_comprometido";

    protected $fillable = [
        'prodim_catalogo_id',
        'prodim_id',
        'fecha_comprometido',
        'monto'
    ];

    public function desglose(){
        return $this->hasMany(ComprometidoDesglose::class,'comprometido_id','id_comprometido');
    }

    public function total_desglose(){
        return $this->hasMany(ComprometidoDesglose::class,'comprometido_id','id_comprometido')->select('comprometido_id', DB::raw('SUM(monto_desglose) as total'))->groupBy('comprometido_id');
    }
}
