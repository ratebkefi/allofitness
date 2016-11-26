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
app.service('communProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
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
            ajouterCoach: function(item) {
                return $http.post(config.apiUrl+'api/coach/add',item);
            },
            activatCompte: function(token) {
                var url = config.apiUrl + 'api/user/'+token+'/activate/';
                return $http.put(url, null)
            },
            listCivility: function(item) {
                var url =  config.apiUrl+'api/commun/listcivility';
                return $http.get(url);
            },
            listArea: function(item) {
                var url =  config.apiUrl+'api/commun/listarea';
                return $http.get(url);
            },
            listFunctionClub: function(item) {
                var url =  config.apiUrl+'api/commun/showfunctionclub';
                return $http.get(url);
            }



        };
    }
]);