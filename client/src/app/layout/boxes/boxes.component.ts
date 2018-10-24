import { Caja } from './../../entidades/CRUD/Caja';
import { Component, OnInit, ViewChild } from '@angular/core';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { } from '@types/googlemaps';
import { Http } from '@angular/http';
import swal from 'sweetalert2';

@Component({
    selector: 'app-boxes',
    templateUrl: './boxes.component.html',
    styleUrls: ['./boxes.component.scss']
})
export class BoxesComponent implements OnInit {
    @ViewChild('gmap') gmapElement: any;
    map: google.maps.Map;
    entidades: Caja[];
    entidadSeleccionada: Caja;
    pagina: 1;
    tamanoPagina: 20;
    paginaActual: number;
    paginaUltima: number;
    registrosPorPagina: number;
    esVisibleVentanaEdicion: boolean;

    constructor(public http: Http, private modalService: NgbModal) {}

    ngOnInit() {
        this.paginaActual=1;
      this.registrosPorPagina = 5;
      this.refresh();
      this.startGoogleMap();
    }

    startGoogleMap() {
        let mapProp = {
            center: new google.maps.LatLng(-0.1943667, -78.490857),
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        this.map = new google.maps.Map(this.gmapElement.nativeElement, mapProp);
        this.permitirAgregarMarcadoresConClick();
    }

    permitirAgregarMarcadoresConClick() {
        /*const mapa = this.map;
        let caja = this.entidadSeleccionada;
        let marcadorDireccion = new google.maps.Marker({
            position: new google.maps.LatLng(usuario.latitudDireccionDomicilio, usuario.longitudDireccionDomicilio),
            map: this.map,
            draggable: true,
            title: 'Dirección'
        });
        this.map.addListener('click', function(event) {
            const location = event.latLng;
            marcadorDireccion.setPosition(location);
            usuario.latitudDireccionDomicilio = marcadorDireccion.getPosition().toJSON().lat;
            usuario.longitudDireccionDomicilio = marcadorDireccion.getPosition().toJSON().lng;
        });*/
   }

    open(content, nuevo){
        if(nuevo){
           this.resetEntidadSeleccionada();
        }
        this.modalService.open(content)
        .result
        .then((result => {
           if(result=="save"){

           }
        }),(result => {

        }));
     }

     estaSeleccionado(porVerificar): boolean {
        if (this.entidadSeleccionada == null) {
           return false;
        }
        return porVerificar.id === this.entidadSeleccionada.id;
     }

     cerrarVentanaEdicion(): void {
        this.esVisibleVentanaEdicion = false;
     }

     mostrarVentanaNuevo(): void {
        this.resetEntidadSeleccionada();
        this.esVisibleVentanaEdicion = true;
     }

     mostrarVentanaEdicion(): void {
        this.esVisibleVentanaEdicion = true;
     }

     resetEntidadSeleccionada(): void {
        this.entidadSeleccionada = this.crearEntidad();
     }

     isValid(entidadPorEvaluar: Caja): boolean {
        return true;
     }

     crearEntidad(): Caja {
        const nuevoCaja = new Caja();
        nuevoCaja.id = 0;
        return nuevoCaja;
     }

     refresh(): void {
        this.entidades = [];
        this.entidadSeleccionada = this.crearEntidad();
     }

     onSelect(entidadActual: Caja): void {
        this.entidadSeleccionada = entidadActual;
     }
}
