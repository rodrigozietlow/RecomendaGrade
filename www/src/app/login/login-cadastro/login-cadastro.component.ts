import { Component, OnInit, Output, EventEmitter } from '@angular/core';

@Component({
	selector: 'app-login-cadastro',
	templateUrl: './login-cadastro.component.html',
	styleUrls: ['./login-cadastro.component.css']
})
export class LoginCadastroComponent implements OnInit {

	@Output() cadastrar = new EventEmitter();
	public usuario = {
		'id': undefined,
		'nomeAluno': '',
		'email': '',
		'senhaHash': ''
	}

	constructor() { }

	ngOnInit() {
	}

	public realizarCadastro() {
		this.cadastrar.emit(this.usuario);
	}

}
