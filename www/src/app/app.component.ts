import { Component, OnInit } from '@angular/core';
import { ProviderService } from './provider.service';
import { LoginApiService } from './login-api.service';

@Component({
	selector: 'app-root',
	templateUrl: './app.component.html',
	styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
	title = 'QuaseLá';

	public usuario;

	public constructor(public provider: ProviderService, public loginApi: LoginApiService) {
		if(localStorage.getItem('usuario') != undefined) {
			this.setUsuario(JSON.parse(localStorage.getItem("usuario")));
		}
	}

	ngOnInit() {

	}

	setUsuario(usuario) {
		this.usuario = usuario;
		this.provider.buscarCursosDisponiveis(true); // carregar os cursos depois de mudar de usuário o login
	}

	unsetUsuario() {
		this.loginApi.logout().subscribe(
			(sucesso) => {
				this.usuario = null;
				localStorage.removeItem("usuario");
			}
		);
	}

	trocarCursoAtual(idCurso: number) {
		this.provider.selecionarCurso(idCurso, true);
	}
}
