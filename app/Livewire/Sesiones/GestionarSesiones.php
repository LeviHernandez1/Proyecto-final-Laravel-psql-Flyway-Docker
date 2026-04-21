<?php

namespace App\Livewire\Sesiones;

use App\Models\Sesion;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class GestionarSesiones extends Component
{
    public function render()
    {
        return view('livewire.sesiones.gestionar-sesiones');
    }

    #[On('actualizar-lista-sesiones')]
    public function actualizar()
    {
        // Dispara el re-render
    }
    #[Computed]
    public function sesiones()
    {
       return Sesion::with('evento')->orderBy('fecha', 'asc')->get();
    }
}
