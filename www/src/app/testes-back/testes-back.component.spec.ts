import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TestesBackComponent } from './testes-back.component';

describe('TestesBackComponent', () => {
  let component: TestesBackComponent;
  let fixture: ComponentFixture<TestesBackComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TestesBackComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TestesBackComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
