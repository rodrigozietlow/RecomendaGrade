import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormControl, Validators, FormGroup } from '@angular/forms'

@Component({
	selector: 'app-curso-form',
	templateUrl: './curso-form.component.html',
	styleUrls: ['./curso-form.component.css']
})
export class CursoFormComponent implements OnInit {

	public curso = {
		"id" : "",
		"nomeCurso" : "",
		"nomePeriodos" : "",
		"qtPeriodos" : "",
		"cargaMinima" : "",
		"idCoordenador" : "",
		"publico" : false,
		"dataCadastro" : "",
		"disciplinas" : []
	};

	public form:FormGroup = new FormGroup({
		nomeCurso: new FormControl({value:this.curso.nomeCurso, disabled:"true"}),
		nomePeriodos: new FormControl(this.curso.nomePeriodos, [Validators.required, Validators.maxLength(25)]),
		qtPeriodos: new FormControl(this.curso.qtPeriodos, [Validators.max(127), Validators.min(1), Validators.required]),
		cargaMinima: new FormControl(this.curso.cargaMinima, [Validators.required, Validators.min(0), Validators.max(999999.99)]),
		publico: new FormControl({value:this.curso.disciplinas.length, disabled: (this.curso.disciplinas.length == 0) ? "true" : "false"}),
	});

	//public qtPeriodosControl:any = new FormControl(this.curso.qtPeriodos, [Validators.max(127), Validators.min(1), Validators.required]);

	constructor(private http: HttpClient) { }

	ngOnInit() {
		this.buscarCurso();
	}

	buscarCurso(){
		this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1").subscribe((dados) => {
			console.log(dados)
			this.curso = dados;
		});
	}

	salvarCurso(){



		const opcoes = {
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};
		this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1", this.curso, opcoes).subscribe((dados) => {
			alert("Salvo com sucesso");
			console.log(dados);
		});
	}

}
