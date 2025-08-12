import { Component, OnDestroy, OnInit, TemplateRef, ViewChild } from '@angular/core';
import { VideoLesson } from '../../interfaces/video-lesson.interface';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { toast } from 'ngx-sonner';
import { PaginationComponent } from '../../components/pagination/pagination.component';
import { VideoLessonService } from '../../services/video-lesson.service';

@Component({
  selector: 'app-home-page',
  imports: [
    FormsModule,
    PaginationComponent,
    CommonModule,
  ],
  templateUrl: './home-page.component.html',
  styleUrl: './home-page.component.css'
})
export class HomePageComponent implements OnInit {
  data: VideoLesson[];
  currPage: number = 1;
  totalPages: number = 1;
  searchValue: string = '';
  selectedRole: string = 'all';

  constructor(private videoLessonService: VideoLessonService) {
    this.data = [];
  }
  
  ngOnInit(): void {
    this.loadVedios(this.currPage);
  }

  goToPage(page: number) {
    this.currPage = page;
    this.loadVedios(page);
  }

  onValueChange(role: string) {
    this.selectedRole = role;
    this.loadVedios(1);
  }

  onSearchChange(searchValue: string): void {
    this.searchValue = searchValue.trim();
    this.loadVedios(1);
  }

  loadVedios(page: number) {
    this.videoLessonService.getVideoLessons(page, this.searchValue).subscribe(res => {
      this.data = res.videoLessons;
      this.totalPages = res.totalPages;
    });
  }
}
