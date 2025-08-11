<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPoint extends Model
{
    use HasFactory;
    protected $fillable = ['video_lesson_id', 'timestamp_seconds', 'event_type'];

    public function eventData()
    {
        return $this->hasOne(EventData::class, 'check_point_id', 'id');
    }
}
