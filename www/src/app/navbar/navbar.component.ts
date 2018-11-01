import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
	selector: 'app-navbar',
	templateUrl: './navbar.component.html',
	styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

	@Input() usuario;
	@Output() logout = new EventEmitter();

	constructor() { }

	ngOnInit() {
	}

	clickLogout() {
		this.logout.emit();
	}
}
