app.controller('ProfilCtrl', function(config,$scope,$rootScope,$window,$state,userProvider) {

    $scope.verfiAuthentificated();
    $scope.userData={};
    $scope.user={};
    userProvider.userProfil().success(
        function (data, status) {
            $scope.userData=data;
            if($scope.userData!=false)
            {
                console.log( $scope.userData);
                $scope.user.username=$scope.userData.username;
                $scope.user.email=$scope.userData.email;
            }
        }
    );

    $scope.pagination = function (nbPage,item) {


    };




});