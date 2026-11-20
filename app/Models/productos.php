<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'stock_minimo',
        'estado'
    ];
    
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function movimiento()
    {
        return $this->hasMany(Movimientos::class, 'producto_id');
    }
}
