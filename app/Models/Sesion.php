<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    // Nombre de la tabla en Postgres
    protected $table = 'sesiones';

    // Nombre de la llave primaria
    protected $primaryKey = 'id_sesion';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_evento',
        'fecha',
        'horario',
        'ponente'
    ];
    
    protected $casts = [
        'fecha' => 'date',
    ];

    // Relación inversa con Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }
}