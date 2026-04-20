<?php

namespace App\Livewire\Eventos;


use App\Models\Evento;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class GestionarEventos extends Component
{
    public function render()
    {
        return view('livewire.eventos.gestionar-eventos');
    }
    //Escuchar evento para refrescar la tabla cuando se guarda algo en el modal
    #[On('actualizar-lista-eventos')]
    public function actualizar()
    {
        // Solo para disparar el re-render de la propiedad computada
    }

    #[Computed]
    public function eventos()
    {
        return Evento::orderBy('fecha','asc')->get();
    }
}
