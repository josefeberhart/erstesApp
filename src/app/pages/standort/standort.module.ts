import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { StandortPageRoutingModule } from './standort-routing.module';

import { StandortPage } from './standort.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    StandortPageRoutingModule
  ],
  declarations: [StandortPage]
})
export class StandortPageModule {}
