<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'resultado';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'total',
        'mesa_id',
        'participante_eleccion_id',
    ];
}
