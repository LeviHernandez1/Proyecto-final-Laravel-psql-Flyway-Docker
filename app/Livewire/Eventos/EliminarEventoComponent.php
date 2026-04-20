<?php

namespace App\Livewire\Eventos;

use App\Models\Evento;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class EliminarEventoComponent extends Component
{
    use Toastable;

    public $idEvento;
    public $nombre;
    public $modalAbierto = false;

    public function render()
    {
        return view('livewire.eventos.eliminar-evento-component');
    }

    #[On('abrir-modal-eliminar-evento')]
    public function abrirModal($idEvento, $nombre)
    {
        $this->idEvento = $idEvento;
        $this->nombre = $nombre;
        $this->modalAbierto = true;
    }

    public function cancelar()
    {
        $this->modalAbierto = false;
    }

    public function eliminar()
    {
        try {
            $evento = Evento::findOrFail($this->idEvento);
            $evento->delete();

            $this->modalAbierto = false;
            $this->dispatch('actualizar-lista-eventos');
            
            $this->success('Evento eliminado con éxito');
        }
        catch (\Exception $e) {            
            $this->error('Error al intentar eliminar el evento');
        }
    }
}