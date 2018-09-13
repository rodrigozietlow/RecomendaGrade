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


@NgModule({
  declarations: [
    AppComponent,
    IndexComponent,
    CursoFormComponent,
    DisciplinaFormComponent,
    TestesBackComponent,
    CursoDisciplinasComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
	FormsModule,
	RoutingModule,
	ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
