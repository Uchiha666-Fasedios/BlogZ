import { Component, OnInit, ViewChild } from '@angular/core';//ViewChild para recoger o seleccionar div etiqetas en ANGULAR 



@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {

  public widthSlider: number;
  //public anchuraToSlider: any;
  //public captions: boolean;
  public autor: any;
 // @ViewChild('textos') textos;//para seleccionar con ANGULAR con esto selecciono el div o la etiqeta q deseo 
  @ViewChild('textos', {static: true}) textos;
  //textos le puse al div en la vista {static: true} para q ande 


  constructor() { }

  ngOnInit() {
    //version clasica de seleccionar el id #texto y hacer un alet o lo q sea
    //var opcion_clasica = alert(document.querySelector('#texto').innerHTML);
    //version con ANGULAR
    console.log(this.textos.nativeElement.textContent);//textos es como le puse a el div nativeElement es el vector q sale por defecto y textContent es la propiedad q tiene ese vector y ahi esta el contenido 
    
  }

  getAutor(event) {
    this.autor=event;

  }

}
