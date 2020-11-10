import { Component, OnInit } from '@angular/core';
import { Project } from '../../models/project';//llamo al modelo
import { ProjectService } from '../../services/project.service';//llamo a los servicios //TODO ESTO CONTIEN EL SERVICIO PARA ENVIO DE PETICIONE AJAX DESDE HTTP //VA TENER LA CLASE Y LOS METODOS NECESARIOS
import { UploadService } from '../../services/upload.service';
import { Global } from '../../services/global';//llamo a la url base q es la del backend
import { Router, ActivatedRoute, Params } from '@angular/router';//esto q importo son clases del router necesarias para trabajar con parametros //son servicios necesarios q luego se deben inyectar el el constructor

@Component({
  selector: 'app-edit',
  templateUrl: '../create/create.component.html',//utilizo esta vista
  styleUrls: ['./edit.component.css'],
  providers: [ProjectService, UploadService]
})
export class EditComponent implements OnInit {
	
	public title: string;
	public project: Project;
	public save_project;
	public status: string;
	public filesToUpload: Array<File>;
	public url: string;

	constructor(
		private _projectService: ProjectService,
		private _uploadService: UploadService,
		private _route: ActivatedRoute,
		private _router: Router
	){
		this.title = "Editar proyecto";
		this.url = Global.url;
	}

  ngOnInit(){//este metodo se ejecuta en cuanto non entramos a este archico
  	this._route.params.subscribe(params => {//params optiene todos los parametros q llegan por la url
  		let id = params.id;

  		this.getProject(id);
  	});
  }

  getProject(id){
  	this._projectService.getProject(id).subscribe(
  		response => {
  			this.project = response.project;
  		},
  		error => {
  			console.log(<any>error);
  		}
  	)
  }

  onSubmit(){
  	this._projectService.updateProject(this.project).subscribe(
		response => {
  			if(response.project){
				
				// Subir la imagen
          if (this.filesToUpload) {//filesToUpload viene del evento cuando elegi la imagen entonce si hay un archivo entro al if
          	/*makeFileRequest este metodo se creo en upload.service.ts q tiene 4 parametros el primero va la url 
						el segundo va un array el tercero otro array y el cuarto una variable tipo string
						Global.url+"upload-image/"+response.project._id aca estoy poniendo la url y concatenando la accion y el id*/
					this._uploadService.makeFileRequest(Global.url+"upload-image/"+response.project._id, [], this.filesToUpload, 'image')
          //ACA CON ESTOS THEN SE DICE Q ESTOY LLAMANDO A LAS PROMESAS
            .then((result: any) => {
						this.save_project = result.project;//lo guardo para llamarlo del html
						this.status = 'success';
					});
				}else{
					this.save_project = response.project;
					this.status = 'success';
				}
				
			}else{
				this.status = 'failed';
			}
  		},
  		error => {
  			console.log(<any>error);
  		}
  	);
  }

	fileChangeEvent(fileInput: any){
		this.filesToUpload = <Array<File>>fileInput.target.files;
	}


}
