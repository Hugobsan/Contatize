<?php

namespace Database\Factories;

use App\Models\Contato;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contato>
 */
class ContatoFactory extends Factory
{
    protected $model = Contato::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'imagem' => $this->faker->imageUrl(),
            'user_id' => User::factory(),
        ];
    }
}
