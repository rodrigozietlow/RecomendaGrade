import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { HttpClientModule } from '@angular/common/http';
import { FormsModule,ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { IndexComponent } from './index/index.component';
import { CursoFormComponent } from './curso-form/curso-form.component';
import { DisciplinaFormComponent } from './disciplina-form/disciplina-form.component';
import { TestesBackComponent } from './testes-back/testes-back.component';
import { CursoDisciplinasComponent } from './curso-disciplinas/curso-disciplinas.component';
import { RoutingModule } from './routing.module';
import { DisciplinaEditarComponent } from './disciplina-editar/disciplina-editar.component';
import { DisciplinaCadastrarComponent } from './disciplina-cadastrar/disciplina-cadastrar.component';
import { ProviderService } from './provider.service';


@NgModule({
  declarations: [
    AppComponent,
    IndexComponent,
    CursoFormComponent,
    DisciplinaFormComponent,
    TestesBackComponent,
    CursoDisciplinasComponent,
    DisciplinaEditarComponent,
    DisciplinaCadastrarComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
	FormsModule,
	RoutingModule,
	ReactiveFormsModule
  ],
  providers: [ ProviderService ],
  bootstrap: [AppComponent]
})
export class AppModule { }
