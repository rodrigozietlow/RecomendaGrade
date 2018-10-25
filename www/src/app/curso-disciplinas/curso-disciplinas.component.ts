import { Component, OnInit } from '@angular/core';
import { ProviderService } from '../provider.service';

@Component({
	selector: 'app-curso-disciplinas',
	templateUrl: './curso-disciplinas.component.html',
	styleUrls: ['./curso-disciplinas.component.css']
})
export class CursoDisciplinasComponent implements OnInit {

	public periodos:number[];

	public disciplinas:any[];

	constructor(public provider: ProviderService) {	}

	ngOnInit() {
		this.buscarDisciplinas();
	}

	public buscarDisciplinas(): void{
		if(this.provider.curso == undefined || this.provider.observable != undefined){
			this.provider.observable.subscribe((dados) => {
				this.disciplinas = dados.disciplinas;
				this.periodos = Array(+dados.qtPeriodos).fill(0).map((x,i)=>i+1);
			});
		}
		else{
			this.disciplinas = this.provider.curso.disciplinas;
			this.periodos = Array(+this.provider.curso.qtPeriodos).fill(0).map((x,i)=>i+1);
		}
	}

	public excluir(disciplinaExcluir):void {
		//console.log(disciplinaExcluir.id);

		let relacoes = [];

		const requisitosDisciplinaExcluir = disciplinaExcluir.requisitos.map((requisito) => +requisito.idRequisito);


		this.provider.curso.disciplinas.forEach((disciplina) => {
			// buscar as disciplinas que a excluida é prerequisito
			if(disciplina.requisitos.filter((requisito) => +requisito.idRequisito == +disciplinaExcluir.id).length > 0){ // alguma disciplina
				relacoes.push(disciplina.nome);
			}

			// se é um dos prerequisitos
			if(requisitosDisciplinaExcluir.indexOf(+disciplina.id) !== -1) {
				relacoes.push(disciplina.nome);
			}
		});



		let texto = " ";
		if(relacoes.length > 0){
			texto += "\nA disciplina que você deseja excluir possui relação com as seguintes disciplinas:";
			relacoes.forEach((relacao) => {
				texto += "\n- "+relacao;
			});
		}
		texto+= "\nTem certeza que deseja excluir a disciplina?";

		if(confirm(texto)) {
			this.provider.excluirDisciplina(disciplinaExcluir.id).subscribe((dados) => {
				this.provider.getCurso();
			});
		}
	}
}
