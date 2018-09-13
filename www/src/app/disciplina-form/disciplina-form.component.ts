import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-disciplina-form',
  templateUrl: './disciplina-form.component.html',
  styleUrls: ['./disciplina-form.component.css']
})
export class DisciplinaFormComponent implements OnInit {

	public objetoDisciplina = {
  	  "id" : "",
      "nomeDisciplina" : "",
      "periodo" : "",
      "creditos" : "",
      "cargaHoraria" : "",
      "idCurso" : "",
      "dataCadastro" : "",
      "requisitos" : [{
        "idRequisito" : "1",
        "tipo" : "1"
      }]
    }

    public possiveis = [
      {
      "id" : "1",
      "nome" : "Dev Sis"
    },
    {
      "id" : "2",
      "nome" : "Mat 1"
    }
    ];

    constructor(private http: HttpClient) { }

    ngOnInit() {
  	  this.buscarCurso();
    }

    public carregarDisciplinas(){
      possiveis.push();
    }

    public adicionarRequisito():void {
      console.log(this.objetoCurso);

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
        this.objetoCurso = dados;
      });
    }

    salvarDisciplina(){
      const opcoes = {
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
        })
      };
      this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1", this.objetoCurso, opcoes).subscribe((dados) => {
        console.log(dados);
      });
    }

}
