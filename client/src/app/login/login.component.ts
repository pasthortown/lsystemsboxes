import { environment } from './../../environments/environment';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Http } from '@angular/http';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
    email: string;
    clave: string;
    datosConfirmados: Boolean;
    webServiceURL = environment.apiUrl;

    constructor(private http: Http, public router: Router) {}

    ngOnInit() {
        this.datosConfirmados = true;
    }

    onLogin() {
        localStorage.setItem('isLoggedin', 'true');
        this.router.navigate(['/dashboard']);
    }

    ingresar() {
        const data = { email: this.email, clave: this.clave };
        this.http
            .post(this.webServiceURL + 'login/cuenta', JSON.stringify(data))
            .subscribe(
                r1 => {
                    if (!r1.json()) {
                        sessionStorage.clear();
                        this.datosConfirmados = false;
                        return;
                    }
                    sessionStorage.setItem(
                        'usuario',
                        JSON.stringify(r1.json()[0])
                    );
                    this.router.navigate(['/main']);
                    this.datosConfirmados = true;
                },
                error => {}
            );
    }

    recuperarClave() {
        const data = { email: this.email, accion: 'Recuperar Clave' };
        this.http
            .post(
                this.webServiceURL + 'login/passwordChange',
                JSON.stringify(data)
            )
            .subscribe(
                r1 => {
                    if (JSON.stringify(r1.json()) === '[0]') {
                        return;
                    }
                },
                error => {}
            );
    }
}
