'use strict';
app.config(
    function ($stateProvider, $urlRouterProvider,$locationProvider) {
        $locationProvider.html5Mode(true);
        $urlRouterProvider.otherwise('/');
        $stateProvider
            .state('index', {
                url: '/',
                templateUrl: 'views/count.html',
                controller: 'home'
            })
            .state('index.addclub', {
                url: 'club/add',
                templateUrl: 'views/addclub.html',
                controller: 'club'
            })
            .state('index.addcoach', {
                url: 'coach/add',
                templateUrl: 'views/addcoach.html',
                controller: 'coach'
            })
            .state('index.addmember', {
                url: 'member/add',
                templateUrl: 'views/addMember.html',
                controller: 'memberCtrl'
            })
            .state('index.listcoach', {
                url: 'coach/list',
                templateUrl: 'views/listCoachs.html',
                controller: 'listcoach'
            })
            .state('index.listclub', {
                url: 'club/list',
                templateUrl: 'views/listClubs.html',
                controller: 'listclub'
            })
            .state('index.home', {
                url: 'home',
                templateUrl: 'views/home.html',
                controller: 'home'
            })
            .state('index.activatcompte', {
                params: {token: null},
                url: ':token/activatcompte',
                templateUrl: 'views/activatcompte.html',
                controller: 'activatCompte'
            })

            .state('index.member', {
                url: 'member',
                templateUrl: 'views/spaceMember.html',
                controller: 'spaceCtrl'
            })
            .state('index.member.activity', {
                url: '/activity',
                templateUrl: 'views/components/form-activity.html'
            })
            .state('index.member.amenities', {
                url: '/activity',
                templateUrl: 'views/components/form-amenities.html'
            })
            .state('index.member.comfort', {
                url: '/comfort',
                templateUrl: 'views/components/form-comfort.html'
            })
            .state('index.member.services', {
                url: '/services',
                templateUrl: 'views/components/form-services.html'
            })

    }).run(['$rootScope', '$location', function ($rootScope, $location) {
    var path = function () {
        return $location.path();
    };
    $rootScope.$watch(path, function (newVal, oldVal) {
        $rootScope.activetab = newVal;
    });
}]);
