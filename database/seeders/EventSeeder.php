<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory()->create([
            'title' => 'Malawi AI Conference 2024',
            'description' => 'The premier tech event of the year!',
            'date' => '2025-11-15 09:00:00',
            'location' => 'Online',
            'available_tickets' => 500,
            'price' => 20000.00,
        ]);

        Event::factory()->create([
            'title' => 'Weekend Workshop: API Development',
            'date' => '2025-07-20 10:00:00',
            'location' => 'Tech Hub, City Center',
            'available_tickets' => 20,
            'price' => 30000.99,
        ]);

        Event::factory()->create([
            'title' => 'Malawi Industrialization Summit',
            'description' => 'Discussion on how Malawi can industrialize the didgital age',
            'date' => '2025-07-20 10:00:00',
            'location' => 'Tech Hub, City Center',
            'available_tickets' => 20,
            'price' => 30000.99,
        ]);

        // Create some default events (using the factory's default definitions)
        Event::factory()->count(10)->create();

        // Create events with specific variations using factory states

        // Events without descriptions
        Event::factory()->count(3)->withoutDescription()->create();

        // Events without locations
        Event::factory()->count(2)->withoutLocation()->create();

        // Free events
        Event::factory()->count(5)->free()->create();

        // Events with a specific number of tickets
        Event::factory()->count(7)->withTickets(30)->create();

        // Free events without descriptions
        Event::factory()->count(2)->free()->withoutDescription()->create();

    }
}
