import { Component, OnInit } from '@angular/core';
import { ProviderService } from './provider.service';

@Component({
	selector: 'app-root',
	templateUrl: './app.component.html',
	styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
	title = 'QuaseLá';

	public usuario;

	public constructor(public provider: ProviderService) {
		if(localStorage.getItem('usuario') != undefined) {
			this.setUsuario(JSON.parse(localStorage.getItem("usuario")));
		}
	}

	ngOnInit() {

	}

	setUsuario(usuario) {
		this.usuario = usuario;
		this.provider.buscarCursosDisponiveis(); // carregar os cursos depois de mudar de usuário o login
	}

	unsetUsuario() {
		this.usuario = null;
		localStorage.removeItem("usuario");
	}

	trocarCursoAtual(idCurso: number) {
		this.provider.selecionarCurso(idCurso);
	}
}
