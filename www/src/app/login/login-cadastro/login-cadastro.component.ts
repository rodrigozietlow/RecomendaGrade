import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-login-cadastro',
	templateUrl: './login-cadastro.component.html',
	styleUrls: ['./login-cadastro.component.css']
})
export class LoginCadastroComponent implements OnInit {

	public usuario = {
		'id': undefined,
		'nome': 'Nome',
		'email': 'nome@email.com',
		'senha': ''
	}

	constructor() { }

	ngOnInit() {
	}

	public realizarCadastro() {
		console.log('foi emitido um valor');
		// aqui fazer o código que se comunica com a api
		// ou podemos emitir para o pai deste e tratar na página como o login
	}

}
