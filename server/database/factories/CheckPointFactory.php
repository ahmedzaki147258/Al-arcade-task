<?php

namespace Database\Factories;

use App\Models\EventData;
use App\Models\VideoLesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckPoint>
 */
class CheckPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video_lesson_id' => VideoLesson::factory(),
            'timestamp_seconds' => $this->faker->numberBetween(0, 900),
            'event_type' => $this->faker->randomElement(['quiz', 'note', 'popup']),
        ];
    }

    public function withEventData()
    {
        return $this->has(EventData::factory(), 'eventData');
    }
}
