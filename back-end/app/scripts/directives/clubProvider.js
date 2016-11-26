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
angular.module('app').service('clubProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
            total: function(item) {
                var url = config.apiUrl+'api/club/total/';
                return $http.post(url,item);
            },listCountry: function() {
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
            listTypeClub: function() {
                var url =  config.apiUrl+'api/commun/showtypeclub';
                return $http.get(url);
            },
            listNetworkClub: function() {
                var url =  config.apiUrl+'api/commun/shownetworkclub';
                return $http.get(url);
            },
            showClub: function(id) {
                var url =  config.apiUrl+'api/club/show/'+id;
                return $http.get(url);
            },
            updateClub: function(item) {
                var url = config.apiUrl + 'api/club/update/';
                return $http.put(url, item)
            },
            addClub: function(item) {
                return $http.post(config.apiUrl+'api/club/add',item);
            },
            updateStatus: function(item) {
                var url = config.apiUrl + 'api/club/status/';
                return $http.put(url, item)
            },
            listArea: function(item) {
                var url =  config.apiUrl+'api/commun/listarea';
                return $http.get(url);
            },
            listCivility: function(item) {
                var url =  config.apiUrl+'api/commun/listcivility';
                return $http.get(url);
            },
            listFunctionClub: function(item) {
                var url =  config.apiUrl+'api/commun/showfunctionclub';
                return $http.get(url);
            }


        };
    }
]);