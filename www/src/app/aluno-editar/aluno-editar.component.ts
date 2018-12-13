import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { ProviderService } from '../provider.service';
import { AppComponent } from '../app.component';
import {Router} from '@angular/router';

@Component({
	selector: 'app-aluno-editar',
	templateUrl: './aluno-editar.component.html',
	styleUrls: ['./aluno-editar.component.css']
})
export class AlunoEditarComponent implements OnInit {

	public usuario;
	public cursos;

	constructor(private componentePai: AppComponent, public provider: ProviderService, private http: HttpClient, private router: Router) {
		this.usuario = componentePai.usuario;

		this.http.get("http://192.168.103.223/ads_desenv/ads_dev/api/curso-todos").subscribe((cursos) => {
			this.cursos = cursos;
		});
	}

	ngOnInit() {
		console.log('oninit');
	}

	realizarEdicao(user) {

		const opcoes = {
			withCredentials: true,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};

		this.http.put("http://192.168.103.223/ads_desenv/ads_dev/api/aluno/" + this.usuario.id, this.usuario, opcoes).subscribe((resposta) => {
			alert("Editado com sucesso");
			this.componentePai.setUsuario(resposta);
			// this.provider.buscarCursosDisponiveis(true);

		},
		(error) => {
			if(error.status == 401) {
				alert("Este e-mail já existe. Tente outro e-mail.");
			}
		});
	}

}
