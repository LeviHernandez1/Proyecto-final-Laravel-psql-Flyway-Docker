<?php

namespace App\Livewire\Forms\Eventos;

use Livewire\Form;
use App\Models\Evento;

class RegistrarEventoForm extends Form
{
    public $id_evento;
    public $nombre;
    public $fecha;
    public $lugar;
    public $capacidad;
    public $esEdicion = false;

    public function validationAttributes()
    {
        return [
            'nombre' => 'Nombre del evento',
            'fecha' => 'Fecha',
            'lugar' => 'Lugar',
            'capacidad' => 'Capacidad',
        ];
    }

    // Reglas de validación
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'lugar' => ['required', 'string'],
            'capacidad' => ['required', 'integer', 'min:1'],
        ];
    }

    // Cargar datos si es edición
    public function setDatos(?int $idEvento = null)
    {
        $this->id_evento = $idEvento;
        $this->esEdicion = false;

        if ($idEvento) {
            $evento = Evento::findOrFail($idEvento);
            $this->esEdicion = true;
            $this->nombre = $evento->nombre;
            $this->fecha = $evento->fecha;
            $this->lugar = $evento->lugar;
            $this->capacidad = $evento->capacidad;
        }
    }
}