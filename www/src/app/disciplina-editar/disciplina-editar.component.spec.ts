import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DisciplinaEditarComponent } from './disciplina-editar.component';

describe('DisciplinaEditarComponent', () => {
  let component: DisciplinaEditarComponent;
  let fixture: ComponentFixture<DisciplinaEditarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DisciplinaEditarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DisciplinaEditarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
