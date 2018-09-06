import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-curso-form',
  templateUrl: './curso-form.component.html',
  styleUrls: ['./curso-form.component.css']
})
export class CursoFormComponent implements OnInit {

	public objeto = {
  	  "id" : "",
      "nomeCurso" : "",
      "nomePeriodos" : "",
      "qtPeriodos" : "",
      "cargaMinima" : "",
      "idCoordenador" : "",
      "publico" : false,
      "dataCadastro" : "",
      "disciplinas" : []
    }

    constructor(private http: HttpClient) { }

    ngOnInit() {
  	  this.buscarCurso();
    }

    buscarCurso(){
      this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1").subscribe((dados) => {
        this.objeto = dados;
      });
    }

    salvarCurso(){
      const opcoes = {
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
        })
      };
      this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1", this.objeto, opcoes).subscribe((dados) => {
        console.log(dados);
      });
    }

}
