<?php

namespace App\Enums;

enum RegistroTipoEnum
{
    case Usuario;
    case Rol;
    case Reservacion;

    public function registroTipo()
    {
        return match ($this) {
            self::Usuario => 'usuario',
            self::Rol => 'rol',
            self::Reservacion => 'reservacion',
        };
    }

    public function descripcion()
    {
        return match ($this) {
            self::Usuario => 'Usuarios que tienen acceso al sistema.',
            self::Rol => 'Roles que se pueden asignar a los usuarios.',
            self::Reservacion => 'Reservaciones de salas para citas.',
        };
    }
}
