import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { LoginApiService } from '../login-api.service';
import { catchError, map, tap } from 'rxjs/operators';

@Component({
	selector: 'app-login',
	templateUrl: './login.component.html',
	styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

	public login = true;
	public erro: string;
	@Output() usuarioLogado = new EventEmitter();

	constructor(public loginApi: LoginApiService) { }

	ngOnInit() {
	}

	public switch() : void {
		this.erro = undefined;
		this.login = !this.login;
	}

	public loginListener(dados: any) : void {
		this.loginApi.login(dados).subscribe((response) => {
			console.log(response);
			// comentar quando lançar o login
			/*
			if(dados.username == 'coordenador') {
				response = {
					"id": 35,
					"username": "Coordenador",
					"email": "coordenador@gmail.com",
					"permissao": 2
				};
			}
			else {
				response = {
					"id": 35,
					"username": "Aluno",
					"email": "aluno@gmail.com",
					"permissao": 3
				};
			}
			*/
			localStorage.setItem("usuario", JSON.stringify(response));
			this.usuarioLogado.emit(response);
		},
		(error) => {
			if(error.status == 500) {
				this.erro = "Ops, algo deu errado no servidor";
			}
			else if(error.status == 422) {
				this.erro = "Bad request dude!";
			}
			else if(error.status == 401) {
				this.erro = "Informações incorretas";
			}
			else{
				this.erro = "Alguma coisa desconhecida aconteceu"
			}
			console.log(error);
		});
	}
	public cadastrarListener(usuario) {
		console.log(usuario);

		// se comunicar com a api através do serviço login-api
		this.loginApi.cadastrar(usuario).subscribe(
			(resposta) => {
				// recebemos um confirmação da api

				// adicionar no localStorage (linha 47)
				localStorage.setItem("usuario", JSON.stringify(resposta));

				// emitir o usuario logado para o pai (linha 48)
				this.usuarioLogado.emit(resposta);
			},
			(error) => {
				// recebemos uma rejeição da api
				if(error.status == 500) {
					this.erro = "Ops, algo deu errado no servidor";
				}
				else if(error.status == 422) {
					this.erro = "Bad request dude!";
				}
				else if(error.status == 401) {
					this.erro = "Já existe um cadastro com esse email";
				}
				else{
					this.erro = "Alguma coisa desconhecida aconteceu"
				}
				console.log(error);
			}
		);


		// caso confirmação
	}
}
