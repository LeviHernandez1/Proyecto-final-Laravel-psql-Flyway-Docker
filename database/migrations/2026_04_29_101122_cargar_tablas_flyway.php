<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration {
    public function up(): void
    {
        // database_path() apunta a la carpeta 'database' de tu proyecto
        // Agregamos los nombres EXACTOS con los dos guiones bajos __
        $archivos = [
            database_path('flyway/sql/V002__Estructura_inicial.sql'),
            database_path('flyway/sql/V003__Sistema_Eventos.sql'),
        ];

        foreach ($archivos as $archivo) {
            if (File::exists($archivo)) {
                DB::unprepared(File::get($archivo));
            } else {
                // Si falla, imprimirá la ruta para que compares con tu explorador
                dump("No se encontró: " . $archivo);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Si necesitas limpiar en un rollback, podrías poner comandos DROP aquí
    }
};