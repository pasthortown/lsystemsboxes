import { BoxesModule } from './boxes.module';

describe('BoxesModule', () => {
    let blankPageModule: BoxesModule;

    beforeEach(() => {
        blankPageModule = new BoxesModule();
    });

    it('should create an instance', () => {
        expect(blankPageModule).toBeTruthy();
    });
});
