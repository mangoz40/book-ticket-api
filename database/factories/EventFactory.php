<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string<\App\Models\Event>
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => fake()->sentence(2), // More natural-sounding titles
            'description' => fake()->paragraph(3), // More natural paragraphs
            'date' => fake()->dateTimeBetween('now', '+6 months'), // More realistic timeframe
            'location' => fake()->city(), // More specific location
            'available_tickets' => fake()->numberBetween(50, 500), // More realistic ticket range
            'price' => fake()->randomFloat(2, 15000, 70000), // More realistic price range
        ];
    }

    /**
     * Indicate that the event has no description.
     *
     * @return $this
     */
    public function withoutDescription()
    {
        return $this->state(function (array $attributes) {
            return [
                'description' => null,
            ];
        });
    }

     /**
     * Indicate that the event has no location.
     *
     * @return $this
     */
    public function withoutLocation()
    {
        return $this->state(function (array $attributes) {
            return [
                'location' => null,
            ];
        });
    }

    /**
     * Indicate that the event is free (price is 0).
     *
     * @return $this
     */
    public function free()
    {
        return $this->state(function (array $attributes) {
            return [
                'price' => 0.00,
            ];
        });
    }

     /**
     * Indicate that the event has a specific number of tickets.
     *
     * @param  int  $count
     * @return $this
     */
    public function withTickets(int $count)
    {
        return $this->state(function (array $attributes) use ($count) {
            return [
                'available_tickets' => $count,
            ];
        });
    }
}