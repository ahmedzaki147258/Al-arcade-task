<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckPointResource extends JsonResource
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
            'timestamp_seconds'=> $this->timestamp_seconds,
            'event_type'=> $this->event_type,
            'event_data'=> new EventDataResource($this->eventData),
        ];
    }
}
