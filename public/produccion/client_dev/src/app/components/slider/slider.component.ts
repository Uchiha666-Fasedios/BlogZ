//Output para poder usar el decorador con los valores del componente hijo
//EventEmitter para crear eventos por nosotros mismos
import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';//Input para poder usar el decorador con los valores del componente padre

declare var jQuery: any;//variable global para poder acceder a ella desde cualquier parte para q ande lo de jquery
declare var $: any;//variable global para poder acceder a ella desde cualquier parte para q ande lo de jquery


@Component({
  selector: 'slider',//con este nombre puedo llamar a este componente desde cualquier vista del proyecto
  templateUrl: './slider.component.html',
  styleUrls: ['./slider.component.css']
})
export class SliderComponent implements OnInit {
//@Input() para poder usar los componentes variables etc..q vienen del componente padre
  //anchura porqe le puse ese nombre a la etiqeta desde la vista de contact.component.html
  @Input() anchura: number;
  @Output() conseguirAutor = new EventEmitter();//conseguirAutor va ser un objeto typo EventEmitter()
  
  
  public autor: any;

  constructor() {
    this.autor = {
      nombre: 'victor robles',
      website: 'victorroblesweb.es',
      youtube:'vitor robles web'
    }
   }

  ngOnInit() {

    

    /*CODIGO JQUERY */
    $("#logo").click(function(e) {//cuando le doy click al logo #logo id logo
      e.preventDefault();//preventDefault se utiliza para detener una acción por omisión,
      $("header").css("background","green")//pongo un color verde al header
        .css("height", "50px");
    });
     
    /*esta funcion es de la pagina del slider */
    $(function () {
      
      $('.galeria').bxSlider({
        mode: 'fade',
        captions: true,
        slideWidth: 400
      });
    });
    
// Lanzar evento
//this.conseguirAutor.emit(this.autor);

  }

  lanzar(event) {
    
    this.conseguirAutor.emit(this.autor);//emit para emitir un dato
  }

}
