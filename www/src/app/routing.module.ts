import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { IndexComponent } from './index/index.component';
import { CursoFormComponent } from './curso-form/curso-form.component';
import { CursoDisciplinasComponent } from './curso-disciplinas/curso-disciplinas.component';
import { DisciplinaEditarComponent } from './disciplina-editar/disciplina-editar.component';
import { DisciplinaCadastrarComponent } from './disciplina-cadastrar/disciplina-cadastrar.component';
import { LoginComponent } from './login/login.component';
import { AlunoEditarComponent } from './aluno-editar/aluno-editar.component';
import { CursoCadastrarComponent } from './curso-cadastrar/curso-cadastrar.component';

const rotas : Routes = [
	/* raiz e extras */
	{path: '', redirectTo: '/curso/disciplinas', pathMatch: 'full' },
	{path: 'index', component: IndexComponent},
	/* curso */
	{path: 'curso/cadastrar', component: CursoCadastrarComponent},
	{path: 'curso/editar', component: CursoFormComponent},
	{path: 'curso/disciplinas', component: CursoDisciplinasComponent},
	/* disciplina */
	{path: 'disciplinas/cadastrar', component: DisciplinaCadastrarComponent},
	{path: 'disciplinas/editar/:id', component: DisciplinaEditarComponent},
	/* login */
	{path: 'login', component: LoginComponent},
	{path: 'perfil/editar', component: AlunoEditarComponent},

];

@NgModule({
	imports : [ RouterModule.forRoot(rotas) ],
	exports : [ RouterModule ]
})

export class RoutingModule { }
