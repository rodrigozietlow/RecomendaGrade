import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {

  public objeto = {
	"id" : "",
    "nomeCurso" : "",
    "nomePeriodos" : "",
    "qtPeriodos" : "",
    "cargaMinima" : "",
    "idCoordenador" : "",
    "publico" : "",
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
