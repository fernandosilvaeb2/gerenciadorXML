<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaFiscal extends Model
{
    use SoftDeletes;
    protected $table = 'notafiscal';
    protected $fillable = [
        'id','nf','dt_emissao','id_cliente','valor','protocolo_autorizacao','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];
    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','id_cliente','id');
    }
}
