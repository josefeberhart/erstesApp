import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registrieren',
  templateUrl: './registrieren.page.html',
  styleUrls: ['./registrieren.page.scss'],
})
export class RegistrierenPage implements OnInit {
  vorname: any;
  nachname: any;
  email: any;
  password: any;
  telefon: any;
  strasse: any;
  plz: any;
  ort: any;

  constructor(
    private router: Router,
    public apiService: ApiService) { }

  ngOnInit() {
  }

signup() {
  const userData = {
    vorname: this.vorname,
    nachname: this.nachname,
    email: this.email,
    password: this.password,
    telefon: this.telefon,
    strasse: this.strasse,
    plz: this.plz,
    ort: this.ort,
  };
 this.apiService.signupApi(userData).subscribe((res: any) => {
   console.log('SUCCESS ===',res);
   if (res.success === true) {
   this.router.navigate(['/login']);
   }
});
}}
