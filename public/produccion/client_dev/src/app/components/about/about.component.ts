import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})
export class AboutComponent implements OnInit {
  /*pongo estas propiedades */
  public title: string;
  public subtitle: string;
  public web: string;

  constructor() {
    /*les doy el valor desde el constructor */
  	this.title = "Víctor Robles";
  	this.subtitle = "Desarrollador web y Formador";
  	this.web = "victorroblesweb.es";
  }

  ngOnInit() {
  }

}
