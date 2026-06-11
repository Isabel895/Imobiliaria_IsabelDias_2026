<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model {
    protected $fillable = ['cliente_id', 'apartamento_id', 'data_venda', 'valor_venda', 'observacoes'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function apartamento() {
        return $this->belongsTo(Apartamento::class);
    }
}
