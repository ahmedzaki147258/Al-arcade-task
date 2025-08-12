import { NgModule } from '@angular/core';
import { FeatherModule } from 'angular-feather';
import { Linkedin, Mail, Github, Monitor, Sun, Moon } from 'angular-feather/icons';

// Select some icons (use an object, not an array)
const icons = {
  Linkedin,
  Mail,
  Github,
  Monitor,
  Sun,
  Moon
};

@NgModule({
  imports: [
    FeatherModule.pick(icons)
  ],
  exports: [
    FeatherModule
  ]
})
export class IconsModule { }