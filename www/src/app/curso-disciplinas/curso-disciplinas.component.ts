import { Component, OnInit, Input } from '@angular/core';
import { ProviderService } from '../provider.service';
import { MarcarDisciplinasService } from '../marcar-disciplinas.service';
import { AppComponent } from '../app.component';
import {NgbModal, ModalDismissReasons} from '@ng-bootstrap/ng-bootstrap';


@Component({
	selector: 'app-curso-disciplinas',
	templateUrl: './curso-disciplinas.component.html',
	styleUrls: ['./curso-disciplinas.component.css']
})
export class CursoDisciplinasComponent implements OnInit {

	public usuario;
	public periodos:number[];

	public disciplinas:any[];

	constructor(public provider: ProviderService, private componentePai: AppComponent, private marcarDisciplinas: MarcarDisciplinasService) {
		this.usuario = componentePai.usuario; // this is a hack!
		this.disciplinas = [];
	}

	ngOnInit() {
		this.buscarDisciplinas();
	}

	//modal
	open(content) {
    	this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      	this.closeResult = `Closed with: ${result}`;
    	}, (reason) => {
      	this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    	});
  	}
	private getDismissReason(reason: any): string {
    	if (reason === ModalDismissReasons.ESC) {
      	return 'by pressing ESC';
    	} else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      	return 'by clicking on a backdrop';
    	} else {
      	return  `with: ${reason}`;
    	}
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



		let texto = "";
		if(relacoes.length > 0){
			texto += "A disciplina que você deseja excluir possui relação com as seguintes disciplinas:";
			relacoes.forEach((relacao) => {
				texto += "\n- "+relacao;
			});
			texto += "\n";
		}
		texto+= "Tem certeza que deseja excluir a disciplina?";

		if(confirm(texto)) {
			this.provider.excluirDisciplina(disciplinaExcluir.id).subscribe((dados) => {
				this.provider.getCurso();
			});
		}
	}

	public marcarDesmarcar(disciplina: any) {
		console.log(disciplina);
		const marcada = this.inMarcadas(disciplina);

		// verificar se está marcada


		if(marcada) {
			// const index = this.usuario.disciplinas[disciplina.idCurso].findIndex((disciplinaIt) => +disciplinaIt.id == +disciplina.id);
			// console.log(index);
			// if(index > -1) {
			//
			// 	this.usuario.disciplinas[disciplina.idCurso].splice(index, 1);
			// }
			this.marcarDisciplinas.desmarcar(disciplina.id).subscribe((response) => {
				const index = this.usuario.disciplinas[disciplina.idCurso].findIndex((disciplinaIt) => +disciplinaIt.id == +disciplina.id);
				console.log(index);
				if(index > -1) {

					this.usuario.disciplinas[disciplina.idCurso].splice(index, 1);
					localStorage.setItem("usuario", JSON.stringify(this.usuario));
				}
			});
		}
		else {
			// if(this.usuario.disciplinas[disciplina.idCurso] == undefined) {
			// 	this.usuario.disciplinas[disciplina.idCurso] = [];
			// }
			// this.usuario.disciplinas[disciplina.idCurso].push(disciplina);
			this.marcarDisciplinas.marcar(disciplina.id).subscribe((response) => {
				if(this.usuario.disciplinas[disciplina.idCurso] == undefined) {
					this.usuario.disciplinas[disciplina.idCurso] = [];
				}
				this.usuario.disciplinas[disciplina.idCurso].push(disciplina);
				localStorage.setItem("usuario", JSON.stringify(this.usuario));
			});
		}
	}

	public inMarcadas(disciplina: any) {
		if(this.usuario.disciplinas[disciplina.idCurso] == undefined) {
			return false;
		}
		return this.usuario.disciplinas[disciplina.idCurso].find((disciplinaIt) => {
			return disciplinaIt.id == disciplina.id;
		}) != undefined;
	}

	public calcularBarra(idCurso: number) {
		// console.log(this.disciplinas);
		let maxNecessario = 0;
		let atual = 0;

		if(this.disciplinas.filter((disciplinaIt) => disciplinaIt.idCurso == idCurso).length > 0) {
			maxNecessario = this.disciplinas.reduce((acc, disciplina) => (disciplina.idCurso == idCurso) ? acc + +disciplina.cargaHoraria : 0, 0);

			if(this.usuario.disciplinas[idCurso] != undefined) {
				atual = this.usuario.disciplinas[idCurso].reduce((acc, disciplina) => acc + +disciplina.cargaHoraria, 0);
			}
		}
		else {
			return 0;
		}

		if(maxNecessario == 0) {
			return 0; // divisão por 0
		}

		return Math.round((atual / maxNecessario) * 100);
	}

	public disciplinaFromId(id: number) {
		return this.disciplinas.find((disciplina) => disciplina.id == id);
	}
}
