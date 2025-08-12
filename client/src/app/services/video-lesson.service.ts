import { Injectable } from '@angular/core';
import {map, Observable} from 'rxjs';
import {VideoLesson, VideoLessonsResponse} from '../interfaces/video-lesson.interface';
import {environment} from '../../environments/environment';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class VideoLessonService {
  constructor(private http: HttpClient) { }
  getVideoLessons(page: number, search: string): Observable<{ videoLessons: VideoLesson[], totalPages: number }> {
    let url = `${environment.apiUrl}/videos?page=${page}`;
    if (search) url += `&title=${search}`;
    return this.http.get<VideoLessonsResponse>(url).pipe(
      map(res => {
        const videoData = res.data.data;
        const pagination = res.data.pagination;

        return {
          videoLessons: videoData,
          totalPages: pagination.last_page
        };
      })
    );
  }
}