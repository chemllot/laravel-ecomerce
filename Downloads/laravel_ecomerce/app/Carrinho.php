<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $fillable = ['titulo', 'descricao', 'preco', 'produto_id'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
