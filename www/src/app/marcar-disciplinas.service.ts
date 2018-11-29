import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable()
export class MarcarDisciplinasService {

	constructor(private http: HttpClient) { }

	public marcar(idDisciplina: number) {
		const opcoes = {
			withCredentials: true,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};


		return this.http.post("http://192.168.103.223/ads_desenv/ads_dev/api/disciplinas-aluno/", {'idDisciplina': idDisciplina}, opcoes);
	}

	public desmarcar(idDisciplina: number) {
		const opcoes = {
			withCredentials: true,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};


		return this.http.delete("http://192.168.103.223/ads_desenv/ads_dev/api/disciplinas-aluno/"+idDisciplina, opcoes);
	}
}
