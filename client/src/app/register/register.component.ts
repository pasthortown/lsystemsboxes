import { environment } from './../../environments/environment';
import { Component, OnInit, ViewContainerRef } from '@angular/core';
import { Router } from '@angular/router';
import { Http } from '@angular/http';
import swal from 'sweetalert2';

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
    identificacion: string;
    nombres: string;
    apellidos: string;
    email: string;
    nickname: string;
    telefono: string;
    webServiceURL = environment.apiUrl;

    constructor(private http: Http, public router: Router) {
    }

    ngOnInit() {

    }

    crearCuenta() {
        const data = { identificacion: this.identificacion,
                       nombres: this.nombres,
                       apellidos: this.apellidos,
                       latitudDireccionDomicilio: 0,
                       longitudDireccionDomicilio: 0,
                       email: this.email,
                       nickname: this.nickname,
                       telefono: this.telefono
        };
        this.http
            .post(this.webServiceURL + 'login/crear_cuenta', JSON.stringify(data))
            .subscribe(
                r1 => {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Registrar Cuenta',
                        text: 'Enviaremos a tu correo electrónico, tu contraseña',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.router.navigate(['/login']);
                },
                error => {}
        );
    }
}
