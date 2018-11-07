import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
	selector: 'app-navbar',
	templateUrl: './navbar.component.html',
	styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

	@Input() usuario;
	@Input() cursos;
	@Input() cursoSelecionado;
	@Output() logout = new EventEmitter();
	@Output() trocarCurso = new EventEmitter();

	constructor() { }

	ngOnInit() {
	}

	trocar(idCurso) {
		this.trocarCurso.emit(idCurso);
	}

	clickLogout() {
		this.logout.emit();
	}
}
