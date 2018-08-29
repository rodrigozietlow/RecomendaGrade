import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-testes-back',
  templateUrl: './testes-back.component.html',
  styleUrls: ['./testes-back.component.css']
})
export class TestesBackComponent implements OnInit {

  constructor(private http: HttpClient) { }

  ngOnInit() {
  }

  public testaSalvar(){
	  const opcoes = {
		headers: new HttpHeaders({
		  'Content-Type':  'application/json',
		})
	  };

	  let envio = {
		  "id" : 1,
	      "nomeCurso" : "ADS",
	      "nomePeriodos" : "Semestre",
	      "qtPeriodos" : "7",
	      "cargaMinima" : "1200",
	      "idCoordenador" : 1,
	      "publico" : 0,
	      "dataCadastro" : "2018-08-28"
	  }

	  this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/index.php?rota=curso", envio, opcoes).subscribe((dados) => {
		console.log(dados);
	  });
  }

}
