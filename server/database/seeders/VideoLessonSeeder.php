<?php

namespace Database\Seeders;

use App\Models\CheckPoint;
use App\Models\VideoLesson;
use Illuminate\Database\Seeder;

class VideoLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoLesson::factory()
                    ->count(3)
                    ->has(CheckPoint::factory()->count(rand(3, 5))->withEventData(), 'checkPoints')
                    ->create();
    }
}
