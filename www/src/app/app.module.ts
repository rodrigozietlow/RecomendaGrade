import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { IndexComponent } from './index/index.component';
import { CursoFormComponent } from './curso-form/curso-form.component';
import { DisciplinaFormComponent } from './disciplina-form/disciplina-form.component';


@NgModule({
  declarations: [
    AppComponent,
    IndexComponent,
    CursoFormComponent,
    DisciplinaFormComponent
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
