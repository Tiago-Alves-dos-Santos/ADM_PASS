<?php

namespace Database\Factories;

use App\Models\Conta;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Conta::class;
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'senha' => Str::random(15)
        ];
    }
}
