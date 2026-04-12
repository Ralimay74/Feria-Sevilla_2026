<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caseta extends Model
{
    protected $fillable = [
        'nombre_calle', 
        'numero', 
        'numero_secuencial',
        'nombre_caseta',
        'lat', 
        'lon', 
        'tipo', 
        'descripcion', 
        'distrito', 
        'anio_feria'
    ];
    
    protected $casts = [
        'lat' => 'float',
        'lon' => 'float',
        'numero_secuencial' => 'integer',
        'anio_feria' => 'integer',
    ];

    // Búsqueda mejorada
    public function scopeBuscar($query, $calle = null, $numero = null, $nombre = null)
    {
        return $query
            ->when($calle, fn($q) => $q->where('nombre_calle', 'LIKE', "%{$calle}%"))
            ->when($numero, fn($q) => $q->where('numero', 'LIKE', "%{$numero}%"))
            ->when($nombre, fn($q) => $q->where('nombre_caseta', 'LIKE', "%{$nombre}%"));
    }
}