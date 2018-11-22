import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormControl, Validators, FormGroup } from '@angular/forms';

@Component({
	selector: 'app-aluno-form',
	templateUrl: './aluno-form.component.html',
	styleUrls: ['./aluno-form.component.css']
})
export class AlunoFormComponent implements OnInit {

	@Output() cadastro = new EventEmitter();
	@Input() usuario;
	@Input() cursos;

	public aluno = {
		"id" : "",
		"nomeAluno" : "",
		"email" : "",
		"senha" : "",
		"cursos" : []
	};

	public form = new FormGroup({
		nomeAluno: new FormControl(this.aluno.nomeAluno, [Validators.required, Validators.maxLength(100)]),
		email: new FormControl(this.aluno.email, [Validators.maxLength(100), Validators.required]),
		senha: new FormControl(this.aluno.senha, [Validators.min(6),Validators.maxLength(100), Validators.required]),
		cursos: new FormControl(this.aluno.cursos, [Validators.required]),
	});


	constructor() { }

	ngOnInit() {
	}

	submit() {
		this.cadastro.emit();
	}



}
