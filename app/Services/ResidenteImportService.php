<?php

namespace App\Services;

use App\Models\{
    User,Citofonia, Vehiculo, RegistroParqueadero
};
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Residente;
use App\Models\Administracion\Parqueadero;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ResidenteImportService
{
    public function importar(array $rows, string $archivoErrores): array
    {
        $resumen = [
            'usuarios' => 0,
            'residentes' => 0,
            'vehiculos' => 0,
            'parqueaderos' => 0,
            'errores' => 0,
        ];

        $conjunto = Conjunto::latest()->first();
        $errores = [];

        DB::beginTransaction();

        try {
            foreach ($rows as $index => $row) {
                try {
                    /* ================= EMAIL ================= */
                    $email = trim($row['CORREO'] ?? '');
                    if (!$email) {
                        throw new \Exception('Correo vacío');
                    }

                    /* ================= USUARIO ================= */
                    $user = User::firstOrCreate(
                        ['email' => $email],
                        [
                            'name' => $row['NOMBRE_RESIDENTE'] ?? 'Residente',
                            'password' => Hash::make($row['PASSWORD'] ?? '123456'),
                            'login_web' => 0,
                            'login_mobile' => 1,
                        ]
                    );
                    $resumen['usuarios']++;

                    /* ================= BLOQUE ================= */
                    $casa = Casas::where('nombre', 'LIKE', "Casa %{$row['CASA']}%")->first();
                    if (!$bloque) throw new \Exception('Casa no encontrada');

                    /* ================= RESIDENTE ================= */
                    Residente::firstOrCreate(
                        [
                            'casa_id' => $casa->id,
                        ],
                        [
                            'conjunto_id' => $conjunto->id,
                            'tipo_residente' => $row['TIPO_RESIDENTE'] ?? 'residente',
                            'correo' => $email,
                            'estado' => 'Activo',
                        ]
                    );
                    $resumen['residentes']++;

                    /* ================= VEHÍCULO ================= */
                    $vehiculo = null;
                    if (!empty($row['PLACA'])) {
                        $vehiculo = Vehiculo::firstOrCreate(
                            ['placa' => strtoupper($row['PLACA'])],
                            ['tipo_vehiculo' => $row['TIPO_VEHICULO'] ?? null]
                        );
                        $resumen['vehiculos']++;
                    }

                    /* ================= PARQUEADERO ================= */
                    if ($vehiculo && !empty($row['PARQUEADERO'])) {
                        $parqueadero = Parqueadero::where('nombre', 'LIKE', "%{$row['PARQUEADERO']}%")->first();

                        if ($parqueadero) {
                            RegistroParqueadero::firstOrCreate([
                                'vehiculo_id' => $vehiculo->id,
                                'parqueadero_id' => $parqueadero->id,
                                'casas_id' => $casa->id,
                            ]);
                            $resumen['parqueaderos']++;
                        }
                    }

                } catch (\Throwable $e) {
                    $errores[] = [
                        'fila' => $index + 1,
                        'error' => $e->getMessage(),
                        'correo' => $row['CORREO'] ?? '',
                    ];
                    $resumen['errores']++;
                }
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $this->exportarErroresCSV($errores, $archivoErrores);

        return $resumen;
    }

    private function exportarErroresCSV(array $errores, string $archivo)
    {
        if (empty($errores)) return;

        Storage::put($archivo, "Fila,Correo,Error\n");

        foreach ($errores as $e) {
            Storage::append(
                $archivo,
                "{$e['fila']},{$e['correo']},\"{$e['error']}\""
            );
        }
    }
}
