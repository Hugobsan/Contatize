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

    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getTelefoneAttribute($value)
    {
        if(strlen($value) == 10)
            return "(".substr($value, 0, 2).") ".substr($value, 2, 4)."-".substr($value, 6);
        else
            return "(".substr($value, 0, 2).") ".substr($value, 2, 5)."-".substr($value, 7);
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
