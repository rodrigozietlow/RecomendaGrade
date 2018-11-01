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
		this.usuario = JSON.parse(localStorage.getItem("usuario"));
	}

	ngOnInit() {

	}

	setUsuario(usuario) {
		this.usuario = usuario;
	}

	unsetUsuario() {
		this.usuario = null;
		localStorage.removeItem("usuario");
	}
}
