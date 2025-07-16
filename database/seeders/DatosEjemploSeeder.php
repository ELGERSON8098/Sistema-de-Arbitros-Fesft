<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Arbitro;
use App\Models\Equipo;
use App\Models\Jornada;
use App\Models\Partido;

class DatosEjemploSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo crear árbitros si no existen
        if (Arbitro::count() == 0) {
            // Crear árbitros de ejemplo
            $arbitros = [
                [
                    'nombre' => 'Carlos',
                    'apellido' => 'Rodríguez',
                    'categoria' => 'FIFA',
                    'telefono' => '7890-1234',
                    'email' => 'carlos.rodriguez@arbitros.sv',
                    'ubicacion' => 'San Salvador',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 250
                ],
                [
                    'nombre' => 'María',
                    'apellido' => 'González',
                    'categoria' => 'Primera',
                    'telefono' => '7890-5678',
                    'email' => 'maria.gonzalez@arbitros.sv',
                    'ubicacion' => 'Santa Ana',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 120
                ],
                [
                    'nombre' => 'José',
                    'apellido' => 'Martínez',
                    'categoria' => 'Primera',
                    'telefono' => '7890-9012',
                    'email' => 'jose.martinez@arbitros.sv',
                    'ubicacion' => 'San Miguel',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 180
                ],
                [
                    'nombre' => 'Ana',
                    'apellido' => 'López',
                    'categoria' => 'Segunda',
                    'telefono' => '7890-3456',
                    'email' => 'ana.lopez@arbitros.sv',
                    'ubicacion' => 'Sonsonate',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 75
                ],
                [
                    'nombre' => 'Roberto',
                    'apellido' => 'Hernández',
                    'categoria' => 'Segunda',
                    'telefono' => '7890-7890',
                    'email' => 'roberto.hernandez@arbitros.sv',
                    'ubicacion' => 'La Libertad',
                    'estado' => 'ocupado',
                    'partidos_arbitrados' => 95
                ],
                [
                    'nombre' => 'Patricia',
                    'apellido' => 'Morales',
                    'categoria' => 'Tercera',
                    'telefono' => '7890-2468',
                    'email' => 'patricia.morales@arbitros.sv',
                    'ubicacion' => 'Ahuachapán',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 45
                ],
                [
                    'nombre' => 'Luis',
                    'apellido' => 'Ramírez',
                    'categoria' => 'Tercera',
                    'telefono' => '7890-1357',
                    'email' => 'luis.ramirez@arbitros.sv',
                    'ubicacion' => 'Usulután',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 60
                ],
                [
                    'nombre' => 'Carmen',
                    'apellido' => 'Flores',
                    'categoria' => 'Primera',
                    'telefono' => '7890-8642',
                    'email' => 'carmen.flores@arbitros.sv',
                    'ubicacion' => 'Chalatenango',
                    'estado' => 'disponible',
                    'partidos_arbitrados' => 145
                ]
            ];

            foreach ($arbitros as $arbitro) {
                Arbitro::create($arbitro);
            }
        }

        // Solo crear equipos si no existen
        if (Equipo::count() == 0) {
        $equipos = [
            // Primera División
            [
                'nombre' => 'Alianza FC',
                'division' => 'Primera',
                'sede' => 'Estadio Cuscatlán',
                'ubicacion' => 'San Salvador'
            ],
            [
                'nombre' => 'FAS',
                'division' => 'Primera',
                'sede' => 'Estadio Óscar Quiteño',
                'ubicacion' => 'Santa Ana'
            ],
            [
                'nombre' => 'CD Águila',
                'division' => 'Primera',
                'sede' => 'Estadio Juan Francisco Barraza',
                'ubicacion' => 'San Miguel'
            ],
            [
                'nombre' => 'Isidro Metapán',
                'division' => 'Primera',
                'sede' => 'Estadio Jorge Calero Suárez',
                'ubicacion' => 'Metapán'
            ],
            [
                'nombre' => 'Municipal Limeño',
                'division' => 'Primera',
                'sede' => 'Estadio Sergio Torres Rivera',
                'ubicacion' => 'Limeño'
            ],
            [
                'nombre' => 'Jocoro FC',
                'division' => 'Primera',
                'sede' => 'Estadio Las Delicias',
                'ubicacion' => 'Jocoro'
            ],
            // Segunda División
            [
                'nombre' => 'Chalatenango',
                'division' => 'Segunda',
                'sede' => 'Estadio Gregorio Martínez',
                'ubicacion' => 'Chalatenango'
            ],
            [
                'nombre' => 'Platense',
                'division' => 'Segunda',
                'sede' => 'Estadio Sergio Torres Rivera',
                'ubicacion' => 'Zacatecoluca'
            ],
            [
                'nombre' => 'Atlético Marte',
                'division' => 'Segunda',
                'sede' => 'Estadio Cuscatlán',
                'ubicacion' => 'San Salvador'
            ],
            [
                'nombre' => 'Dragón',
                'division' => 'Segunda',
                'sede' => 'Estadio Barraza',
                'ubicacion' => 'San Miguel'
            ],
            // Tercera División
            [
                'nombre' => 'Juventud Independiente',
                'division' => 'Tercera',
                'sede' => 'Estadio Municipal',
                'ubicacion' => 'San Salvador'
            ],
            [
                'nombre' => 'Deportivo Acajutla',
                'division' => 'Tercera',
                'sede' => 'Estadio Acajutla',
                'ubicacion' => 'Acajutla'
            ],
            [
                'nombre' => 'Real Sociedad',
                'division' => 'Tercera',
                'sede' => 'Estadio Tocoa',
                'ubicacion' => 'Tocoa'
            ],
            [
                'nombre' => 'Deportivo Sonsonate',
                'division' => 'Tercera',
                'sede' => 'Estadio Ana Mercedes Campos',
                'ubicacion' => 'Sonsonate'
            ]
        ];

        foreach ($equipos as $equipo) {
            Equipo::create($equipo);
        }
        }

        // Solo crear jornadas si no existen
        if (Jornada::count() == 0) {
        // Crear una jornada de ejemplo
        $jornada = Jornada::create([
            'nombre' => 'Jornada 1',
            'numero' => 1,
            'temporada' => '2024-2025',
            'division' => 'Primera',
            'fecha_inicio' => '2024-08-15',
            'fecha_fin' => '2024-08-18',
            'activa' => true
        ]);

        // Crear algunos partidos de ejemplo
        $equiposPrimera = Equipo::where('division', 'Primera')->get();
        if ($equiposPrimera->count() >= 4) {
            $partidos = [
                [
                    'jornada_id' => $jornada->id,
                    'equipo_local_id' => $equiposPrimera[0]->id,
                    'equipo_visitante_id' => $equiposPrimera[1]->id,
                    'fecha' => '2024-08-15',
                    'hora' => '19:00:00',
                    'sede' => $equiposPrimera[0]->sede,
                    'estado' => 'programado'
                ],
                [
                    'jornada_id' => $jornada->id,
                    'equipo_local_id' => $equiposPrimera[2]->id,
                    'equipo_visitante_id' => $equiposPrimera[3]->id,
                    'fecha' => '2024-08-16',
                    'hora' => '15:30:00',
                    'sede' => $equiposPrimera[2]->sede,
                    'estado' => 'programado'
                ]
            ];

            foreach ($partidos as $partido) {
                Partido::create($partido);
            }
        }
        }

        $this->command->info('Datos de ejemplo creados exitosamente.');
    }
}
