import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-disciplina-form',
  templateUrl: './disciplina-form.component.html',
  styleUrls: ['./disciplina-form.component.css']
})
export class DisciplinaFormComponent implements OnInit {

	public objeto = {
  	  "id" : "",
      "nomeDisciplina" : "",
      "periodo" : "",
      "creditos" : "",
      "cargaHoraria" : "",
      "idCurso" : "",
      "dataCadastro" : "",
      "requisitos" : []
    }

    constructor(private http: HttpClient) { }

    ngOnInit() {
  	  //this.buscarCurso();
    }

    buscarCurso(){
      this.http.get<any>("http://localhost:80/~rodrigo/RecomendaGrade/api/curso/1").subscribe((dados) => {
        this.objeto = dados;
      });
    }

    salvarDisciplina(){
      const opcoes = {
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
        })
      };
      this.http.put<any>("http://localhost:80/~rodrigo/RecomendaGrade/api/curso/1", this.objeto, opcoes).subscribe((dados) => {
        console.log(dados);
      });
    }

}
