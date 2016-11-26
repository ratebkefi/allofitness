'use strict';
app.controller('loginCtrl', ['config', '$scope', '$rootScope','memberProvider','$window','$state','ngDialog',
    function (config, $scope , $rootScope,memberProvider,$window,$state,ngDialog) {

        $scope.message="";
        $scope.login = function (item) {
            //console.log(item);
            memberProvider.login(item).success(
                function (data, status) {
                    console.log(data);
                    $scope.datauser = data;

                    if(data.status)
                    {
                        $window.localStorage.setItem('open_session', 1);
                        $window.localStorage.setItem('username_fitness', data.user.username);
                        $window.localStorage.setItem('email_fitness', data.user.email);
                        $window.localStorage.setItem('id_club', data.user.id);
                        $window.localStorage.setItem('is_ae', data.role);

                        console.log(data.user.id);

                        $rootScope.connected=true;

                        $scope.message="Connexion effectuée avec succès";

                        ngDialog.close();

                        //$window.location.reload();
                        $rootScope.redirect_page(data.role);

                    }
                    else
                    {
                        $scope.message="Vérifier le username et le password";
                    }
                }
            );
        };





    }
]);