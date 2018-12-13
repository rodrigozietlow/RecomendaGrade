import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormControl, Validators, FormGroup } from '@angular/forms';
import { Location } from '@angular/common';
import { ProviderService } from '../provider.service';
import {Router} from '@angular/router';



@Component({
  selector: 'app-curso-cadastrar',
  templateUrl: './curso-cadastrar.component.html',
  styleUrls: ['./curso-cadastrar.component.css']
})
export class CursoCadastrarComponent implements OnInit {


	public form: FormGroup;

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
	public usuario = {
		"id" : "",
		"nomeAluno" : "",
		"email" : "",
		"senhaHash" : "",
		"cursos" : []
	};

  constructor(private http: HttpClient, private location: Location, private router: Router, public provider: ProviderService) { }



  ngOnInit() {

	  this.form = new FormGroup({
		  nomeCurso: new FormControl({value:this.curso.nomeCurso},[Validators.maxLength(100)]),
		  nomeAluno: new FormControl(this.usuario.nomeAluno, [Validators.required, Validators.maxLength(100)]),
		  email: new FormControl(this.usuario.email, [Validators.maxLength(100), Validators.required]),
		  senhaHash: new FormControl(this.usuario.senhaHash, [Validators.min(6),Validators.maxLength(100), Validators.required]),

	  });
  }



  salvarCurso():void {
	  const opcoes = {
		  headers: new HttpHeaders({
			  'Content-Type':  'application/json',
		  })
	  };
	  this.http.put<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/"+this.provider.idCurso, this.curso, opcoes).subscribe((dados) => {
		  alert("Salvo com sucesso");
	  //	console.log(dados);
		  this.provider.getCurso();
		  this.router.navigateByUrl('/curso/disciplinas');
	  });
  }

  voltar():void {
	  this.location.back();
  }


}
