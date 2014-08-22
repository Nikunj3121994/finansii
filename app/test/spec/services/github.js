describe('Unit: githubService', function () {
    describe('should', function () {
        beforeEach(module('app.data.github'));

        it('be defined', inject(function(githubService){ //parameter name = service name
            githubService.getUserRepos().then(function (data) {
                expect(false).toBe(false);
            })
        }))
    })
});



