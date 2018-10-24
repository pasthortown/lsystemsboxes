import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';

import { BoxesRoutingModule } from './boxes-routing.module';
import { BoxesComponent } from './boxes.component';
import { MatCardModule } from '@angular/material';
import { FlexLayoutModule } from '@angular/flex-layout';

@NgModule({
    imports: [CommonModule, BoxesRoutingModule, FlexLayoutModule, MatCardModule],
    declarations: [BoxesComponent]
})
export class BoxesModule {}
