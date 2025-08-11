<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLesson extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'video_url', 'duration_seconds'];

    public function checkPoints()
    {
        return $this->hasMany(CheckPoint::class, 'video_lesson_id', 'id')
                    ->orderBy('timestamp_seconds', 'asc');
    }
}
