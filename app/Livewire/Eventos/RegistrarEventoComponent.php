<?php

namespace App\Livewire\Eventos;

use App\Models\Evento;
use App\Livewire\Forms\Eventos\RegistrarEventoForm; // Importamos el nuevo Form
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class RegistrarEventoComponent extends Component
{
    use Toastable;

    // Inyectamos el Form Object
    public RegistrarEventoForm $form;
    
    public $mostrarModal = false;

    public function render()
    {
        return view('livewire.eventos.registrar-evento-component');
    }

    // Método que alerta al componente cuando se hace clic en agregar o editar
    #[On('abrir-modal-registrar-evento')]
    public function abrirModal($idEvento = null)
    {
        $this->resetValidation();
        $this->form->reset(); // Limpiamos el objeto form antes de empezar

        // Usamos el método setDatos del Form Object
        $this->form->setDatos($idEvento);
        
        $this->mostrarModal = true;
    }

    public function guardar()
    {
        // 1. Validación delegada al Form Object
        try {
            $this->form->validate();
        } catch (\Exception $e) {
            $this->error('Verifique los errores en el formulario');
            throw $e;
        }

        // 2. Proceso de guardado con manejo de excepciones
        try {
            Evento::updateOrCreate(
                ['id_evento' => $this->form->id_evento],
                [
                    'nombre'    => $this->form->nombre,
                    'fecha'     => $this->form->fecha,
                    'lugar'     => $this->form->lugar,
                    'capacidad' => $this->form->capacidad,
                ]
            );

            $this->mostrarModal = false;
            
            // Notificamos al componente padre para refrescar la tabla
            $this->dispatch('actualizar-lista-eventos');
            
            // Mensaje dinámico usando la propiedad esEdicion del form
            $mensaje = $this->form->esEdicion ? 'Evento actualizado con éxito' : 'Evento registrado con éxito';
            $this->success($mensaje);

            $this->restablecer();

        } catch (\Exception $e) {
            $mensaje = $this->form->esEdicion ? 'Error al actualizar el evento' : 'Error al registrar el evento';
            $this->error($mensaje);
        }
    }

    public function cancelar()
    {
        $this->mostrarModal = false;
        $this->restablecer();
    }

    protected function restablecer()
    {
        $this->form->reset();
        $this->resetValidation();
    }
}