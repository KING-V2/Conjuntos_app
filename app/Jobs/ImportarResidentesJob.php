<?php

namespace App\Jobs;

use App\Services\ResidenteImportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportarResidentesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $rows;
    public string $archivoErrores;

    public function __construct(array $rows, string $archivoErrores)
    {
        $this->rows = $rows;
        $this->archivoErrores = $archivoErrores;
    }

    public function handle(ResidenteImportService $service)
    {
        $service->importar($this->rows, $this->archivoErrores);
    }
}
