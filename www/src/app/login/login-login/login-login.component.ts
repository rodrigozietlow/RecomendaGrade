import { Component, OnInit, Output, EventEmitter } from '@angular/core';

@Component({
	selector: 'app-login-login',
	templateUrl: './login-login.component.html',
	styleUrls: ['./login-login.component.css']
})
export class LoginLoginComponent implements OnInit {

	public user = {
		'email': '',
		'senha': ''
	};

	@Output() login = new EventEmitter();

	constructor() { }

	ngOnInit() {
		console.log("hello");
	}

	public submit(): void {
		this.login.emit(this.user);
	}
}
