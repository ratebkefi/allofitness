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
app.service('homeProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
            lister: function() {
                var url = config.apiUrl+'changelist';
                return $http.get(url);
            },
            listTopRated: function(item) {
                var url =  config.apiUrl+'api/commun/top_rated/'+item;
                return $http.get(url);

            },
            lastSubClub: function() {
                var url =  config.apiUrl+'api/commun/lastsubslub';
                return $http.get(url);

            },
            lastSubCoach: function() {
                var url =  config.apiUrl+'api/commun/lastsubscoach';
                return $http.get(url);

            },
            listEventsTop: function(number,month) {
               var url =  config.apiUrl+'api/commun/listevents/'+number+'/'+month;
               return $http.get(url);

            },
            lastAds: function(limit) {
                    var url =  config.apiUrl+'api/commun/lastad/'+limit;
                    return $http.get(url);

            }  
        };
    }
]);