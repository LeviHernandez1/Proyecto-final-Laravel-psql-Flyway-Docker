<?php

namespace App\Livewire\Reservaciones;

use App\Enums\EstatusEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Modulos\Citas\Reservaciones\Models\Reservacion;


class ListarReservacionesComponent extends Component
{
    public function render()
    {
        return view('livewire.reservaciones.listar-reservaciones-component');
    }

    #[On('actualizar-lista-reservaciones')]
    public function actualizar()
    {
    }

    #[Computed]
    public function reservaciones()
    {
        return Reservacion::with('sala')
            ->where('id_usuario', Auth::id())
            ->where('estado', EstatusEnum::Activo->value)
            ->get();
    }

}
