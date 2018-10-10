import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProviderService } from '../provider.service';


@Component({
	selector: 'app-disciplina-editar',
	templateUrl: './disciplina-editar.component.html',
	styleUrls: ['./disciplina-editar.component.css']
})
export class DisciplinaEditarComponent implements OnInit {

	public disciplina:any = {
		"id" : "",
		"nome" : "",
		"periodo" : "",
		"creditos" : "",
		"cargaHoraria" : "",
		"idCurso" : "",
		"dataCadastro" : "",
		"requisitos" : []
	};

	constructor(private route: ActivatedRoute, public provider: ProviderService) { }

	ngOnInit(): void{
		let id = +this.route.snapshot.paramMap.get('id');

		this.buscarDisciplina(id);

	}


	buscarDisciplina(idDisc:number):void{
		if(this.provider.curso == undefined || this.provider.observable != undefined){
			this.provider.observable.subscribe((dados) => {
				for(let i = 0; i<dados.disciplinas.length; i++){
					let disciplina = dados.disciplinas[i];
					if(+disciplina.id == idDisc){
						this.disciplina = disciplina;
					}
				}
			});
		}else{
			for(let i = 0; i<this.provider.curso.disciplinas.length; i++){
				let disciplina = this.provider.curso.disciplinas[i];
				if(+disciplina.id == idDisc){
					this.disciplina = disciplina;
				}
			}

		}

	}

}
