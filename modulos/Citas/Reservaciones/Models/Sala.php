<?php

namespace Modulos\Citas\Reservaciones\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';
    protected $primaryKey = 'id_sala';

    protected $fillable = [
        'nombre',
        'capacidad',
        'tipo',
        'estado'
    ];

}
