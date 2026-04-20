<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- ROLES ---
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'organizador']);
        Role::create(['name' => 'asistente']);
        Role::create(['name' => 'invitado']);

        /* Role::create(['name' => 'administrador']); */

        Permission::create(['name' => 'registrar-usuario']);
        Permission::create(['name' => 'consultar-listado-usuarios']);
        Permission::create(['name' => 'cambiar-estatus-usuario']);

        Permission::create(['name' => 'registrar-rol']);
        Permission::create(['name' => 'consultar-listado-roles']);

        // Nuevos permisos para el proyecto
        // Permisos para Evento y Sesiones
        Permission::create(['name' => 'consultar-listado-eventos']);
        Permission::create(['name' => 'consultar-detalle-sesiones']);
        Permission::create(['name' => 'registrar-evento']);
        Permission::create(['name' => 'editar-evento']);
        Permission::create(['name' => 'eliminar-evento']);
        Permission::create(['name' => 'visualizar-calendario']);

        // Permisos para Asistentes e Incripciones
        Permission::create(['name' => 'registrar-asistente']);
        Permission::create(['name' => 'inscribirse-eventos']);
        Permission::create(['name' => 'generar-constancia']);
        Permission::create(['name' => 'llenar-encuesta-satisfaccion']);
        Permission::create(['name' => 'consultar-resultado-encuestas']);
    
        $roleAdmin = Role::findByName('administrador');

        // Administrador
        $roleAdmin->givePermissionTo('registrar-usuario');
        $roleAdmin->givePermissionTo('consultar-listado-usuarios');
        $roleAdmin->givePermissionTo('cambiar-estatus-usuario');
        $roleAdmin->givePermissionTo('registrar-rol');
        $roleAdmin->givePermissionTo('consultar-listado-roles');
        $roleAdmin->givePermissionTo('consultar-listado-eventos');
        $roleAdmin->givePermissionTo('consultar-detalle-sesiones');
        $roleAdmin->givePermissionTo('registrar-evento');
        $roleAdmin->givePermissionTo('editar-evento');
        $roleAdmin->givePermissionTo('eliminar-evento');
        $roleAdmin->givePermissionTo('visualizar-calendario');
        $roleAdmin->givePermissionTo('registrar-asistente');
        $roleAdmin->givePermissionTo('inscribirse-eventos');
        $roleAdmin->givePermissionTo('generar-constancia');
        $roleAdmin->givePermissionTo('llenar-encuesta-satisfaccion');
        $roleAdmin->givePermissionTo('consultar-resultado-encuestas');
        // Organizador
        $roleOrg = Role::findByName('organizador');
        $roleOrg->givePermissionTo('consultar-listado-eventos');
        $roleOrg->givePermissionTo('consultar-detalle-sesiones');
        $roleOrg->givePermissionTo('registrar-evento');
        $roleOrg->givePermissionTo('editar-evento');
        $roleOrg->givePermissionTo('eliminar-evento');
        $roleOrg->givePermissionTo('registrar-asistente');
        $roleOrg->givePermissionTo('visualizar-calendario');
        $roleOrg->givePermissionTo('consultar-resultado-encuestas');
        // Asistente
        $roleAsis = Role::findByName('asistente');
        $roleAsis->givePermissionTo('consultar-listado-eventos');
        $roleAsis->givePermissionTo('consultar-detalle-sesiones');
        $roleAsis->givePermissionTo('inscribirse-eventos');
        $roleAsis->givePermissionTo('generar-constancia');
        $roleAsis->givePermissionTo('llenar-encuesta-satisfaccion');
        // Invitado
        $roleInv = Role::findByName('invitado');
        $roleInv->givePermissionTo('consultar-listado-eventos');
        $roleInv->givePermissionTo('consultar-detalle-sesiones');
        $roleInv->givePermissionTo('registrar-asistente');

        // Creacion de usuario ADMIN
        $adminUser = Usuario::create([
            'nombre' => 'Admin',
            'primer_apellido' => 'Admin',
            'segundo_apellido' => 'Admin',
            'email' => 'admin@mail.com',
            'curp' => 'AAAA000000AAAAAA00',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('administrador');

        // Creacion de usuario organizador
        $organizadorUser = Usuario::create([
            'nombre' => 'Organizador1',
            'primer_apellido' => 'Organizador1',
            'segundo_apellido' => 'Organizador1',
            'email' => 'organizador1@mail.com',
            'curp' => 'BBBB000000BBBBBB11',
            'password' => bcrypt('123456'),
        ]);
        $organizadorUser->assignRole('organizador');

        // Creacion de asistente 
        $asistenteUser = Usuario::create([
            'nombre' => 'Juan',
            'primer_apellido' => 'Perez',
            'segundo_apellido' => 'Lopez',
            'email' => 'juanL@mail.com',
            'curp' => 'BBBB111111AAAAAA11',
            'password' => bcrypt('123456'),
        ]);
        $asistenteUser->assignRole('asistente');

        // Invitado
        $invitadoUser = Usuario::create([
            'nombre' => 'Invitado',
            'primer_apellido' => 'Anonimo',
            'segundo_apellido' => 'Publico',
            'email' => 'invitado1@mail.com',
            'curp' => 'BBBB111111BBBBBB00',
            'password' => bcrypt('123456'),
        ]);
        $invitadoUser->assignRole('invitado');
    }
}
