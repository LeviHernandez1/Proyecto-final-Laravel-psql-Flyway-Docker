<?php

namespace App\Livewire\Forms\Reservaciones;

use App\Traits\ArreglosMultidimensionalesHelper;
use Livewire\Form;
use Modulos\Citas\Reservaciones\Models\Reservacion;

class RegistrarReservacionesForm extends Form
{
    use ArreglosMultidimensionalesHelper;

    public $id_reservaciones;
    public $id_usuario;
    public $id_sala;
    public $fecha;
    public $hora_inicio;
    public $hora_fin;
    public $esEdicion;

    public function validationAttributes()
    {
        return [
            'id_sala' => 'Sala',
            'fecha' => 'Fecha de reservación',
            'hora_inicio' => 'Hora de inicio de la reservación',
            'hora_fin' => 'Hora de fin de la reservación',
        ];
    }

    public function rules(): array
    {
        return [
            'id_sala' => ['required', 'exists:salas,id_sala'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required'],
            'hora_fin' => ['required', 'after:hora_inicio'],
        ];
    }

    public function messages()
    {
        return [
            "fecha.after_or_equal" => "El campo :attribute no puede ser anterior al día de hoy.",
        ];
    }

    public function setDatos(?int $idReservacion = null)
    {
        $this->id_reservaciones = $idReservacion;

        $reservacion = $idReservacion
        ? Reservacion::findOrFail($idReservacion)
        : new Reservacion();
        $this->esEdicion = false;

        if ($idReservacion) {
        $this->esEdicion = true;
        $this->id_reservaciones = $reservacion->id_reservaciones;
        $this->id_usuario = $reservacion->id_usuario;
        $this->id_sala = $reservacion->id_sala;
        $this->fecha = $reservacion->fecha;
        $this->hora_inicio = $reservacion->hora_inicio;
        $this->hora_fin = $reservacion->hora_fin;
        }
    }

    public function isDirty(): bool
    {
        if (!$this->id_reservaciones) {
            return true;
        }

        $db = Reservacion::find($this->id_reservaciones);

        if (!$db) {
            return true;
        }

        $actual = self::arrayFilterRecursive([
            'id_sala' => $this->id_sala,
            'fecha' => $this->fecha,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
        ], null, true);

        $original = self::arrayFilterRecursive([
            'id_sala' => $db->id_sala,
            'fecha' => $db->fecha,
            'hora_inicio' => $db->hora_inicio,
            'hora_fin' => $db->hora_fin,
        ], null, true);

        return !self::sonIguales($actual, $original);
    }

}
