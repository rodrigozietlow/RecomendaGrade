import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-disciplina-editar',
  templateUrl: './disciplina-editar.component.html',
  styleUrls: ['./disciplina-editar.component.css']
})
export class DisciplinaEditarComponent implements OnInit {

	public disciplina:any = {
		"id" : "",
		"nomeDisciplina" : "",
		"periodo" : "",
		"creditos" : "",
		"cargaHoraria" : "",
		"idCurso" : "",
		"dataCadastro" : "",
		"requisitos" : []
	};

  constructor(private route: ActivatedRoute) { }

  ngOnInit(): void{
	  let id = +this.route.snapshot.paramMap.get('id');
	  console.log(id);

  }

}
