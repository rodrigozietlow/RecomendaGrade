import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { ConnectableObservable } from 'rxjs';

@Injectable()
export class ProviderService{

	public curso: any;
	public observable: ConnectableObservable<any>;

	constructor(private http: HttpClient) {
		this.getCurso(1);
	}

	public getCurso(id:number): ConnectableObservable<any>{
		let obsHttp = this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/"+id);

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

}
