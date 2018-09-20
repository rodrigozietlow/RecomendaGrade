import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { IndexComponent } from './index/index.component';
import { CursoFormComponent } from './curso-form/curso-form.component';
import { CursoDisciplinasComponent } from './curso-disciplinas/curso-disciplinas.component';
import { DisciplinaEditarComponent } from './disciplina-editar/disciplina-editar.component';
import { DisciplinaCadastrarComponent } from './disciplina-cadastrar/disciplina-cadastrar.component';

const rotas : Routes = [
	/* raiz e extras */
	{path: '', redirectTo: '/curso/disciplinas', pathMatch: 'full' },
	{path: 'index', component: IndexComponent},
	/* curso */
	{path: 'curso/editar', component: CursoFormComponent},
	{path: 'curso/disciplinas', component: CursoDisciplinasComponent},
	/* disciplina */
	{path: 'disciplinas/cadastrar', component: DisciplinaCadastrarComponent},
	{path: 'disciplinas/editar/:id', component: DisciplinaEditarComponent},

];

@NgModule({
	imports : [ RouterModule.forRoot(rotas) ],
	exports : [ RouterModule ]
})

export class RoutingModule { }
