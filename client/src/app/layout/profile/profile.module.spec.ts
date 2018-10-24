import { ProfileModule } from './profile.module';

describe('ProfileModule', () => {
    let blankPageModule: ProfileModule;

    beforeEach(() => {
        blankPageModule = new ProfileModule();
    });

    it('should create an instance', () => {
        expect(blankPageModule).toBeTruthy();
    });
});
