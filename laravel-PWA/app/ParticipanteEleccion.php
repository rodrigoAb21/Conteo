<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipanteEleccion extends Model
{
    protected $table = 'participante_eleccion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'participante_id',
        'eleccion_id',
    ];
}
