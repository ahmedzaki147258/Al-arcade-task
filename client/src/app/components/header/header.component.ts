import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterModule } from '@angular/router';
import { IconsModule } from '../../icons/icons.module';
import { ThemingService } from '../../services/theming.service';

@Component({
  selector: 'app-header',
  imports: [CommonModule, RouterModule, IconsModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.css'
})
export class HeaderComponent {
  constructor(
    public themingService: ThemingService,
  ) {}

  toggleTheme() {
    const newTheme = this.themingService.currentTheme === 'dark' ? 'light' : 'dark';
    this.themingService.setTheme(newTheme);
  }
}
