<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'provincia_id',
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }
}
