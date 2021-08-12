import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { LoginPageForm } from './login.page.form';
import { ApiService } from 'src/app/api.service';
import { Storage } from '@ionic/storage';


@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
  form: FormGroup;
  email = '';
  password = '';

  constructor(private router: Router,
    private formBuilder: FormBuilder,
    public apiService: ApiService,
    private storage: Storage, ) { }

  ngOnInit() {
    this.form = new LoginPageForm(this.formBuilder).createForm();
  }

  registrieren(){
    this.router.navigate(['/registrieren']);
  }

  login() {
    return new Promise((_resolve) => {
      const body = {
        email: this.email,
        password: this.password
      };

   this.apiService.loginApi(body).subscribe((res: any) => {
    if (res.error !== true) {
      this.router.navigate(['/team']);
      };
    });
  });
}
}
