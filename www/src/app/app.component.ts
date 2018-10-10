import { Component } from '@angular/core';
import { ProviderService } from './provider.service';

@Component({
	selector: 'app-root',
	templateUrl: './app.component.html',
	styleUrls: ['./app.component.css']
})
export class AppComponent {
	title = 'QuaseLá';

	public constructor(public provider: ProviderService) {	}
}
