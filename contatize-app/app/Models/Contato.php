<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'imagem',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImagemAttribute($value)
    {
        // Caso não exista um valor, retorna nulo:
        if (!$value) {
            return null;
        }

        // Caso seja um link externo, retorna o link:
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // Retorna o link completo acessível publicamente
        return asset('storage/' . $value);
    }
}
