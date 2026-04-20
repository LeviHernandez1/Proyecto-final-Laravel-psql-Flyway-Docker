<?php

namespace App\Models;

use App\QueryBuilders\EventoQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';

    protected $fillable = [
        'nombre',
        'fecha',
        'lugar',
        'capacidad'
    ];

    // Mapeamos los campos de tiempo
    protected $casts = [
        'fecha' => 'date',
    ];

    public function newEloquentBuilder($query)
    {
        return new EventoQueryBuilder($query);
    }
}