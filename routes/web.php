<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Caseta;

Route::get('/api/casetas', function (Request $request) {
    // Unificar búsqueda: acepta ?calle=, ?nombre= o ?q=
    $rawSearch = $request->query('calle') ?? $request->query('nombre') ?? $request->query('q') ?? '';

    if (empty(trim($rawSearch))) {
        return response()->json(['error' => 'Escribe calle, número o nombre de caseta'], 400);
    }

    // 1️⃣ Normalizar: minúsculas + quitar acentos
    $search = strtolower(trim($rawSearch));
    $search = str_replace(
        ['á','é','í','ó','ú','à','è','ì','ò','ù','ä','ë','ï','ö','ü'],
        ['a','e','i','o','u','a','e','i','o','u','a','e','i','o','u'],
        $search
    );

    $query = Caseta::query();

    // 2️⃣ Búsqueda flexible en múltiples campos (ignorando acentos)
    $query->where(function($q) use ($search) {
        $like = "%{$search}%";
        $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(LOWER(nombre_caseta), 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u') LIKE ?", [$like])
          ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(LOWER(nombre_calle), 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u') LIKE ?", [$like])
          ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(LOWER(descripcion), 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u') LIKE ?", [$like])
          ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(LOWER(numero), 'á','a'), 'é','e'), 'í','i'), 'ó','o'), 'ú','u') LIKE ?", [$like]);
    });

    // 3️⃣ Limitar a 50 resultados para no saturar el móvil
    $resultados = $query->limit(50)->get()->map(fn($c) => [
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

Route::get('/', function () {
    return view('welcome');
});