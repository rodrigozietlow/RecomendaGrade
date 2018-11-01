import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable()
export class LoginApiService {

	constructor(private http: HttpClient) { }

	public login(user) {
		const opcoes = {
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			}),
			params: {
				'username': user.username,
				'senha': user.senha
			}
		};

		//return this.http.get("http://192.168.103.223/ads_desenv/ads_dev/api/login", opcoes);
		return this.http.get("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1", opcoes);
	}
}
