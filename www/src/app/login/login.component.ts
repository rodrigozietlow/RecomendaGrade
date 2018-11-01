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
		this.login = !this.login;
	}

	public loginListener(dados: any) : void {
		this.loginApi.login(dados).subscribe((response) => {
			// comentar quando lançar o login
			response = {
				"id": 35,
				"username": "Rodrigo",
				"email": "rodrigo.zietlow@gmail.com"
			};
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
}
