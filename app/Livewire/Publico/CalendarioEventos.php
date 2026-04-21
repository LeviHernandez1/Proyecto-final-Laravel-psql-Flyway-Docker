<?php

namespace App\Livewire\Publico;

use App\Models\Evento;
use Livewire\Component;
use Livewire\Attributes\Computed;

class CalendarioEventos extends Component
{
    /* Propiedad computada para obtener los eventos con sus sesiones. */
    #[Computed]
    public function eventos()
    {
        return Evento::with('sesiones')
            ->orderBy('fecha', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.publico.calendario-eventos');
    }
}