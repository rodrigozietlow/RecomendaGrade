import { Injectable } from '@angular/core';
import { tap } from 'rxjs/operators';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable()
export class LoginApiService {

	constructor(private http: HttpClient) { }

	public login(user) {
		console.log("ApiServe");
		const opcoes = {
			withCredentials: true,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};

		let dados = JSON.stringify(user);

		return this.http.post("http://192.168.103.223/ads_desenv/ads_dev/api/login", dados, opcoes);
		//return this.http.get("http://192.168.103.223/ads_desenv/ads_dev/api/curso/1", opcoes);

		//return this.http.get("http://192.168.103.223/ads_desenv/ads_dev/api/aluno", opcoes);
	}

	public cadastrar(user) {
		const opcoes = {
			withCredentials: true,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};

		return this.http.post("http://192.168.103.223/ads_desenv/ads_dev/api/aluno", user, opcoes).pipe(
			tap((valores) => {
				const opcoes = {
					withCredentials: true,
					headers: new HttpHeaders({
						'Content-Type':  'application/json',
					})
				};
			//	this.http.get('http://192.168.103.223/ads_desenv/ads_dev/api/autosession.php', opcoes).subscribe(() => {});
			})
		);
	}

	public logout() {
		const opcoes = {
			withCredentials:true,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};

		return this.http.delete("http://192.168.103.223/ads_desenv/ads_dev/api/login/sessao", opcoes);
	}
}
