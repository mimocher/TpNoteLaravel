<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class EventParticipantSeeder extends Seeder
{
    public function run()
    {
        $events = Event::all();
        $participants = Participant::all();

        foreach ($events as $event) {
            $selectedParticipants = $participants->random(rand(3, 8));
            
            foreach ($selectedParticipants as $participant) {
                $event->participants()->attach($participant->id, [
                    'registered_at' => now()
                ]);
            }
        }
    }
}