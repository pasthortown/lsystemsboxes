import { BoxesRoutingModule } from './boxes-routing.module';
import { BoxesComponent } from './boxes.component';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatCardModule } from '@angular/material';
import { MatButtonModule, MatCheckboxModule, MatInputModule } from '@angular/material';
import { FlexLayoutModule } from '@angular/flex-layout';
import { NgxQRCodeModule } from 'ngx-qrcode2';

@NgModule({
    imports: [CommonModule, NgxQRCodeModule, FormsModule, NgbModule, BoxesRoutingModule, FlexLayoutModule, MatCardModule, MatButtonModule, MatCheckboxModule, MatInputModule],
    declarations: [BoxesComponent]
})
export class BoxesModule {}
