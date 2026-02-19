<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMenu extends Model
{
    use HasFactory;

    protected $table = 'itens_menu';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'disponibilidade',
        'categoria_id'
    ];

    public const DISPONIBILIDADE_DISPONIVEL = 'disponivel';
    public const DISPONIBILIDADE_INDISPONIVEL = 'indisponivel';

    public const DISPONIBILIDADE = [
        self::DISPONIBILIDADE_DISPONIVEL,
        self::DISPONIBILIDADE_INDISPONIVEL,
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class, 'item_menu_id');
    }

    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class, 'item_menu_inventario')->withPivot('quantidade_necessaria');
    }

}
