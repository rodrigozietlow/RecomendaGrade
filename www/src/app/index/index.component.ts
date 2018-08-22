import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {

  public objeto = {
	  "nome" : "Padrão"
  }

  constructor() { }

  ngOnInit() {
  }

  alertar() {
	  alert("Alo");
  }

}
