import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { ConnectableObservable, Observable } from 'rxjs';

@Injectable()
export class ProviderService{

	public idCurso: number;
	public curso: any;
	public observable: ConnectableObservable<any>;

	constructor(private http: HttpClient) {
		this.idCurso = 1;
		this.getCurso();
	}

	public getCurso(): ConnectableObservable<any>{

		let obsHttp = this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/"+this.idCurso);

		this.observable = ConnectableObservable.create((observer) => {
			obsHttp.subscribe(dados => observer.next(dados));
		}).publish();

		this.observable.connect();
		//this.observable = this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/"+id);

		this.observable.subscribe((dados) => {
			this.curso = dados;
			this.observable = undefined;
		});

		return this.observable;
	};

	public excluirDisciplina(idDisciplina: number): Observable<any> {
		const opcoes = {
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		};
		return this.http.delete("http://192.168.103.223/ads_desenv/ads_dev/api/disciplina/"+idDisciplina, opcoes);
	}

}
