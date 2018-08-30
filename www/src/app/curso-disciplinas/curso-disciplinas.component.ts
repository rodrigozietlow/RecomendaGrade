import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
	selector: 'app-curso-disciplinas',
	templateUrl: './curso-disciplinas.component.html',
	styleUrls: ['./curso-disciplinas.component.css']
})
export class CursoDisciplinasComponent implements OnInit {

	public periodos[]:number;

	public disciplinas[]:any;

	constructor(private http: HttpClient) {	}

	ngOnInit() {
		this.buscarDisciplinas();
	}

	public buscarDisciplinas(): void{
		this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1").subscribe((resposta) => {
			console.log(resposta);
			this.disciplinas = resposta.disciplinas;
			this.periodos = Array(+resposta.qtPeriodos).fill(0).map((x,i)=>i);
		});
	}

}
