<?php

namespace Database\Factories;

use App\Models\Plataforma;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlataformaFactory extends Factory
{
    protected $model = Plataforma::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'plataforma' => $this->faker->regexify('[A-Z]{5}')
        ];
    }
}
