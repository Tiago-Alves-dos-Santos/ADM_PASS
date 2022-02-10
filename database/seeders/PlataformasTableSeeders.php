<?php

namespace Database\Seeders;

use App\Models\Plataforma;
use Illuminate\Database\Seeder;

class PlataformasTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plataforma::create([
            'plataforma' => 'AUSENTE'
        ]);
    }
}
