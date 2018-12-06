import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { ProviderService } from '../provider.service';
import { AppComponent } from '../app.component';

@Component({
	selector: 'app-aluno-editar',
	templateUrl: './aluno-editar.component.html',
	styleUrls: ['./aluno-editar.component.css']
})
export class AlunoEditarComponent implements OnInit {

	public usuario;
	public cursos;

	constructor(private componentePai: AppComponent, public provider: ProviderService, private http: HttpClient) {
		this.usuario = componentePai.usuario;

		this.http.get("http://192.168.103.223/ads_desenv/ads_dev/api/curso").subscribe((cursos) => {
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
			console.log(resposta);
		});
	}

}
