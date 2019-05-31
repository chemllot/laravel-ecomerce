<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['categoria_id', 'titulo', 'descricao', 'image', 'preco', 'destaque'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function carrinho()
    {
        return $this->belongsTo(Carrinho::class);
    }
}
