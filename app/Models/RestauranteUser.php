<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RestauranteUser extends Pivot
{
    protected $table = 'restaurante_users';

    protected $fillable = [
        'user_id',
        'restaurante_id',
        'role',
        'ativo'
    ];
}
