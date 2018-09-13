import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormControl, Validators, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-disciplina-form',
  templateUrl: './disciplina-form.component.html',
  styleUrls: ['./disciplina-form.component.css']
})
export class DisciplinaFormComponent implements OnInit {


  public curso:any;

	public objetoDisciplina = {
  	  "id" : "",
      "nomeDisciplina" : "",
      "periodo" : "",
      "creditos" : "",
      "cargaHoraria" : "",
      "idCurso" : "",
      "dataCadastro" : "",
      "requisitos" : [],
    }

    /* ESTA DANDO ERRO, VERIFICAR

    public form:FormGroup = new FormGroup({
      nomeDisciplina: new FormControl({this.objetoDisciplina.nomeDisciplina, [Validators.required, Validators.maxLength(25)]}),
      periodo: new FormControl({this.objetoDisciplina.periodo, [Validators.min(1), Validators.required]}),
      creditos: new FormControl({}),
      cargaHoraria: new FormControl({this.objetoDisciplina.cargaHoraria, [Validators.required, Validators.min(1), Validators.max(999999.99)]}),
    });
    */

    public possiveis = [];

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
      console.log(this.objetoDisciplina);

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
      });
    }

    salvarDisciplina(){
      const opcoes = {
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
        })
      };
      this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1", this.objetoDisciplina, opcoes).subscribe((dados) => {
        console.log(dados);
      });
    }

}
