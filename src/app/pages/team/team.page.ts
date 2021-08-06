import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from 'src/app/api.service';

@Component({
  selector: 'app-team',
  templateUrl: './team.page.html',
  styleUrls: ['./team.page.scss'],
})
export class TeamPage implements OnInit {
  beraters: any = [];

  constructor(private router: Router,
    public apiService: ApiService) {
      this.getBeraters();
    }

  ngOnInit() {
  }

zumLoader(){
  this.router.navigate(['loader']);
}

getBeraters(){
  this.apiService.getBeratersApi().subscribe((res: any) => {
    this.beraters = res;
  });
}

}
