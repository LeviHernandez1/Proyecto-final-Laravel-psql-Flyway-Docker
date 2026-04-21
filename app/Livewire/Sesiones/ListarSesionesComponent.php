<?php

namespace App\Livewire\Sesiones;

use App\Models\Sesion;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ListarSesionesComponent extends Component
{
    public function render()
    {
        return view('livewire.sesiones.listar-sesiones-component');
    }

    #[On('actualizar-lista-sesiones')]
    public function actualizar() {}

    #[Computed]
    public function sesiones()
    {
        return Sesion::with('evento')->orderBy('fecha', 'asc')->get();
    }

    public function eliminar($id)
    {
        Sesion::destroy($id);
    }
}