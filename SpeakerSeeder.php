<?php

namespace Database\Seeders;

use App\Models\Speaker;
use Illuminate\Database\Seeder;

class SpeakerSeeder extends Seeder
{
    public function run()
    {
        Speaker::factory()->count(15)->create();
    }
}