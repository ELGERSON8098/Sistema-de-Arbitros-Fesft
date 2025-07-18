<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            // Permisos para árbitros
            'ver_arbitros',
            'crear_arbitros',
            'editar_arbitros',
            'eliminar_arbitros',
            
            // Permisos para equipos
            'ver_equipos',
            'crear_equipos',
            'editar_equipos',
            'eliminar_equipos',
            'importar_equipos',
            
            // Permisos para jornadas
            'ver_jornadas',
            'crear_jornadas',
            'editar_jornadas',
            'eliminar_jornadas',
            
            // Permisos para partidos
            'gestionar_partidos',
            
            // Permisos para asignaciones arbitrales
            'gestionar_asignaciones',
            
            // Permisos para dashboard y estadísticas
            'ver_dashboard',
            'ver_estadisticas',
            'exportar_datos',
            
            // Permisos para configuración del sistema
            'gestionar_usuarios',
            'configurar_sistema',
            
            // Permisos para página pública
            'ver_designaciones_publicas',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        
        // 1. Administrador General (acceso completo)
        $adminRole = Role::firstOrCreate(['name' => 'administrador_general']);
        $adminRole->givePermissionTo(Permission::all());

        // 2. Coordinador Arbitral (puede gestionar jornadas, partidos y asignaciones, pero no árbitros ni equipos)
        $coordinadorRole = Role::firstOrCreate(['name' => 'coordinador_arbitral']);
        $coordinadorRole->givePermissionTo([
            'ver_arbitros',
            'ver_equipos',
            'ver_jornadas',
            'crear_jornadas',
            'editar_jornadas',
            'eliminar_jornadas',
            'gestionar_partidos',
            'gestionar_asignaciones',
            'ver_dashboard',
            'ver_estadisticas',
            'exportar_datos',
            'ver_designaciones_publicas',
        ]);

        // 3. Usuario Público (acceso solo al frontend público)
        $publicoRole = Role::firstOrCreate(['name' => 'usuario_publico']);
        $publicoRole->givePermissionTo([
            'ver_designaciones_publicas',
        ]);

        // Crear usuario administrador por defecto
        $admin = User::firstOrCreate(
            ['email' => 'admin@arbitros.sv'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('administrador_general');

        // Crear usuario coordinador por defecto
        $coordinador = User::firstOrCreate(
            ['email' => 'coordinador@arbitros.sv'],
            [
                'name' => 'Coordinador Arbitral',
                'password' => bcrypt('coordinador123'),
                'email_verified_at' => now(),
            ]
        );
        $coordinador->assignRole('coordinador_arbitral');

        $this->command->info('Roles y permisos creados exitosamente.');
        $this->command->info('Usuario administrador: admin@arbitros.sv / admin123');
        $this->command->info('Usuario coordinador: coordinador@arbitros.sv / coordinador123');
    }
}


