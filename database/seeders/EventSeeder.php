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

        // You can also combine states:
        // Free events without descriptions
        Event::factory()->count(2)->free()->withoutDescription()->create();

        // And even override specific attributes when creating events:
        Event::factory()->create([
            'title' => 'Laravel Conference 2024',
            'description' => 'The premier Laravel event of the year!',
            'date' => '2024-11-15 09:00:00',
            'location' => 'Online',
            'available_tickets' => 500,
            'price' => 99.00,
        ]);

        Event::factory()->create([
            'title' => 'Weekend Workshop: API Development',
            'date' => '2024-07-20 10:00:00',
            'location' => 'Tech Hub, City Center',
            'available_tickets' => 20,
            'price' => 49.99,
        ]);

        // You can continue to customize and create different sets of events
        // as needed for your application's initial data.
    }
}
