<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Giver;

class GiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Giver::factory()->count(10)->create();
    }
}

