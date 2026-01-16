<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantidade',
        'preco_unitario',
        'observacoes',
        'pedido_id',
        'item_menu_id',
        'inventario_id'
    ];

    public $timestamps = false;

    public function pedidos()
    {
        return $this->belongsTo(Pedido::class,'pedido_id');
    }

    public function itensMenu()
    {
        return $this->belongsTo(ItemMenu::class,'item_menu_id');
    }

    public function inventarios()
    {
        return $this->belongsTo(Inventario::class,'inventario_id');
    }
}
