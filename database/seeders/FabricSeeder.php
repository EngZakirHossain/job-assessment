<?php

namespace Database\Seeders;

use App\Models\Fabric;
use Illuminate\Database\Seeder;

class FabricSeeder extends Seeder
{
    public function run(): void
    {
        Fabric::factory()->count(50)->create();
    }
}
