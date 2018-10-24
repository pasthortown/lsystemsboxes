import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ProfileRoutingModule } from './profile-routing.module';
import { ProfileComponent } from './profile.component';
import { MatCardModule } from '@angular/material';
import { MatButtonModule, MatCheckboxModule, MatInputModule } from '@angular/material';
import { FlexLayoutModule } from '@angular/flex-layout';

@NgModule({
    imports: [CommonModule, FormsModule, ProfileRoutingModule, FlexLayoutModule, MatCardModule, MatButtonModule, MatCheckboxModule, MatInputModule],
    declarations: [ProfileComponent]
})
export class ProfileModule {}
