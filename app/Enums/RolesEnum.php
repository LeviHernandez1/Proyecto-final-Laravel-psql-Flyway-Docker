<?php

namespace App\Enums;

enum  RolesEnum :string
{
    case Invitado = 'Invitado';
    case Asistente = 'Asistente';
    case Organizador = 'Organizador';
    
    public function etiqueta(): string
    {
        return match ($this) {
            self::Invitado => 'Invitado publico general',
            self::Asistente => 'Asistente Registrado',
            self::Organizador => 'Organizador de evento',
        };
    }

    // Mostramos descripciones en la interfaz
    public function descripcion(): string
    {
        return match ($this){
            self::Invitado => 'Solo puede consultar la información de eventos y sesiones.',
            self::Asistente => 'Puede inscribirse y generar constancias.',
            self::Organizador => 'Gestión total de eventos y asistentes.',
        };
    }
}