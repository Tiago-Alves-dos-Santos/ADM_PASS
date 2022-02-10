<?php

namespace Database\Seeders;

use App\Models\Conta;
use App\Models\Plataforma;
use Illuminate\Database\Seeder;
use Database\Seeders\PltaformasTableSeeder;
use Database\Seeders\PlataformasTableSeeders;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        $this->call(PlataformasTableSeeders::class);
        // Conta::factory(20)->create();
        // Plataforma::factory(20)->create();
        // Conta::factory(10)->has(Plataforma::factory(10))->create();
    }
}
