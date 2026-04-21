<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Eventos\GestionarEventos;
use App\Livewire\Reservaciones\ListarReservacionesComponent;
use App\Livewire\Roles\ListarRolesComponent;
use App\Livewire\Sesiones\ListarSesionesComponent;
use App\Livewire\Usuarios\ListarUsuariosComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Publico\CalendarioEventos;
// Importaciones para los nuevos requerimientos
/* use App\Livewire\Publico\RegistroAsistente; */
use App\Livewire\Asistentes\MisConstancias;
use App\Livewire\Asistentes\EncuestaSatisfaccion;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- REGLA 1: Ruta para el calendario público ---
    Route::get('/calendario', CalendarioEventos::class)->name('publico.calendario');

    // --- REGLA 2: Registro como asistente (Invitados) ---
    /* Route::get('/registro-asistente', RegistroAsistente::class)
        ->name('publico.registro')
        ->middleware('permission:registrar-asistente'); */

    // --- REGLA 3: Generar constancias (Asistentes) ---
    /* Route::get('/mis-constancias', MisConstancias::class)
        ->name('asistente.constancias')
        ->middleware('permission:generar-constancia'); */

    // --- REGLA 4: Encuesta de satisfacción (Asistentes) ---
    /* Route::get('/evaluar-evento/{id_evento}', EncuestaSatisfaccion::class)
        ->name('asistente.encuesta')
        ->middleware('permission:llenar-encuesta-satisfaccion'); */

    Route::get('/reservaciones', ListarReservacionesComponent::class)
        ->name('admin.reservaciones.index')
        ->middleware('permission:consultar-reservaciones');

    // --- REGLA 5: Nueva ruta de eventos (Organizadores) ---
    Route::get('/eventos', GestionarEventos::class)
        ->name('admin.eventos.index')
        ->middleware('permission:registrar-evento|editar-evento|eliminar-evento');

    // --- REGLA 6: Nueva ruta de Sesiones (Organizadores) ---
    Route::get('/admin/sesiones', ListarSesionesComponent::class)
        ->name('admin.sesiones.index')
        ->middleware('permission:registrar-evento');

    // Rutas de Administración de Sistema
    Route::get('/usuarios', ListarUsuariosComponent::class)
        ->name('admin.usuarios.index')
        ->middleware('permission:consultar-listado-usuarios|registrar-usuario|cambiar-estatus-usuario');

    Route::get('/roles', ListarRolesComponent::class)
        ->name('admin.roles.index')
        ->middleware('permission:consultar-listado-roles|registrar-rol');
});

Route::get('/creditos', function () {
    return view('creditos');
})->name('creditos');

require __DIR__.'/auth.php';

// Para manejar errores 404
Route::fallback(function () {
    return redirect()->route('dashboard')->with('error', 'La página solicitada no existe.');
});