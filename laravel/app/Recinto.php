<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{
    protected $table = 'recinto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'direccion',
        'localidad_id',
    ];

    public function localidad()
    {
        return $this->belongsTo('App\Localidad');
    }
}
