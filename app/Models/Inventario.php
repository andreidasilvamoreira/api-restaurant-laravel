<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'unidade',
        'preco_custo',
        'quantidade_atual',
        'fornecedor_id',
        'restaurante_id'
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'restaurante_id');
    }

    public function itensMenu()
    {
        return $this->belongsToMany(ItemMenu::class, 'item_menu_inventario')->withPivot('quantidade_necessaria');
    }

}
