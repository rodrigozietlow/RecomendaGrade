import { Component, OnInit, Input } from '@angular/core';
import { ProviderService } from '../provider.service';
import { FormControl, Validators, FormGroup } from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import {Router} from '@angular/router';
import {Location} from '@angular/common';

@Component({
	selector: 'app-disciplina-form',
	templateUrl: './disciplina-form.component.html',
	styleUrls: ['./disciplina-form.component.css']
})
export class DisciplinaFormComponent implements OnInit {


	public curso:any;
	public form:FormGroup;
	public possiveis = [];
	public listPreRequisito = [];
	public listCoRequisito = [];
	@Input() public objetoDisciplina: any;


	constructor(public provider: ProviderService, private location: Location, private router: Router, private http: HttpClient) {

	}

	ngOnInit() {
		this.buscarCurso();
	}

	buscarCurso(){
		if(this.provider.curso == undefined || this.provider.observable != undefined){
			this.provider.observable.subscribe((dados) => {
				this.carregarDisciplinas();
				this.validacao();
			});
		}
		else{
			this.carregarDisciplinas();
			this.validacao();
		}
	}

	public validacao():void{
		this.form = new FormGroup({
			nome: new FormControl(this.objetoDisciplina.nome, [Validators.required, Validators.maxLength(25)]),
			periodo: new FormControl(this.objetoDisciplina.periodo, [Validators.min(1),Validators.max(this.provider.curso.qtPeriodos), Validators.required]),
			creditos: new FormControl(this.objetoDisciplina.creditos, [Validators.min(1),Validators.max(127), Validators.required]),
			cargaHoraria: new FormControl(this.objetoDisciplina.cargaHoraria, [Validators.min(1),Validators.max(this.provider.curso.cargaMinima), Validators.required]),
		});

	}


	public getPossiveis(tipo: number):any[]{
		return this.possiveis.filter((possivel) => {
			if(possivel.periodo < this.objetoDisciplina.periodo && tipo == 1) return true; // pre-requisito
			else if(possivel.periodo == this.objetoDisciplina.periodo && tipo == 2 && possivel.id != this.objetoDisciplina.id) return true; // co-requisito
			else return false;
			}
		);
	}

	public carregarDisciplinas():void{
		for(let i of this.provider.curso.disciplinas){
			this.possiveis.push({
				"id" : i.id,
				"nome": i.nome,
				"periodo": i.periodo
			});
		}

	}


	public adicionarRequisito():void {

		this.objetoDisciplina.requisitos.push({
			"idRequisito" : "1",
			"tipoRequisito" : "1"
		});

	}

	public trackByFn(index,item){
		return item.myCustomIndex; // myCustomIndex should be unique
	}

	public removerRequisito(index):void {
		this.objetoDisciplina.requisitos.splice(index, 1);
	}

	salvarDisciplina(){
		this.objetoDisciplina.idCurso = this.provider.curso.id;
		if(this.objetoDisciplina.nome.value == "" || this.objetoDisciplina.periodo.value == 0 || this.objetoDisciplina.creditos.value == 0 || this.objetoDisciplina.cargaHoraria.value == 0){

			alert('Você deve Prencher todos os campos');
		}else{

			const opcoes = {
				headers: new HttpHeaders({
					'Content-Type':  'application/json',
				})
			};
			if(this.objetoDisciplina.id != ""){
		
				this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/disciplina/"+this.objetoDisciplina.id, this.objetoDisciplina, opcoes).subscribe((dados) => {
					console.log(dados);
					alert("Editado com sucesso!");
					this.router.navigateByUrl('/curso/disciplinas');
				});
			}
			else{
				this.http.post<any>("http://192.168.103.223/ads_desenv/ads_dev/api/disciplina", this.objetoDisciplina, opcoes).subscribe((dados) => {
					console.log(dados);
					alert("Salvo com sucesso!");
					this.router.navigateByUrl('/curso/disciplinas');
				});
			}



		}

	}

	voltar():void {
		this.location.back();
	}

}
