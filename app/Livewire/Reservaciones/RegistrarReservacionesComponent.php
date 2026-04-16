<?php

namespace App\Livewire\Reservaciones;

use App\Enums\EstatusEnum;
use App\Livewire\Forms\Reservaciones\RegistrarReservacionesForm;
use App\Traits\WithLiveValidation;
use App\Traits\WithTrimArreglosRecursivos;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Modulos\Citas\Reservaciones\Action\RegistrarReservacionesAction;
use Modulos\Citas\Reservaciones\Models\Sala;

class RegistrarReservacionesComponent extends Component
{
    public $idReservacion;
    public $modalAbierto = false;
    protected $formName = 'form';

    use Toastable;

    use WithTrimArreglosRecursivos;
    use WithLiveValidation;

    public RegistrarReservacionesForm $form;

    public function render()
    {
        return view('livewire.reservaciones.registrar-reservaciones-component');
    }

    #[On('abrir-modal-registrar-reservacion')]
    public function abrirModalRegistrarReservacion($idReservacion)
    {
        $this->idReservacion = $idReservacion;
        $this->form->reset();

        if ($this->idReservacion) {
            $this->form->setDatos($this->idReservacion);
            $this->form->esEdicion = true;
        } else {
            $this->form->esEdicion = false;
        }
        $this->modalAbierto = true;
    }

    #[Computed]
    public function salas()
    {
        return Sala::where('estado', EstatusEnum::Activo->value)->get();
    }

    public function guardar()
    {
        $this->form = $this->trimFormRecursivos($this->form);
        try {
            $this->form->validate();
        } catch (\Exception $e) {
            $this->error('messages.errores_formulario');
            throw $e;
        }

        try {
            RegistrarReservacionesAction::execute($this->form, Auth::id(), $this->idReservacion);
            $this->modalAbierto = false;
            $this->dispatch('actualizar-lista-reservaciones');
            $mensaje = $this->form->esEdicion ? 'reservaciones.edicion.exito' : 'reservaciones.registro.exito';
            $this->success($mensaje);
            $this->form->esEdicion = false;
            $this->restablecer();
        } catch (\Exception $e) {
            $mensaje = $this->form->esEdicion ? 'reservaciones.edicion.error' : 'reservaciones.registro.error';
            $this->error($mensaje);
        }

        $this->modalAbierto = false;
    }

    public function cancelar()
    {
        $this->modalAbierto = false;
    }

    protected function restablecer()
    {
        $this->form->reset();
        $this->idReservacion = null;
        $this->resetValidation();
    }

    public function liveValidation(string $campo): void
    {
        $this->validateOnly(
            'form.' . $campo,
            $this->form->rules()
        );
    }
}
