<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'resultado';
    protected $primaryKey = ['mesa_id','participante_eleccion_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'total',
        'mesa_id',
        'participante_eleccion_id',
    ];

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('mesa_id', '=', $this->getAttribute('mesa_id'))
            ->where('participante_eleccion_id', '=', $this->getAttribute('participante_eleccion_id'));
        return $query;
    }
}
