<?php

namespace App\Livewire\Sesiones;

use App\Livewire\Forms\Sesiones\RegistrarSesionForm;
use App\Models\Evento;
use App\Models\Sesion;
use Livewire\Attributes\On;
use Livewire\Component;

class RegistrarSesionesComponent extends Component
{
    public RegistrarSesionForm $form;
    public $mostrarModal = false; // <--- Cambiado de $open a $mostrarModal

    public function render()
    {
        return view('livewire.sesiones.registrar-sesiones-component', [
            'eventos' => Evento::orderBy('nombre', 'asc')->get()
        ]);
    }

    #[On('editar-sesion')]
    public function editar($id = null)
    {
        $this->form->reset(); 

        if ($id) {
            $sesion = Sesion::find($id);
            if ($sesion) {
                $this->form->setSesion($sesion);
            }
        }

        $this->mostrarModal = true;
    }

    public function guardar()
    {
        $this->form->store();
        $this->dispatch('actualizar-lista-sesiones');
        $this->mostrarModal = false; 
    }

    // Metodo de cancelar
    public function cancelar()
    {
        $this->mostrarModal = false;
    }
}