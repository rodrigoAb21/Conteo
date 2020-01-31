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
        'municipio_id',
    ];

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }
}
