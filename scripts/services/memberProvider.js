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
app.service('memberProvider', ['config','$http','$location',
    function(config,$http,$location,$rootScope) {
        return {
            addMember: function(item) {
                return $http.post(config.apiUrl+'api/member/add',item);
            },
            login: function (item) {
                var url = config.apiUrlAdmin + 'api/user/login/';
                return $http.post(url,item);
            },
            logout: function () {

                var url = config.apiUrl + 'api/user/logout/';
                return $http.get(url);
            },
            userProfil: function () {
                var url = config.apiUrl + 'api/user/information/';
                return $http.get(url);
            },
            updateProfil: function (item) {
                console.log(item);
                var url = config.apiUrl + 'api/user/editinformation/';
                return $http.put(url,item);
            }
        };
    }
]);