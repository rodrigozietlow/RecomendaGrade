import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormControl, Validators, FormGroup } from '@angular/forms';
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

	public objetoDisciplina:any = {
  	  "id" : "",
      "nomeDisciplina" : "",
      "periodo" : "",
      "creditos" : "",
      "cargaHoraria" : "",
      "idCurso" : "",
      "dataCadastro" : "",
      "requisitos" : []
    };

    public validacao():void{

      this.form = new FormGroup({
        nomeDisciplina: new FormControl(this.objetoDisciplina.nomeDisciplina, [Validators.required, Validators.maxLength(25)]),
        periodo: new FormControl(this.objetoDisciplina.periodo, [Validators.min(1),Validators.max(this.curso.qtPeriodos), Validators.required]),
        creditos: new FormControl(this.objetoDisciplina.creditos, [Validators.min(1),Validators.max(127), Validators.required]),
        cargaHoraria: new FormControl(this.objetoDisciplina.cargaHoraria, [Validators.min(1),Validators.max(this.curso.cargaMinima), Validators.required]),
      });

    }

    constructor(private http: HttpClient) { }

    ngOnInit() {
  	  this.buscarCurso();
    }

    public carregarDisciplinas():void{
      for(let i of this.curso.disciplinas){
          this.possiveis.push({
            "id" : i.id,
            "nome": i.nome
          });
      }
    }

    public adicionarRequisito():void {

      this.objetoDisciplina.requisitos.push({
        "idRequisito" : "1",
        "tipo" : "1"
      });
      console.log(this.objetoDisciplina.requisitos);

    }

    public trackByFn(index,item){
      return item.myCustomIndex; // myCustomIndex should be unique
    }

    public removerRequisito(index):void {
      console.log(index);
      this.objetoDisciplina.requisitos.splice(index, 1);
    }

    buscarCurso(){
      this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1").subscribe((dados) => {
        this.curso = dados;
        this.carregarDisciplinas();
        this.validacao();
        console.log(this.possiveis);
      });
    }

    salvarDisciplina(){
      this.objetoDisciplina.idCurso = this.curso.id;
      const opcoes = {
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
        })
      };

      this.http.post<any>("http://192.168.103.223/ads_desenv/ads_dev/api/disciplina", this.objetoDisciplina, opcoes).subscribe((dados) => {
  			console.log(dados);
  			alert("Salvo com sucesso!");
  			this.router.navigateByUrl('/curso/disciplinas');
  		});
  	}

  	voltar():void {
  		this.location.back();
  	}

}
