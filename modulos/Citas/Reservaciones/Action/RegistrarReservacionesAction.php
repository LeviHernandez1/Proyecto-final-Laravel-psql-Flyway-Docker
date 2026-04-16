<?php

namespace Modulos\Citas\Reservaciones\Action;

use App\Enums\AccionEnum;
use App\Enums\EstatusEnum;
use App\Enums\RegistroTipoEnum;
use App\Livewire\Forms\Reservaciones\RegistrarReservacionesForm;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Modulos\Citas\Reservaciones\Models\Reservacion;

class RegistrarReservacionesAction
{
    public static function execute(RegistrarReservacionesForm $form, $idUsuario, $idReservacion = null)
    {
        return DB::transaction(function () use ($form, $idUsuario, $idReservacion) {
            $idAccion = $idReservacion ? AccionEnum::Modificacion 
            : AccionEnum::Registro;

            if($idReservacion){
                $reservacion = Reservacion::findOrFail($idReservacion);

                $reservacion->update([
                    'id_usuario' => $idUsuario,
                    'id_sala' => $form->id_sala,
                    'fecha' => $form->fecha,
                    'hora_inicio' => $form->hora_inicio,
                    'hora_fin' => $form->hora_fin,
                ]);
                
            }else{
                $reservacion = Reservacion::create([
                    'id_usuario' => $idUsuario,
                    'id_sala' => $form->id_sala,
                    'fecha' => $form->fecha,
                    'hora_inicio' => $form->hora_inicio,
                    'hora_fin' => $form->hora_fin,
                    'estado' => EstatusEnum::Activo
                ]);
            }

            Bitacora::registrar($idAccion, $idUsuario, $reservacion->id_reservaciones, RegistroTipoEnum::Reservacion);
            return $reservacion;
            

        });
    }
}