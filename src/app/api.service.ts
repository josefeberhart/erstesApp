import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';



@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(
    public http: HttpClient
  ) { }


getBeratersApi(){
    return this.http.get('http://localhost/apiionic/public/index.php/beraters');
  }

signupApi(userData){
  return this.http.post('http://localhost/apiionic/public/index.php/signup',userData);
}

}
