import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ProviderService } from '../provider.service';

@Component({
	selector: 'app-disciplina-cadastrar',
	templateUrl: './disciplina-cadastrar.component.html',
	styleUrls: ['./disciplina-cadastrar.component.css'],
	encapsulation: ViewEncapsulation.None
})
export class DisciplinaCadastrarComponent implements OnInit {

	public disciplinaBranco:any = {
		"id" : "",
		"nome" : "",
		"periodo" : "",
		"creditos" : "",
		"cargaHoraria" : "",
		"cor" : 0,
		"idCurso" : "",
		"dataCadastro" : "",
		"requisitos" : []
	};
	constructor(public provider: ProviderService) { }

	ngOnInit() {
	}

}
