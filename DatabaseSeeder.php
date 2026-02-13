<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            SpeakerSeeder::class,
            ParticipantSeeder::class,
            EventSeeder::class,
            EventSpeakerSeeder::class,
            EventParticipantSeeder::class,
        ]);
    }
}