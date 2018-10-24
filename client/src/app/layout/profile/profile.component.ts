import { Cuenta } from './../../entidades/CRUD/Cuenta';
import { environment } from './../../../environments/environment';
import { Component, OnInit, ViewChild } from '@angular/core';
import { Usuario } from 'src/app/entidades/CRUD/Usuario';
import { AvatarUsuario } from 'src/app/entidades/CRUD/AvatarUsuario';
import { Router } from '@angular/router';
import { Http } from '@angular/http';
import swal from 'sweetalert2';

@Component({
    selector: 'app-profile',
    templateUrl: './profile.component.html',
    styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {
    @ViewChild('fileInput')
    fileInput;
    usuario: Usuario;
    fotoPerfil: AvatarUsuario;
    srcFoto: string;
    cuenta: Cuenta;
    clave: string;
    confirmarClave: string;
    cambiandoClave: Boolean;
    validarClave: Boolean;
    webServiceURL = environment.apiUrl;
    fotoNueva: Boolean;

    constructor(public http: Http, public router: Router) {}

    ngOnInit() {
        this.usuario = JSON.parse(sessionStorage.getItem('usuario')) as Usuario;
        this.fotoPerfil = new AvatarUsuario();
        this.cuenta = new Cuenta();
        this.validarClaveEvent();
        this.validarClave = false;
        this.cambiandoClave = false;
        this.getCuenta();
        this.getFotoPerfil();
    }

    validarClaveEvent() {
        if (this.clave == null || this.clave === '') {
            this.cambiandoClave = false;
        } else {
            this.cambiandoClave = true;
            if (
                this.clave === null ||
                this.clave === '' ||
                this.confirmarClave === null ||
                this.confirmarClave === '' ||
                this.confirmarClave !== this.clave
            ) {
                this.validarClave = false;
            } else {
                this.validarClave = true;
            }
        }
    }

    getCuenta() {
        const data = {
            columna: 'idUsuario',
            tipo_filtro: 'coincide',
            filtro: this.usuario.id
        };
        this.http
            .post(
                this.webServiceURL + 'cuenta/leer_filtrado',
                JSON.stringify(data)
            )
            .subscribe(
                r1 => {
                    if (r1.json()[0] === 0) {
                        return;
                    }
                    this.cuenta = r1.json()[0] as Cuenta;
                },
                error => {}
            );
    }

    getFotoPerfil() {
        const data = {
            columna: 'idUsuario',
            tipo_filtro: 'coincide',
            filtro: this.usuario.id
        };
        this.http
            .post(
                this.webServiceURL + 'avatarusuario/leer_filtrado',
                JSON.stringify(data)
            )
            .subscribe(
                r1 => {
                    if (r1.json()[0] === 0) {
                        this.srcFoto = 'assets/images/usuario.png';
                        return;
                    }
                    this.fotoPerfil = r1.json()[0] as AvatarUsuario;
                    this.srcFoto =
                        'data:' +
                        this.fotoPerfil.tipoArchivo +
                        ';base64,' +
                        this.fotoPerfil.adjunto;
                },
                error => {}
            );
    }

    updateClave() {
        if (!this.validarClave) {
            return;
        }
        if (!this.cambiandoClave) {
            return;
        }
        const data = {
            columna: 'idUsuario',
            tipo_filtro: 'coincide',
            filtro: this.usuario.id
        };
        this.http
            .post(
                this.webServiceURL + 'cuenta/leer_filtrado',
                JSON.stringify(data)
            )
            .subscribe(
                r => {
                    const account = r.json()[0] as Cuenta;
                    this.cuenta.id = account.id;
                    this.cuenta.clave = this.clave;
                    this.http
                        .post(
                            this.webServiceURL + 'cuenta/actualizar',
                            JSON.stringify(this.cuenta)
                        )
                        .subscribe(
                            r1 => {
                                swal({
                                    position: 'center',
                                    type: 'success',
                                    title: 'Actualizar Contraseña',
                                    text: 'Contraseña actualizada satisfactoriamente',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                this.router.navigate(['/login']);
                            },
                            error => {}
                        );
                },
                error => {}
            );
    }

    update() {
        this.http
            .post(
                this.webServiceURL + 'usuario/actualizar',
                JSON.stringify(this.usuario)
            )
            .subscribe(
                r1 => {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Actualizar Información',
                        text: 'Datos actualizados satisfactoriamente',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.router.navigate(['/login']);
                },
                error => {}
            );
    }

    actualizarCuenta() {
        if (this.fotoNueva) {
            const data = {
                columna: 'idUsuario',
                tipo_filtro: 'coincide',
                filtro: this.usuario.id
            };
            this.http
                .post(
                    this.webServiceURL + 'avatarusuario/leer_filtrado',
                    JSON.stringify(data)
                )
                .subscribe(
                    r => {
                        if (r.json()[0] === 0) {
                            this.fotoPerfil.idUsuario = this.usuario.id;
                            this.http
                                .post(
                                    this.webServiceURL + 'avatarusuario/crear',
                                    JSON.stringify(this.fotoPerfil)
                                )
                                .subscribe(
                                    r1 => {
                                        this.update();
                                    },
                                    error => {}
                                );
                        } else {
                            const foto = r.json()[0] as AvatarUsuario;
                            this.fotoPerfil.id = foto.id;
                            this.http
                                .post(
                                    this.webServiceURL +
                                        'avatarusuario/actualizar',
                                    JSON.stringify(this.fotoPerfil)
                                )
                                .subscribe(
                                    r1 => {
                                        this.update();
                                    },
                                    error => {}
                                );
                        }
                    },
                    error => {}
                );
        } else {
            this.update();
        }
    }

    CodificarArchivo(event) {
        this.fotoNueva = false;
        const reader = new FileReader();
        if (event.target.files && event.target.files.length > 0) {
            const file = event.target.files[0];
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.fotoPerfil.nombreArchivo = file.name;
                this.fotoPerfil.tipoArchivo = file.type;
                this.fotoPerfil.adjunto = reader.result.split(',')[1];
                this.srcFoto =
                    'data:' +
                    this.fotoPerfil.tipoArchivo +
                    ';base64,' +
                    this.fotoPerfil.adjunto;
                this.fotoNueva = true;
            };
        }
    }
}
