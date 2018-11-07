import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormControl, Validators, FormGroup } from '@angular/forms';
import { Location } from '@angular/common';
import { ProviderService } from '../provider.service';

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

	periodoMin():number{
		if(this.curso.disciplinas.length>0){
			let periodos = this.curso.disciplinas.map((disciplina) => {
				return +disciplina.periodo;
			});

			console.log(Math.max(...periodos));
			return Math.max(...periodos);
		}else{
			return 1;
		}
	}

	public form:FormGroup = new FormGroup({
		nomeCurso: new FormControl({value:this.curso.nomeCurso, disabled:"true"},[Validators.maxLength(100)]),
		nomePeriodos: new FormControl(this.curso.nomePeriodos, [Validators.required, Validators.maxLength(25)]),
		qtPeriodos: new FormControl(this.curso.qtPeriodos, [Validators.max(127), Validators.min(this.periodoMin()),Validators.required]),
		cargaMinima: new FormControl(this.curso.cargaMinima, [Validators.required, Validators.min(1), Validators.max(999999.99)]),
		publico: new FormControl({value:"", disabled: (this.curso.disciplinas.length == 0) ? "true" : "false"}),

	});

	//public qtPeriodosControl:any = new FormControl(this.curso.qtPeriodos, [Validators.max(127), Validators.min(1), Validators.required]);

	constructor(private http: HttpClient, private location: Location, public provider: ProviderService) { }

	ngOnInit() {
		this.buscarCurso();
	}

	buscarCurso(){
		this.curso = {...this.provider.curso};
		if(this.curso.disciplinas.length>0){
			this.form.controls['publico'].enable();
			this.form.controls['qtPeriodos'].setValidators([Validators.max(127), Validators.min(this.periodoMin()),Validators.required]);
		}
	}

	salvarCurso():void {
		const opcoes = {
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};
		this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/"+this.provider.idCurso, this.curso, opcoes).subscribe((dados) => {
			alert("Salvo com sucesso");
			console.log(dados);
			this.provider.getCurso();
		});
	}

	voltar():void {
		this.location.back();
	}



}
