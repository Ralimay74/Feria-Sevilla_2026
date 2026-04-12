<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Caseta;

Route::get('/casetas', function (Request $request) {
    $calle = $request->query('calle');
    $numero = $request->query('numero');
    $nombre = $request->query('nombre');

    if (!$calle && !$numero && !$nombre) {
        return response()->json(['error' => 'Indica calle, número o nombre de caseta'], 400);
    }

    $resultados = Caseta::buscar($calle, $numero, $nombre)->get()->map(fn($c) => [
        'id' => $c->id,
        'nombre_caseta' => $c->nombre_caseta,
        'calle' => $c->nombre_calle,
        'numero_oficial' => $c->numero,
        'numero_secuencial' => $c->numero_secuencial,
        'tipo' => $c->tipo,
        'descripcion' => $c->descripcion,
        'distrito' => $c->distrito,
        'lat' => $c->lat,
        'lon' => $c->lon,
        'coordenadas_maps' => "https://www.google.com/maps/search/?api=1&query={$c->lat},{$c->lon}"
    ]);

    return response()->json($resultados->count() ? $resultados : ['mensaje' => 'Sin resultados']);
});
