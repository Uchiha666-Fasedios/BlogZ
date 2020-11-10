import { Injectable } from '@angular/core';//para poder hacer peticiones ajax a un servicio externo a una url externa
import { Global } from './global';//LA URL BASE DEL BACKEND

@Injectable()//decorador para no hacer new para invocar esta clase
export class UploadService{
	public url: string;

	constructor(){
		this.url = Global.url;//le cargo la url
	}

	/*creo un metodo con sus parametros
	tiene 4 parametros el primero va la url 
  el segundo va un array el tercero otro array y el cuarto una variable tipo string*/
	makeFileRequest(url: string, params: Array<string>, files: Array<File>, name: string){
		return new Promise(function(resolve, reject){//creo una promesa q tiene funcion de kalback resolve q funciono reject q hubo un problema
			var formData: any = new FormData();/*Los objetos FormData le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest . 
			Están destinados principalmente para el envío de los datos del formulario*/

			var xhr = new XMLHttpRequest();//para enviar solicitudes HTTP

			for(var i = 0; i < files.length; i++){//i < files.length mientras i sea menor q la longitud de todos los archicos q me llegan 
				formData.append(name, files[i], files[i].name);//formData.append(name se va adjuntando al formulario con el nombre ve añadiendo este archivo files[i] y files[i].name con el nombre
			}

			xhr.onreadystatechange = function(){//cuando alla algun cambio
				if(xhr.readyState == 4){//readyState describe el estado de carga del documento.
					if(xhr.status == 200){//status contiene el código de estado de la respuesta
						resolve(JSON.parse(xhr.response));//lo convierto a json
					}else{//si no error
						reject(xhr.response);
					}
				}
			}

			xhr.open('POST', url, true);//open(metodo,url) Realiza una petición de apertura de comunicación con un método que puede ser principalmente GET o POST
			xhr.send(formData);//send envía la solicitud al servidor
		});
	}

}