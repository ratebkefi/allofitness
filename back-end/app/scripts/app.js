'use strict';

/**
 * @ngdoc overview
 * @name app
 * @description
 * # app
 *
 * Main module of the application.
 */
angular
  .module('app', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ngMaterial',
    'ngStorage',
    'ngStore',
    'ui.router',
    'ui.utils',
    'ui.bootstrap',
    'ui.load',
    'ui.jp',
    'pascalprecht.translate',
    'angularFileUpload',
    'oc.lazyLoad',
    'angular-loading-bar',
    'angularUtils.directives.dirPagination',
      'flash',
    'materialDatePicker'
  ]);

angular
    .module('app').constant('config', {
    appName: 'My App',
    appVersion: 2.0,
    token : '7e3fc84fe5fbda55771347505d616b0ac5a8ccab',
    mediaUrlCoach: 'http://localhost/allofitness/media/coach/upload.php',
    mediaUrlCoachCrop: 'http://localhost/allofitness/media/coach/uploadcrop.php',
    apiUrl: 'http://localhost/allofitness/api/web/app_dev.php/',
    apiUrlAdmin: 'http://localhost/allofitness/api/web/app_dev.php/',
    photoUrl:'http://localhost/allofitness/admin/src/media/'
});
