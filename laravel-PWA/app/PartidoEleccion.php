<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartidoEleccion extends Model
{
    protected $table = 'partido_eleccion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'partido_id',
        'eleccion_id',
    ];
}
