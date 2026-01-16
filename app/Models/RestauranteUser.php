<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'role',
        'user_id',
        'restaurante_id',
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'restaurante_id');
    }
}
