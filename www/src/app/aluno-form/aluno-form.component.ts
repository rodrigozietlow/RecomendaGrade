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

	public usuario = {
		"id" : "",
		"nomeAluno" : "",
		"email" : "",
		"senhaHash" : "",
		"cursos" : []
	};

	public form = new FormGroup({
		nomeAluno: new FormControl(this.usuario.nomeAluno, [Validators.required, Validators.maxLength(100)]),
		email: new FormControl(this.usuario.email, [Validators.maxLength(100), Validators.required]),
		senhaHash: new FormControl(this.usuario.senhaHash, [Validators.min(6),Validators.maxLength(100), Validators.required]),
		cursos: new FormControl(this.usuario.cursos, [Validators.required]),
	});


	constructor() { }

	ngOnInit() {
	}

	submit() {
		this.cadastro.emit();
	}



}
