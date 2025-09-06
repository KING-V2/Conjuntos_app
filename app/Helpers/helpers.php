<?php

if (!function_exists('formatear_fecha')) {
    /**
     * Formatea una fecha en formato legible.
     *
     * @param string $fecha
     * @return string
     */
    function formatear_fecha($fecha)
    {
        return \Carbon\Carbon::parse($fecha)->format('d/m/Y');
    }
}

if (!function_exists('log_evento')) {
    /**
     * Registra un evento en el log de la base de datos.
     *
     * @param string $accion
     * @param array $datos
     * @return void
     */
    function log_evento($accion, $datos = [])
    {
        \DB::table('log_sistemas')->insert([
            'accion' => $accion,
            'datos' => json_encode($datos),
            'usuario_id' => auth()->id() ?? null,
            'created_at' => now(),
        ]);
    }
}
