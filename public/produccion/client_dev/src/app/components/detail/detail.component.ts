import { Component, OnInit } from '@angular/core';
import { Project } from '../../models/project';//el modelo
import { ProjectService } from '../../services/project.service';//los servicios
import { Global } from '../../services/global';//para tener la url base del backend
import { Router, ActivatedRoute, Params } from '@angular/router';//esto q importo son clases del router necesarias para trabajar con parametros //son servicios necesarios q luego se deben inyectar el el constructor

@Component({
  selector: 'app-detail',
  templateUrl: './detail.component.html',
  styleUrls: ['./detail.component.css'],
  providers: [ProjectService]
})
export class DetailComponent implements OnInit {
  public url: string;
  public project: Project;
  public confirm: boolean;

  constructor(
  	private _projectService: ProjectService,
  	private _router: Router,
  	private _route: ActivatedRoute
  ){
  	this.url = Global.url;
    this.confirm = false;
  }

  ngOnInit(){
  	this._route.params.subscribe(params => {//params optiene todos los parametros q llegan por la url
  		let id = params.id;

  		this.getProject(id);//llamo a esta funcion 
  	});
  }

  getProject(id){
  	this._projectService.getProject(id).subscribe(//_projectService y esta clase q se invoca q esta en project.service.ts llama a este metodo getProject(id) 
  		response => {  
  			this.project = response.project;//response.project esto me llega de la api y lo guardo en this.project q es de typo modelo
  		},
  		error => {
  			console.log(<any>error);
  		}
  	)
  }

  setConfirm(confirm){//este parametro viene de la vista con un false o un true
    this.confirm = confirm;
  }

  deleteProject(id){
  	this._projectService.deleteProject(id).subscribe(//_projectService y esta clase q se invoca q esta en project.service.ts llama a este metodo deleteProject(id)
  		response => {
				if (response.project) {
					//navigate para hacer una redireccion '/proyectos' esta es la ruta 
  				this._router.navigate(['/proyectos']);
  			}
  		},
  		error => {
  			console.log(<any>error);
  		}
  	);
  }

}
