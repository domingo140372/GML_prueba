<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula',
        'email',
        'celular',
        'direccion',
        'id_pais',
        'id_categoria',
        'created_at',
        'updated_at',
    ];
    
    /**
     * Get paises.
     */
    public function paises(): HasMany
    {
        return $this->hasMany(Paises::class);
    }

    /**
     * Get categorias.
     */
    public function categorias(): HasMany
    {
        return $this->hasMany(Categorias::class);
    }
}
