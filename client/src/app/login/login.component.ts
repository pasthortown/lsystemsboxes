import { environment } from './../../environments/environment';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Http } from '@angular/http';
import swal from 'sweetalert2';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
    email: string;
    clave: string;
    webServiceURL = environment.apiUrl;

    constructor(private http: Http, public router: Router) {}

    ngOnInit() {
    }

    onLogin() {
        const data = { email: this.email, clave: this.clave };
        this.http
            .post(this.webServiceURL + 'login/go', JSON.stringify(data))
            .subscribe(
                r1 => {
                    if (!r1.json()) {
                        sessionStorage.clear();
                        localStorage.clear();
                        swal({
                            position: 'center',
                            type: 'error',
                            title: 'Iniciar Sesión',
                            text: 'Los credenciales ingresados son incorrectos',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        return;
                    }
                    sessionStorage.setItem(
                        'usuario',
                        JSON.stringify(r1.json()[0])
                    );
                    localStorage.setItem('isLoggedin', 'true');
                    this.router.navigate(['/dashboard']);
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
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Recuperar Contraseña',
                        text: 'Enviaremos a tu correo electrónico, tu nueva contraseña',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                error => {}
            );
    }
}
