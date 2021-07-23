import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-team',
  templateUrl: './team.page.html',
  styleUrls: ['./team.page.scss'],
})
export class TeamPage implements OnInit {

  constructor(private router: Router) { }

  ngOnInit() {
  }

zumLoader(){
  this.router.navigate(['loader']);
}

}
