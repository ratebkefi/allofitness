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
app.service('clubProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
            listTypeClub: function() {
                var url =  config.apiUrl+'api/commun/showtypeclub';
                return $http.get(url);
            },
            listNetworkClub: function() {
                var url =  config.apiUrl+'api/commun/shownetworkclub';
                return $http.get(url);
            },
            addClub: function(item) {
                return $http.post(config.apiUrl+'api/club/add',item);
            },
            listeventsClub: function(item) {
                console.log('odd');
                return $http.post(config.apiUrl+'api/club/list_events',item);
            }

        };
    }
]);