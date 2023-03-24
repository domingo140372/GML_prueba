<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paises extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_pais',
        'latitud',
        'longitud',
    ];


    /**
     * Get usuarios por pais.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuarios::class);
    }
}
