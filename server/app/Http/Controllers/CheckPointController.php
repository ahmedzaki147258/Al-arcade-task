<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckPointResource;
use Illuminate\Http\Request;
use App\Models\CheckPoint;
use App\Models\EventData;
use App\Models\VideoLesson;
use Illuminate\Support\Facades\Validator;

class CheckPointController extends Controller
{
    use ApiResponseTrait;

    public function store(Request $request, $videoLessonId) {
        $videoLesson = VideoLesson::find($videoLessonId);
        if (!$videoLesson) {
            return $this->apiResponse(null, 'The video lesson not found', 404);
        }
        
        $validator = Validator::make($request->all(), [
             // 'video_lesson_id' => 'required|exists:video_lessons,id',
            'timestamp_seconds' => 'required|integer|min:0|max:' . $videoLesson->duration_seconds,
            'event_type' => 'required|string|in:quiz,note,popup',
            'event_data' => 'required|array',
            'event_data.quiz_question' => 'required|string',
            'event_data.note' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $checkPoint = CheckPoint::create([
            'video_lesson_id' => $videoLessonId,
            'timestamp_seconds' => $request->timestamp_seconds,
            'event_type' => $request->event_type,
        ]);
        EventData::create([
            'check_point_id' => $checkPoint['id'],
            'quiz_question' => $request->event_data['quiz_question'],
            'note' => $request->event_data['note'] ?? null,
        ]);

        return $this->apiResponse(new CheckPointResource($checkPoint), 'Success create', 201);
    }

    public function destroy($id) {
        $checkPoint = CheckPoint::find($id);
        if (!$checkPoint) {
            return $this->apiResponse(null, 'The check point not found', 404);
        }
        
        $checkPoint->delete();
        return $this->apiResponse(null, 'Success delete', 200);
    }

    
    /************************************************* Bonus *************************************************/
    public function getNextEvent(Request $request, $videoLessonId) {
        $videoLesson = VideoLesson::find($videoLessonId);
        if (!$videoLesson) {
            return $this->apiResponse(null, 'The video lesson not found', 404);
        }

        $after = $request->query('after', 0);
        $nextCheckpoint = CheckPoint::where('video_lesson_id', $videoLessonId)
                                    ->where('timestamp_seconds', '>', $after)
                                    ->orderBy('timestamp_seconds', 'asc')
                                    ->first();
        if (!$nextCheckpoint) {
            return $this->apiResponse(null, 'No next checkpoint found', 404);
        }
        return $this->apiResponse(new CheckPointResource($nextCheckpoint), 'Success get next event', 200);
    }
}
