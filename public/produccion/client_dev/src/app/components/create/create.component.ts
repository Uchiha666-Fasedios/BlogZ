import { Component, OnInit } from '@angular/core';
import { Project } from '../../models/project';
import { ProjectService } from '../../services/project.service';
import { UploadService } from '../../services/upload.service';
import { Global } from '../../services/global';//llamo a la url base q es la del backend

@Component({
  selector: 'app-create',
  templateUrl: './create.component.html',//la vista
  styleUrls: ['./create.component.css'],
  providers: [ProjectService, UploadService]//providers para usar sevicios si o si hay q cargarlos, aca lo cargo
})
export class CreateComponent implements OnInit {

	public title: string;
	public project: Project;
	public save_project;
	public status: string;
	public filesToUpload: Array<File>;

	constructor(
		private _projectService: ProjectService,//va cargar los servicios
		private _uploadService: UploadService
	){
		this.title = "Crear proyecto";
		this.project = new Project('','','','',2020,'','');//le instancio mi modelo con los parametros vacios para modificarlo con el formulario
	}

	ngOnInit() {
	}
	
	/*onSubmit(form) {
		console.log(this.project);
		this._projectService.saveProject(this.project).subscribe(
			response => {
				console.log(response);
			},
			error => {
				console.log(<any>error);
			}
		);
	}
	}*/


	onSubmit(form){
		
		// Guardar datos básicos
		//_projectService tiene el metodo saveProject lo invoco y de parametro pongo project q tiene el modelo y subscribe para subscribirme y recoger el resultado q me devuelve y este metodo tiene
		//2 funciones de kalback response y error
		this._projectService.saveProject(this.project).subscribe(
			response => {
				if(response.project){//si me llega el project con la informacion
				
				
					// Subir la imagen
					if (this.filesToUpload) {//filesToUpload viene del evento cuando elegi la imagen entonce si hay un archivo entro al if
						/*makeFileRequest este metodo se creo en upload.service.ts q tiene 4 parametros el primero va la url 
						el segundo va un array el tercero otro array y el cuarto una variable tipo string
						Global.url+"upload-image/"+response.project._id aca estoy poniendo la url y concatenando la accion y el id*/
						this._uploadService.makeFileRequest(Global.url+"upload-image/"+response.project._id, [], this.filesToUpload, 'image')//[] parametro opcional 'image' el nombre q esta en el backend en el otro proyecto el de la carpeta backend
							//ACA CON ESTOS THEN SE DICE Q ESTOY LLAMANDO A LAS PROMESAS
							.then((result: any) => {
							
								console.log(result);
								   
							this.save_project = result.project;//lo guardo para llamarlo del html

							this.status = 'success';
							//.reset() metodo ya propio de form vacia el formulario
							form.reset();
						});
					} else {
						//response.project esto va tener todo lo q me llego del formulario
						this.save_project = response.project;//lo guardo para llamarlo del html
						this.status = 'success';
						form.reset();
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
		this.filesToUpload = <Array<File>>fileInput.target.files;//<Array<File> lo casteo ..target el elemento q recivio el evento
	}


	}
	


