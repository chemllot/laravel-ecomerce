<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'descricao', 'imagem_capa'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
