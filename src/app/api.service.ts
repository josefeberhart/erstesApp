import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { HttpHeaders} from '@angular/common/http';
import 'rxjs/add/operator/map';

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

loginApi(userData) {
    const headers = new HttpHeaders({
        // eslint-disable-next-line @typescript-eslint/naming-convention
       'Content-Type': 'application/json; charset=UTF-8'
    });
    const httpOptions = {
        headers: new HttpHeaders({
          // eslint-disable-next-line @typescript-eslint/naming-convention
          'Content-Type': 'application/json',
        })
    };

    return this.http.post(('http://localhost/apiionic/public/index.php/login'),
    JSON.stringify(userData), httpOptions)
    .map(res => res);
}
}
