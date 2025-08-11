<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'video_url'=> $this->video_url,
            'duration_seconds'=> $this->duration_seconds,
            'check_points' => CheckPointResource::collection($this->whenLoaded('checkPoints')), // lazy load 
        ];
    }
}
