import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { IndexComponent } from './index/index.component';
import { CursoFormComponent } from './curso-form/curso-form.component';
import { DisciplinaFormComponent } from './disciplina-form/disciplina-form.component';
import { TestesBackComponent } from './testes-back/testes-back.component';
import { DisciplinaFormComponent } from './disciplina-form/disciplina-form.component';
import { CursoDisciplinasComponent } from './curso-disciplinas/curso-disciplinas.component';



@NgModule({
  declarations: [
    AppComponent,
    IndexComponent,
    CursoFormComponent,
    DisciplinaFormComponent,
<<<<<<< HEAD
    TestesBackComponent
=======
>>>>>>> c2012402abe7c3a5ae15c2d4264d6f2fbe94e94d
    TestesBackComponent,
    CursoDisciplinasComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
	FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
