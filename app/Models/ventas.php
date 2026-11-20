<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    protected $table = 'ventas';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'user_id',
        'precio_unitario',
        'subtotal',
        'estado',
        'codigo_anulacion',
        'estado'

    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
