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

	public excluir(idDisciplina: number):void {

		console.log("Log!");
	}
}
