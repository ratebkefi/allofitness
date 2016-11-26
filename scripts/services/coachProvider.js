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
app.service('coachProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
            total: function(item) {
                var url = config.apiUrl+'api/coach/total/';
                return $http.post(url,item);
            },
            listCoach: function() {
                var url =  config.apiUrl+'/api/coach/';
                return $http.get(url);
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
            }


        };
    }
]);