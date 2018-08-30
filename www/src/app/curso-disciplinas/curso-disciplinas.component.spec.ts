import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CursoDisciplinasComponent } from './curso-disciplinas.component';

describe('CursoDisciplinasComponent', () => {
  let component: CursoDisciplinasComponent;
  let fixture: ComponentFixture<CursoDisciplinasComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CursoDisciplinasComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CursoDisciplinasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
