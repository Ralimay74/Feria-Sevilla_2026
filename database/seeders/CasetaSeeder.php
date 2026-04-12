<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caseta;

class CasetaSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🎪 Generando plano completo del Real de la Feria 2026...');

        // ==================== PORTADA Y ENTRADAS PRINCIPALES ====================
        $entradas = [
            [
                'nombre_caseta' => 'Portada de la Feria 2026',
                'nombre_calle' => 'Avda. de las Delicias',
                'numero' => 's/n',
                'numero_secuencial' => null,
                'lat' => 37.3730,
                'lon' => -5.9905,
                'tipo' => 'accesibilidad',
                'descripcion' => 'Portada Principal de la Feria de Abril',
                'distrito' => 'Acceso Principal',
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Entrada Parque de los Príncipes',
                'nombre_calle' => 'Avda. Alfredo Kraus',
                'numero' => 's/n',
                'numero_secuencial' => null,
                'lat' => 37.3705,
                'lon' => -5.9915,
                'tipo' => 'accesibilidad',
                'descripcion' => 'Acceso principal desde Parque de los Príncipes',
                'distrito' => 'Acceso Sur',
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Entrada Virgen de Luján',
                'nombre_calle' => 'Calle Virgen de Luján',
                'numero' => 's/n',
                'numero_secuencial' => null,
                'lat' => 37.3710,
                'lon' => -5.9885,
                'tipo' => 'accesibilidad',
                'descripcion' => 'Acceso Este del Real',
                'distrito' => 'Acceso Este',
                'anio_feria' => 2026,
            ],
        ];

        foreach ($entradas as $e) {
            Caseta::updateOrCreate(
                ['nombre_calle' => $e['nombre_calle'], 'numero' => $e['numero']],
                $e
            );
        }

        // ==================== 🏛️ CASETAS DE DISTRITOS MUNICIPALES ====================
        $distritos = [
            [
                'nombre_caseta' => 'Caseta Distrito Casco Antiguo',
                'nombre_calle' => 'Antonio Bienvenida',
                'numero' => '97-99-101',
                'numero_secuencial' => 97,
                'tipo' => 'distrito',
                'descripcion' => 'Caseta Municipal - Distrito Casco Antiguo',
                'distrito' => 'Casco Antiguo',
                'lat' => 37.37195,
                'lon' => -5.98890,
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Distritos Sur - Bellavista - La Palmera',
                'nombre_calle' => 'Ignacio Sánchez Mejías',
                'numero' => '61-63-65',
                'numero_secuencial' => 61,
                'tipo' => 'distrito',
                'descripcion' => 'Caseta Municipal - Distritos Sur, Bellavista y La Palmera',
                'distrito' => 'Sur - Bellavista - La Palmera',
                'lat' => 37.37165,
                'lon' => -5.99065,
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Distritos Macarena - Macarena Norte',
                'nombre_calle' => 'Pascual Márquez',
                'numero' => '85-87-89',
                'numero_secuencial' => 85,
                'tipo' => 'distrito',
                'descripcion' => 'Caseta Municipal - Distritos Macarena y Macarena Norte',
                'distrito' => 'Macarena - Macarena Norte',
                'lat' => 37.37205,
                'lon' => -5.99005,
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Distritos Triana - Los Remedios',
                'nombre_calle' => 'Pascual Márquez',
                'numero' => '153-155-157',
                'numero_secuencial' => 153,
                'tipo' => 'distrito',
                'descripcion' => 'Caseta Municipal - Distritos Triana y Los Remedios',
                'distrito' => 'Triana - Los Remedios',
                'lat' => 37.37215,
                'lon' => -5.98905,
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Distritos Este - Cerro - Amate',
                'nombre_calle' => 'Pascual Márquez',
                'numero' => '215-217-219',
                'numero_secuencial' => 215,
                'tipo' => 'distrito',
                'descripcion' => 'Caseta Municipal - Distritos Este, Cerro y Amate',
                'distrito' => 'Este - Cerro - Amate',
                'lat' => 37.37225,
                'lon' => -5.98805,
                'anio_feria' => 2026,
            ],
            [
                'nombre_caseta' => 'Distritos Nervión - San Pablo - Santa Justa',
                'nombre_calle' => 'Costillares',
                'numero' => '22-24-26',
                'numero_secuencial' => 22,
                'tipo' => 'distrito',
                'descripcion' => 'Caseta Municipal - Distritos Nervión, San Pablo y Santa Justa',
                'distrito' => 'Nervión - San Pablo - Santa Justa',
                'lat' => 37.37125,
                'lon' => -5.98625,
                'anio_feria' => 2026,
            ],
        ];

        foreach ($distritos as $d) {
            Caseta::updateOrCreate(
                ['nombre_calle' => $d['nombre_calle'], 'numero' => $d['numero']],
                $d
            );
        }

        // ==================== 🔥 SERVICIOS OFICIALES ====================
        $servicios = [
            // Bomberos
            ['Bomberos Prevención', 'Antonio Bienvenida', '10', 10, 'servicio', 'Puesto de Bomberos Prevención', null, 37.37185, -5.99105],
            ['Retén de Bomberos', 'Antonio Bienvenida', '57', 57, 'servicio', 'Retén de Bomberos', null, 37.37195, -5.98895],
            ['Retén de Bomberos', 'Joselito el Gallo', '94', 94, 'servicio', 'Retén de Bomberos', null, 37.37205, -5.98795],
            ['Retén de Bomberos', 'Juan Belmonte', '195', 195, 'servicio', 'Retén Bomberos Distrito Casco Antiguo', null, 37.37215, -5.98695],
            ['Retén Principal Bomberos', 'Alfredo Kraus', 's/n', 0, 'servicio', 'Parque de los Príncipes', null, 37.37150, -5.99250],
            
            // Policía y Seguridad
            ['Policía Local', 'Manolo Vázquez', '11-13', 11, 'servicio', 'Jefatura de Policía Local', null, 37.37175, -5.99115],
            ['Comisaría de Feria', 'Alfredo Kraus', 's/n', 0, 'servicio', 'Comisaría - Centro de Denuncias', null, 37.37145, -5.99245],
            ['Protección Civil', 'Alfredo Kraus', 's/n', 0, 'servicio', 'Protección Civil Municipal', null, 37.37140, -5.99240],
            
            // Sanidad
            ['Cruz Roja', 'Alfredo Kraus', 's/n', 0, 'servicio', 'Centro Primeros Auxilios', null, 37.37155, -5.99255],
            ['Asistencia Veterinaria', 'Costillares', 's/n', 0, 'servicio', 'Asistencia Veterinaria', null, 37.37125, -5.98625],
            
            // Servicios Públicos
            ['Aseos Públicos', 'Pascual Márquez', '225-227-229', 225, 'servicio', 'Evacuatorio Público', null, 37.37225, -5.99025],
            ['Aseos Públicos', 'Costillares', '13-17', 13, 'servicio', 'Evacuatorio Público', null, 37.37120, -5.98620],
            ['Niños Perdidos', 'Gitanillo de Triana', '126', 126, 'servicio', 'Puesto de Niños Perdidos', null, 37.37165, -5.98865],
            
            // Mantenimiento
            ['Mantenimiento Eléctrico', 'Alfredo Kraus', 's/n', 0, 'servicio', 'Mantenimiento Eléctrico', null, 37.37160, -5.99260],
            ['Mantenimiento Eléctrico', 'Joselito el Gallo', '114', 114, 'servicio', 'Mantenimiento Eléctrico', null, 37.37210, -5.98810],
            
            // Administración
            ['Arbitrios y Tasas', 'Juan Belmonte', '105', 105, 'servicio', 'Arbitrios y Tasas Municipales', null, 37.37220, -5.98720],
            ['Oficina Consumidor', 'Manolo Vázquez', '11-13', 11, 'servicio', 'Información al Consumidor', null, 37.37170, -5.99110],
            ['Taller de Costura', 'Flota de Indias', '81', 81, 'servicio', 'Taller de Costura', null, 37.37130, -5.98730],
            
            // Municipales
            ['Caseta Municipal', 'Pepe Luis Vázquez', '53-57', 53, 'municipal', 'Caseta Municipal Principal', null, 37.37190, -5.98990],
            ['Caseta Municipal Pública', 'Pascual Márquez', '225-227-229', 225, 'municipal', 'Caseta Municipal Pública', null, 37.37225, -5.99025],
            ['Caseta Municipal Pública', 'Costillares', '13-17', 13, 'municipal', 'Caseta Municipal Pública', null, 37.37120, -5.98620],
        ];

        foreach ($servicios as $s) {
            Caseta::updateOrCreate(
                ['nombre_calle' => $s[1], 'numero' => $s[2]],
                [
                    'nombre_caseta' => $s[0],
                    'numero_secuencial' => $s[3],
                    'tipo' => $s[4],
                    'descripcion' => $s[5],
                    'distrito' => $s[6],
                    'lat' => $s[7],
                    'lon' => $s[8],
                    'anio_feria' => 2026,
                ]
            );
        }

        // ==================== CALLES COMPLETAS CON NUMERACIÓN ====================
        $calles = [
            'Pascual Márquez'         => ['lat_base' => 37.3725, 'lon_base' => -5.9918, 'max' => 230, 'offset_lat' => 0.0000008, 'offset_lon' => 0.000015],
            'Juan Belmonte'           => ['lat_base' => 37.3722, 'lon_base' => -5.9915, 'max' => 210, 'offset_lat' => 0.0000008, 'offset_lon' => 0.000015],
            'Joselito el Gallo'       => ['lat_base' => 37.3719, 'lon_base' => -5.9912, 'max' => 220, 'offset_lat' => 0.0000008, 'offset_lon' => 0.000015],
            'Gitanillo de Triana'     => ['lat_base' => 37.3716, 'lon_base' => -5.9910, 'max' => 180, 'offset_lat' => 0.0000008, 'offset_lon' => 0.000015],
            'Pepe Luis Vázquez'       => ['lat_base' => 37.3720, 'lon_base' => -5.9898, 'max' => 120, 'offset_lat' => 0.0000010, 'offset_lon' => 0.000008],
            'Antonio Bienvenida'      => ['lat_base' => 37.3717, 'lon_base' => -5.9900, 'max' => 140, 'offset_lat' => 0.0000010, 'offset_lon' => 0.000008],
            'Manolo Vázquez'          => ['lat_base' => 37.3721, 'lon_base' => -5.9895, 'max' => 110, 'offset_lat' => 0.0000010, 'offset_lon' => 0.000008],
            'Costillares'             => ['lat_base' => 37.3716, 'lon_base' => -5.9892, 'max' => 100, 'offset_lat' => 0.0000010, 'offset_lon' => 0.000008],
        ];

        $totalCasetas = 0;

        foreach ($calles as $calle => $datos) {
            for ($i = 1; $i <= $datos['max']; $i += 2) {
                $lat = $datos['lat_base'] + ($i * $datos['offset_lat']);
                $lon = $datos['lon_base'] + ($i * $datos['offset_lon']);

                Caseta::updateOrCreate(
                    ['nombre_calle' => $calle, 'numero_secuencial' => $i],
                    [
                        'nombre_caseta' => null,
                        'numero' => (string)$i,
                        'tipo' => 'privada',
                        'lat' => round($lat, 7),
                        'lon' => round($lon, 7),
                        'descripcion' => 'Caseta Privada',
                        'distrito' => null,
                        'anio_feria' => 2026
                    ]
                );
                $totalCasetas++;
            }

            for ($i = 2; $i <= $datos['max']; $i += 2) {
                $lat = $datos['lat_base'] + ($i * $datos['offset_lat']) + 0.000005;
                $lon = $datos['lon_base'] + ($i * $datos['offset_lon']) + 0.000003;

                Caseta::updateOrCreate(
                    ['nombre_calle' => $calle, 'numero_secuencial' => $i],
                    [
                        'nombre_caseta' => null,
                        'numero' => (string)$i,
                        'tipo' => 'privada',
                        'lat' => round($lat, 7),
                        'lon' => round($lon, 7),
                        'descripcion' => 'Caseta Privada',
                        'distrito' => null,
                        'anio_feria' => 2026
                    ]
                );
                $totalCasetas++;
            }
        }

        $this->command->info("✅ ¡PLANO COMPLETO GENERADO!");
        $this->command->info("   🎪 Portada y entradas: " . count($entradas));
        $this->command->info("   🏛️  Distritos municipales: " . count($distritos));
        $this->command->info("   🔧 Servicios oficiales: " . count($servicios));
        $this->command->info("   🎪 Casetas privadas: {$totalCasetas}");
        $this->command->info("   📍 Total: " . (count($entradas) + count($distritos) + count($servicios) + $totalCasetas));
    }
}