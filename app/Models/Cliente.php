<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cliente';
    protected $table = "clientes";

    protected $fillable=[
        'user',
        'email',
        'password',
        'anio_inicio',
        'anio_fin',
        'logo',
        'municipio_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function municipio(){
        return $this->hasOne(Municipio::class, 'id_municipio', 'municipio_id'); //arg1 - Model, arg2 - foreign key
    }
}
