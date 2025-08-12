<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoLessonResource;
use App\Models\VideoLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoLessonController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request) { 
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $title = $request->query('title');
        $videoLessons = VideoLesson::where('title', 'like', '%' . $title . '%')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate($limit, ['*'], 'page', $page);
        return $this->apiResponse([
            'data' => VideoLessonResource::collection($videoLessons),
            'pagination' => [
                'total' => $videoLessons->total(),
                'per_page' => $videoLessons->perPage(),
                'current_page' => $videoLessons->currentPage(),
                'last_page' => $videoLessons->lastPage(),
            ],
        ], 'ok', 200);
    }

    public function show($id) {
        $videoLesson = VideoLesson::with('checkPoints')->find($id);
        if(!$videoLesson){
            return $this->apiResponse(null, 'video lesson not found', 404);
        }
        return $this->apiResponse(new VideoLessonResource($videoLesson), 'ok', 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video_url' => 'required|string|max:255|url',
            'duration_seconds' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $videoLesson = VideoLesson::create([
            'title' => $request->title,
            'video_url' => $request->video_url,
            'duration_seconds' => $request->duration_seconds,
        ]);
        if($videoLesson){
            return $this->apiResponse(new VideoLessonResource($videoLesson), 'success insert', 201);
        } else{
            return $this->apiResponse((object)[], 'Failed to create the video lesson', 400);
        }  
    }
   
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'video_url' => 'sometimes|required|string|max:255|url',
            'duration_seconds' => 'sometimes|required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $videoLesson = VideoLesson::find($id);
        if (!$videoLesson) {
            return $this->apiResponse(null, 'The video lesson not found', 404);
        }

        $videoLesson->update($request->all());
        return $this->apiResponse(new VideoLessonResource($videoLesson), 'Success update', 200);
    }

    public function destroy($id) {
         $videoLesson = VideoLesson::find($id);
        if (!$videoLesson) {
            return $this->apiResponse(null, 'The video lesson not found', 404);
        }

        $videoLesson->delete();
        return $this->apiResponse(null, 'Success delete', 204);   
    }
}
