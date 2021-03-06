import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { ConnectableObservable, Observable } from 'rxjs';
import {Router} from '@angular/router';

@Injectable()
export class ProviderService{

	public idCurso: number;
	public curso: any;
	public cursosDisponiveis: any;
	public observable: ConnectableObservable<any>;
	private opcoes = {
		withCredentials: true,
		headers: new HttpHeaders({
			'Content-Type':  'application/json',
		})
	};

	constructor(private http: HttpClient, private router: Router) {
	}

	public buscarCursosDisponiveis(navegar: boolean, withCredentials?:boolean) {
		const opc2 = {
			withCredentials: !withCredentials,
			headers: new HttpHeaders({
				'Content-Type':  'application/json',
			})
		}
		this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso", opc2).subscribe((cursos) => {
			this.cursosDisponiveis = cursos;
			if(cursos.length > 0) {
				this.selecionarCurso(cursos[0].id, navegar);
			}
			else {
				this.curso = undefined;
			}
		});
	}

	public getCurso(): ConnectableObservable<any>{
		this.curso = undefined;

		let obsHttp = this.http.get<any>("http://192.168.103.223/ads_desenv/ads_dev/api/curso/"+this.idCurso, this.opcoes);

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

	public selecionarCurso(idCurso: number, navegar: boolean) {
		this.idCurso = idCurso;
		this.getCurso(); // recarrega as infos do curso
		if(navegar) {
			console.log('navegando');
			this.router.navigateByUrl('/curso/disciplinas');
		}
	}

	public excluirDisciplina(idDisciplina: number): Observable<any> {
		return this.http.delete("http://192.168.103.223/ads_desenv/ads_dev/api/disciplina/"+idDisciplina, this.opcoes);
	}


}
