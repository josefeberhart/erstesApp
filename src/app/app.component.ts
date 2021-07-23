import { Component } from '@angular/core';
@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {
  public appPages = [
    { title: 'Team', url: '/team', icon: 'man' },
    { title: 'Standort', url: '/standort', icon: 'home' },
    { title: 'Login', url: '/login', icon: 'enter' },
  ];
  public labels = ['Family', 'Friends', 'Notes', 'Work', 'Travel', 'Reminders'];
  constructor() {}
}
