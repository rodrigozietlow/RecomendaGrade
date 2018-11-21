import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
	selector: 'app-aluno-form',
	templateUrl: './aluno-form.component.html',
	styleUrls: ['./aluno-form.component.css']
})
export class AlunoFormComponent implements OnInit {

	@Output() cadastro = new EventEmitter();
	@Input() usuario;
	@Input() cursos;

	constructor() { }

	ngOnInit() {
	}

	submit() {
		this.cadastro.emit();
	}

}
