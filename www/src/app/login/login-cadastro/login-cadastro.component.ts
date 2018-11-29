import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { ProviderService } from '../../provider.service';

@Component({
	selector: 'app-login-cadastro',
	templateUrl: './login-cadastro.component.html',
	styleUrls: ['./login-cadastro.component.css']
})
export class LoginCadastroComponent implements OnInit {

	@Output() cadastrar = new EventEmitter();
	public usuario = {
		"id" : "",
		"nomeAluno" : "",
		"email" : "",
		"senhaHash" : "",
		"cursos" : []
	};

	constructor(public provider: ProviderService) {}

	ngOnInit() {
		// ao inicializar o componente, vamos buscar os cursos disponiveis
		this.provider.buscarCursosDisponiveis();
	}

	public realizarCadastro(x:any) {
		this.cadastrar.emit(this.usuario);
	}

}
