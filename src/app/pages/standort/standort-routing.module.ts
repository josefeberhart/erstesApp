import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { StandortPage } from './standort.page';

const routes: Routes = [
  {
    path: '',
    component: StandortPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class StandortPageRoutingModule {}
