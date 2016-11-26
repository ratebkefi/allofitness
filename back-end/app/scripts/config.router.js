'use strict';

/**
 * @ngdoc function
 * @name app.config:uiRouter
 * @description
 * # Config
 * Config for the router
 */
angular.module('app')
  .run(
    [           '$rootScope', '$state', '$stateParams',
      function ( $rootScope,   $state,   $stateParams ) {


      }
    ]
  )
  .config(
    [          '$stateProvider', '$urlRouterProvider', 'MODULE_CONFIG',
      function ( $stateProvider,   $urlRouterProvider,  MODULE_CONFIG ) {
        $urlRouterProvider
          .otherwise('/access/signin');
        $stateProvider

          .state('app', {
            abstract: true,
            url: '/app',
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })
            .state('user', {
                url: '/user',
                views: {
                    '': {
                        templateUrl: 'views/layout.html'
                    },
                    'aside': {
                        templateUrl: 'views/aside.html'
                    },
                    'content': {
                        templateUrl: 'views/content.html'
                    }
                }
            })

            .state('coach', {
                url: '/coach',
                views: {
                    '': {
                        templateUrl: 'views/layout.html'
                    },
                    'aside': {
                        templateUrl: 'views/aside.html'
                    },
                    'content': {
                        templateUrl: 'views/content.html'
                    }
                }
            })

            .state('club', {
                url: '/club',
                views: {
                    '': {
                        templateUrl: 'views/layout.html'
                    },
                    'aside': {
                        templateUrl: 'views/aside.html'
                    },
                    'content': {
                        templateUrl: 'views/content.html'
                    }
                }
            })

            .state('access', {
              url: '/access',
              template: '<div class="indigo bg-big"><div ui-view class="fade-in-down smooth"></div></div>',
              controller: 'SecurityCtrl',
              resolve: load('scripts/controllers/back/security.js')
            })
            .state('access.signin', {
              url: '/signin',
              templateUrl: 'views/utilisateur/signin.html',
              controller: 'SigninCtrl',
              resolve: load('scripts/controllers/utilisateur/signin.js')
            })
            .state('user.settings', {
                  url: '/settings',
                  templateUrl: 'views/utilisateur/settings.html',
                  controller: 'ProfilCtrl',
                  resolve: load('scripts/controllers/utilisateur/profil.js')
              })
            .state('user.profile', {
                url: '/profile',
                templateUrl: 'views/utilisateur/profile.html',
                controller: 'ProfilCtrl',
                resolve: load('scripts/controllers/utilisateur/profil.js')
            })
            .state('app.dashboard', {
              url: '/dashboard',
              templateUrl: 'views/dash/dashboard.html',
              controller: 'DachCtrl',
              resolve: load('scripts/controllers/back/dash.js')
            })
            .state('coach.list', {
                url: '/list',
                templateUrl: 'views/coach/list.html',
                controller: 'CoachCtrl',
                resolve: load('scripts/controllers/coach/coach.js')
            })
            .state('club.list', {
                url: '/list',
                templateUrl: 'views/club/list.html',
                controller: 'ClubCtrl',
                resolve: load('scripts/controllers/club/club.js')
            })
            .state('club.update', {
                params: {id: null},
                url: '/:id/update',
                templateUrl: 'views/club/update.html',
                controller: 'ClubUpdateCtrl',
                resolve: load(['ui.select','scripts/controllers/club/clubUpdate.js'])
            })
            .state('club.add', {
                url: '/add',
                templateUrl: 'views/club/add.html',
                controller: 'ClubAddCtrl',
                resolve: load(['ui.select','scripts/controllers/club/clubAdd.js'])
            })
            .state('coach.add', {
                url: '/add',
                templateUrl: 'views/coach/add.html',
                controller: 'CoachAddCtrl',
                resolve: load(['ui.select','scripts/controllers/coach/coachAdd.js'])
            })
            .state('coach.update', {
                params: {id: null},
                url: '/:id/update',
                templateUrl: 'views/coach/update.html',
                controller: 'CoachUpdateCtrl',
                resolve: load(['ui.select','scripts/controllers/coach/coachUpdate.js'])
            })
          ;

          function load(srcs, callback) {
            return {
                deps: ['$ocLazyLoad', '$q',
                  function( $ocLazyLoad, $q ){
                    var deferred = $q.defer();
                    var promise  = false;
                    srcs = angular.isArray(srcs) ? srcs : srcs.split(/\s+/);
                    if(!promise){
                      promise = deferred.promise;
                    }
                    angular.forEach(srcs, function(src) {
                      promise = promise.then( function(){
                        angular.forEach(MODULE_CONFIG, function(module) {
                          if( module.name == src){
                            if(!module.module){
                              name = module.files;
                            }else{
                              name = module.name;
                            }
                          }else{
                            name = src;
                          }
                        });
                        return $ocLazyLoad.load(name);
                      } );
                    });
                    deferred.resolve();
                    return callback ? promise.then(function(){ return callback(); }) : promise;
                }]
            }
          }
      }
    ]
  );
