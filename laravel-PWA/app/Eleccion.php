<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    protected $table = 'eleccion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'fecha',
        'estado',
        'mesas',
        'tipo',
    ];
}
