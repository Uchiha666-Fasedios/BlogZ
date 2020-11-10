import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';//importamos esto para poder hacer peticiones ajax
import { FormsModule } from '@angular/forms';//importamos esto para q funcione para trabajar con formularios y [(ngModel)]
import { routing, appRoutingProviders } from './app.routing';//importamos esto para q funcione el sistema de rutas

//importamos los componentes para q funcionen
import { AppComponent } from './app.component';
import { AboutComponent } from './components/about/about.component';
import { ProjectsComponent } from './components/projects/projects.component';
import { CreateComponent } from './components/create/create.component';
import { ContactComponent } from './components/contact/contact.component';
import { ErrorComponent } from './components/error/error.component';
import { DetailComponent } from './components/detail/detail.component';
import { EditComponent } from './components/edit/edit.component';
import { SliderComponent } from './components/slider/slider.component';
import { ResaltadoDirective } from './resaltado.directive';


@NgModule({//el decorador q nos permite configurar el modulo
  declarations: [//nos sirve para cargar nuestros providers componentes y directivas
    AppComponent,
    AboutComponent,
    ProjectsComponent,
    CreateComponent,
    ContactComponent,
    ErrorComponent,
    DetailComponent,
    EditComponent,
    SliderComponent,
    ResaltadoDirective
    
  ],
  imports: [//nos sirve para cargar modulos propios de angular y q hayamos instalado 
    BrowserModule,
    routing,//modulo q cree de las rutas
    HttpClientModule,//modulo para usar peticiones http 
    FormsModule
  ],
  providers: [
    appRoutingProviders//providers nos sirve para cargar servicios appRoutingProviders es el servisio de rutas
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
