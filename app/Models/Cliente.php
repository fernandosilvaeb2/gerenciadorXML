<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'cliente';
    protected $fillable = [
        'id','cpf','nome','logradouro','numero','bairro','municipio','uf','cep','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];
    protected $dates = ['deleted_at'];

    public function notas()
    {
        return $this->hasMany('App\Models\NotaFiscal','id_cliente','id');
    }
}
