<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class movimientos extends Model
{
    protected $table = 'movimientos';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'tipo',
        'cantidad',
        'stock_anterior',
        'stock_nuevo',
        'motivo',
        'observacion'
    ];

    public function producto()
{
    return $this->belongsTo(Productos::class, 'producto_id');
}
}
