'use strict';

/**
 * @ngdoc function
 * @name app.controller:AppCtrl
 * @description
 * # MainCtrl
 * Controller of the app
 */
app.controller('AppCtrl', ['config', '$scope', '$filter', '$rootScope', 'clubProvider', '$state','$location','ngDialog','memberProvider','$window',
  function (config, $scope ,$filter, $rootScope, clubProvider, $state, $location, ngDialog,memberProvider,$window) {
    console.log('oui');

    $scope.activePath = null;
    $scope.$on('$routeChangeSucacess', function(){
      $scope.activePath = $location.path();
      console.log( $location.path() );
    });

    $scope.toggle = false;

    $scope.isActive = function (viewLocation) {
      var active = (viewLocation === $location.path());
      return active;
    };






    $scope.headerActive = function () {
      if($location.path()=='/club/add'){
        return 'club';
      }
      else if($location.path()=='/club/list'){
        return 'club';
      }
      else if($location.path()=='/coach/add'){
        return 'coach';
      }
      else if($location.path()=='/coach/list'){
        return 'coach';
      }
      else if($location.path()=='/home2'){
        return 'home2';
      }
      else{
        return 'auther';
      }

    };

    $scope.loginModel = function () {
      ngDialog.open({ template: 'loginModal', className: 'ngdialog-theme-default' });
    };

    $scope.cancel = function() {
      console.log('ok')
    };


    $scope.goBack = function () {
      $window.history.back();
    }


    $scope.username_fitness=$window.localStorage.getItem('username_fitness');
    $scope.email_fitness=$window.localStorage.getItem('email_fitness');
    $scope.id_club=$window.localStorage.getItem('id_club');

      $rootScope.connected=false;

      if($window.localStorage.getItem('open_session')==1)
      {
        console.log('is authentifcated');

        $rootScope.connected=true;
      }
      else {
        console.log('is not authentifcated');
        $rootScope.connected=false;
      }
    /**
     * @ngdoc method
     * @name logout
     * @methodOf home.controllers:homeController
     * @description
     * Logout: delete token
     */

    $scope.logout = function () {
      $window.localStorage.setItem('open_session','');
      $window.localStorage.setItem('member_fitness_token', '');
      $window.localStorage.setItem('is_ae', '');
      memberProvider.logout().success(
          function (data, status) {
            $rootScope.connected=false;
            console.log('logout');
          }
      );
    };

    $rootScope.redirect_page = function (role) {
      
      if(role=="ROLE_CLUB"){
        $state.go('index.club.info');
      }
      else if(role=="ROLE_COACH"){
        $state.go('index.club.info');
      }
      else{
        $state.go('index');
      }
    };


    $scope.verfiAuthentificated = function () {


      if($window.localStorage.getItem('open_session')==1)
      {
        console.log('is authentifcated');
      }
      else
      {
        $state.go('access.signin');
      }
    };

  }
]);

