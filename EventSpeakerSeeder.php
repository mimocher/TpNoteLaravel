<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Database\Seeder;

class EventSpeakerSeeder extends Seeder
{
    public function run()
    {
        $events = Event::all();
        $speakers = Speaker::all();

        foreach ($events as $event) {
            $selectedSpeakers = $speakers->random(rand(1, 3));
            
            foreach ($selectedSpeakers as $speaker) {
                $event->speakers()->attach($speaker->id, [
                    'topic' => fake()->sentence(4),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}