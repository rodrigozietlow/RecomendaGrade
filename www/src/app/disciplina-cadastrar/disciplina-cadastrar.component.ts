import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-disciplina-cadastrar',
	templateUrl: './disciplina-cadastrar.component.html',
	styleUrls: ['./disciplina-cadastrar.component.css']
})
export class DisciplinaCadastrarComponent implements OnInit {

	public disciplinaBranco:any = {
		"id" : "",
		"nome" : "",
		"periodo" : "",
		"creditos" : "",
		"cargaHoraria" : "",
		"idCurso" : "",
		"dataCadastro" : "",
		"requisitos" : []
	};
	constructor() { }

	ngOnInit() {
	}

}
