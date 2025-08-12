export interface VideoLesson {
  id: number;
  title: string;
  videoUrl: string;
  duration_seconds: number;
  checkPoints: CheckPoint[];
}

export interface CheckPoint {
  id: number;
  timestamp: number;
  eventType: string;
  eventData: {
    quizQuestion: string;
    note: string | null;
  };
}

export interface VideoLessonsResponse {
  data: {
    data: VideoLesson[];
    pagination: {
      last_page: number;
      current_page: number;
      per_page: number;
      total: number;
    };
  };
}
