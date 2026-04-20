<?php

namespace App\Enums;

enum RegistroTipoEnum
{
    case Usuario;
    case Rol;
    case Reservacion;
    case Evento;

    public function registroTipo()
    {
        return match ($this) {
            self::Usuario => 'usuario',
            self::Rol => 'rol',
            self::Reservacion => 'reservacion',
            self::Evento => 'evento',
        };
    }

    public function descripcion()
    {
        return match ($this) {
            self::Usuario => 'Usuarios que tienen acceso al sistema.',
            self::Rol => 'Roles que se pueden asignar a los usuarios.',
            self::Reservacion => 'Reservaciones de salas para citas.',
            self::Evento => 'Evento academico y sesiones programadas.',
        };
    }
}
