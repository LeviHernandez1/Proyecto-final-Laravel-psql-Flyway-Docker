<?php

namespace App\Livewire\Forms\Sesiones;

use App\Models\Sesion;
use Livewire\Form;

class RegistrarSesionForm extends Form
{
    public ? Sesion $sesion;

    public $id_evento = '';
    public $fecha = '';
    public $horario = '';
    public $ponente = '';
    public $id_sesion;

    protected $rules = [
        'id_evento' => 'required|exists:eventos,id_evento',
        'fecha'     => 'required|date',
        'horario'   => 'required',
        'ponente'   => 'required|string|max:100',
    ];

    public function setSesion(Sesion $sesion)
    {
        $this->sesion = $sesion;
        $this->id_sesion = $sesion->id_sesion;
        $this->id_evento = $sesion->id_evento;
        $this->fecha = $sesion->fecha;
        $this->horario = $sesion->horario;
        $this->ponente = $sesion->ponente;
    }

    public function store()
    {
        $this->validate();

        Sesion::updateOrCreate(
            ['id_sesion' => $this->id_sesion],
            $this->except(['sesion', 'id_sesion'])
        );

        $this->reset();
    }
}