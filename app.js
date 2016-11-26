'use strict';

/**
 * @ngdoc overview
 * @name alloFitnessApp
 * @description
 * # alloFitnessApp
 *
 * Main module of the application.
 */

var app = angular.module('alloFitnessApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ngMaterial',
    'ui.router',
    'angularFileUpload',
    '720kb.datepicker',
    'angular-loading-bar',
    'slickCarousel',
    'ngMdIcons',
    'ngDialog',
    'toastr',
    'typer',
    'google.places',
    'lfNgMdFileInput',
    'ui.select'
  ]);
app.constant('config', {
    appName: 'My App',
    appVersion: 2.0,
        mediaUrlCoach: 'http://localhost/allofitness/media/coach/upload.php',
        mediaUrlCoachCrop: 'http://localhost/allofitness/media/coach/uploadcrop.php',
        apiUrl: 'http://localhost/allofitness/api/web/app_dev.php/',
        apiUrlAdmin: 'http://localhost/allofitness/api/web/app_dev.php/',
        photoUrl:'http://localhost/allofitness/admin/src/media/'
        });

