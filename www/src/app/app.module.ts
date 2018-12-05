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
import { LoginComponent } from './login/login.component';
import { NavbarComponent } from './navbar/navbar.component';
import { LoginLoginComponent } from './login/login-login/login-login.component';
import { LoginCadastroComponent } from './login/login-cadastro/login-cadastro.component';
import { LoginApiService } from './login-api.service';
import { AlunoFormComponent } from './aluno-form/aluno-form.component';
import { MarcarDisciplinasService } from './marcar-disciplinas.service';
import { AlunoEditarComponent } from './aluno-editar/aluno-editar.component';


@NgModule({
  declarations: [
    AppComponent,
    IndexComponent,
    CursoFormComponent,
    DisciplinaFormComponent,
    TestesBackComponent,
    CursoDisciplinasComponent,
    DisciplinaEditarComponent,
    DisciplinaCadastrarComponent,
    LoginComponent,
    NavbarComponent,
    LoginLoginComponent,
    LoginCadastroComponent,
    AlunoFormComponent,
    AlunoEditarComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
	FormsModule,
	RoutingModule,
	ReactiveFormsModule
  ],
  providers: [ ProviderService, LoginApiService, MarcarDisciplinasService ],
  bootstrap: [AppComponent]
})
export class AppModule { }
