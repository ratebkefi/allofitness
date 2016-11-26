'use strict';

/**
 * This file is part of the Aisel package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @name            AiselSettings
 * @description     settingsService
 */
angular.module('app').service('coachProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
            total: function(item) {
                var url = config.apiUrl+'api/coach/total/';
                return $http.post(url,item);
            },
            listCountry: function() {
                var url = config.apiUrl+'api/commun/listcountry';
                return $http.get(url);
            },
            listRegion: function(item) {
                var url =  config.apiUrl+'api/commun/showregion/'+item;
                return $http.get(url);
            },
            listDep: function(item) {
                var url =  config.apiUrl+'api/commun/showdepartement/'+item;
                return $http.get(url);
            },
            listCity: function(item) {

                var url =  config.apiUrl+'api/commun/showcity/'+item;
                return $http.get(url);
            },
            updateStatus: function(item) {
            var url = config.apiUrl + 'api/coach/status/';
            return $http.put(url, item)
            },
            addCoach: function(item) {
                return $http.post(config.apiUrl+'api/coach/add',item);
            },
            showCoach: function(id) {
                var url =  config.apiUrl+'api/coach/show/'+id;
                return $http.get(url);
            },
            updateCoach: function(item) {
                var url = config.apiUrl + 'api/coach/update/';
                return $http.put(url, item)
            },
            listCivility: function(item) {
                var url =  config.apiUrl+'api/commun/listcivility';
                return $http.get(url);
            }

        };
    }
]);