import { Directive, ElementRef } from '@angular/core';//ElementRef esto le agrego para  manipular directamente elementos del DOM en Angular

@Directive({
  selector: '[appResaltado]'
})
export class ResaltadoDirective {

  constructor(public el: ElementRef){

  }

  ngOnInit(){
    var element = this.el.nativeElement;//aca guardo el nativeElement en element
    //cambio los colore etc..
  	    element.style.background = "blue";
  	    element.style.padding = "20px";
  	    element.style.marginTop = "15px";
  	    element.style.color = "white";
//innerText esto saca el texto toUpperCase esto lo pone en mayuscula replace esto me remplaza la palabra CONTACTO por |||| 
  	   	element.innerText = element.innerText.toUpperCase().replace("CONTACTO","||||");
  }

}

