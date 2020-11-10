import { Component, OnInit } from '@angular/core';
import { Project } from '../../models/project';//llamo al modelos
import { ProjectService } from '../../services/project.service';//llamo a los servicios //TODO ESTO CONTIEN EL SERVICIO PARA ENVIO DE PETICIONE AJAX DESDE HTTP //VA TENER LA CLASE Y LOS METODOS NECESARIOS
import { Global } from '../../services/global';//llamo a la url base del backend

@Component({
  selector: 'app-projects',
  templateUrl: './projects.component.html',//la vista
  styleUrls: ['./projects.component.css'],
  providers: [ProjectService]//providers para usar sevicios si o si hay q cargarlos, aca lo cargo
})
export class ProjectsComponent implements OnInit {
  public projects: Project[];
  public url: string;

  constructor(
  	private _projectService: ProjectService//cargo los servicios aca para iyectarlos
  ){
  	this.url = Global.url;
  }

  ngOnInit(){
  	this.getProjects();//esto se ejecuta solo al cargar este este archivo ,componente
  }

  getProjects(){//nombre del metodo q estoy creando
  	this._projectService.getProjects().subscribe(//_projectService esta clase tiene todos los servicios y contiene todos los metodo q yo cree getProjects metodo q yo cree y trae todos los proyectos del backend
      /*subscribe para subscribirme y recoger el resultado q me devuelve y este metodo tiene 
    2 funciones de kalback una q recoge el resultado y otra q recoge el posible error*/
      response => {//response tiene la informacion o sea todos los proyectos
  			if(response.projects){/*response obtengo la informacion projects tiene el modelo con todos los datos */
  				this.projects = response.projects;//el resultado lo pongo en el vector
  			}
  		},
  		error => {
  			console.log(<any>error);
  		}
  	);
  }

}
