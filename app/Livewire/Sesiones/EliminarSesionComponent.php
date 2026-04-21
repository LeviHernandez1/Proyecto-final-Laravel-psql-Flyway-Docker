<?php

namespace App\Livewire\Sesiones;

use App\Models\Sesion;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class EliminarSesionComponent extends Component
{
    use Toastable;

    public $idSesion;
    public $ponente;
    public $modalAbierto = false;

    public function render()
    {
        return view('livewire.sesiones.eliminar-sesion-component');
    }

    #[On('abrir-modal-eliminar-sesion')]
    public function abrirModal($idSesion, $ponente)
    {
        $this->idSesion = $idSesion;
        $this->ponente = $ponente;
        $this->modalAbierto = true;
    }

    public function cancelar()
    {
        $this->modalAbierto = false;
    }

    public function eliminar()
    {
        try {
            $sesion = Sesion::findOrFail($this->idSesion);
            $sesion->delete();

            $this->modalAbierto = false;
            $this->dispatch('actualizar-lista-sesiones');
            
            $this->success('Sesión eliminada con éxito');
        }
        catch (\Exception $e) {            
            $this->error('Error al intentar eliminar la sesión');
        }
    }
}