<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria',
    ];

    /**
     * Get usarios por categorias.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuarios::class);
    }
}
