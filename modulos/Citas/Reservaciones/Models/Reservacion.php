<?php

namespace Modulos\Citas\Reservaciones\Models;

use Illuminate\Database\Eloquent\Model;
use Modulos\Citas\Reservaciones\Models\Sala;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservacion extends Model
{
    use HasFactory;

    protected $table = 'reservaciones';
    protected $primaryKey = 'id_reservaciones';

    protected $fillable = [
        'id_usuario',
        'id_sala',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado'
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'id_sala', 'id_sala');
    }

}
