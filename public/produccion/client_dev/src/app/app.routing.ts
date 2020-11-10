// Importar modulos del router de angular
import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// Importar componentes
import { AboutComponent } from './components/about/about.component';
import { ProjectsComponent } from './components/projects/projects.component';
import { CreateComponent } from './components/create/create.component';
import { ContactComponent } from './components/contact/contact.component';
import { ErrorComponent } from './components/error/error.component';
import { DetailComponent } from './components/detail/detail.component';
import { EditComponent } from './components/edit/edit.component';


// Array de rutas creo un array q contienen todas las rutas
//path va el nombre de la pagina la ruta este path: '' seria vacio o sea la primera ruta q se carga 
//component: va el componente q quiero q se carge
const appRoutes: Routes = [
	{path: '', component: AboutComponent},
	{path: 'sobre-mi', component: AboutComponent},
	{path: 'proyectos', component: ProjectsComponent},
	{path: 'crear-proyecto', component: CreateComponent},
	{path: 'contacto', component: ContactComponent},
	{path: 'proyecto/:id', component: DetailComponent},
	{path: 'editar-proyecto/:id', component: EditComponent},
	{path: '**', component: ErrorComponent}
];

// Exportar el modulo del router
//luego hay q importar todo al app.module.ts
//para q funcionen los servicios de ruta a nivel interno

export const appRoutingProviders: any[] = [];
//aca cargamos el array de rutas appRoutes
export const routing: ModuleWithProviders<any> = RouterModule.forRoot(appRoutes);
