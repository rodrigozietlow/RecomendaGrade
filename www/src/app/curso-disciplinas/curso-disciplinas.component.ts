import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
	selector: 'app-curso-disciplinas',
	templateUrl: './curso-disciplinas.component.html',
	styleUrls: ['./curso-disciplinas.component.css']
})
export class CursoDisciplinasComponent implements OnInit {

	public disciplinas[];

	constructor(private http: HttpClient) { }

	ngOnInit() {
		this.buscarDisciplinas();
	}

	public buscarDisciplinas(): void{
		this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1").subscribe((resposta) => {
			this.disciplinas = resposta.disciplinas;
		});
	}

}
