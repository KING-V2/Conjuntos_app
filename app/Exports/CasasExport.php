<?php

namespace App\Exports;

use App\Models\Administracion\Casas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CasasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Casas::select(
            'nombre',
            'telefono_uno',
            'telefono_dos',
            'telefono_tres',
            'telefono_cuatro',
            'telefono_cinco'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Telefono uno',
            'Telefono dos',
            'Telefono tres',
            'Telefono cuatro',
            'Telefono cinco',
        ];
    }
}
