app.controller('SigninCtrl', function(config,$scope,$rootScope,$window,$state,userProvider) {

    $scope.verfiAuthentificatedSignin();
    $scope.message="";
    $scope.login = function (item) {
        console.log(item);
        userProvider.login(item).success(
            function (data, status) {
                console.log(data);
                $scope.datauser = data;

                if(data.status)
                {
                    console.log('hellooooooooooo');
                    console.log(data+'_'+config.token);
                    $window.localStorage.setItem('open_session', 1);
                    $window.localStorage.setItem('member_fitness_token', config.token);
                    $window.localStorage.setItem('username_fitness', data.user.username);
                    $window.localStorage.setItem('email_fitness', data.user.email);
                    $window.localStorage.setItem('is_ae', data.id);
                    $window.localStorage.setItem('is_ae', data.role);
                    $scope.message="";
                    $state.go('app.dashboard');
                }
                else
                {
                    $scope.message="Vérifier le username et le password";
                }
            }
        );
    };
});