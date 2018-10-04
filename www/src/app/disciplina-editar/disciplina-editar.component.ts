import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
	selector: 'app-disciplina-editar',
	templateUrl: './disciplina-editar.component.html',
	styleUrls: ['./disciplina-editar.component.css']
})
export class DisciplinaEditarComponent implements OnInit {

	public disciplina:any = {
		"id" : "",
		"nome" : "",
		"periodo" : "",
		"creditos" : "",
		"cargaHoraria" : "",
		"idCurso" : "",
		"dataCadastro" : "",
		"requisitos" : []
	};

	constructor(private route: ActivatedRoute, private http: HttpClient) { }

	ngOnInit(): void{
		let id = +this.route.snapshot.paramMap.get('id');
		console.log(id);
		this.disciplina = this.buscarDisciplina(id);
	}


	buscarDisciplina(idDisc:number):any{
		this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1").subscribe((dados) => {
			for(let i = 0; i<dados.disciplinas.length; i++){
				let disciplina = dados.disciplinas[i];
				console.log(disciplina);
				if(+disciplina.id == idDisc){
					console.log("entrou if");
					this.disciplina = disciplina;
				}
			}

		});
	}


}
