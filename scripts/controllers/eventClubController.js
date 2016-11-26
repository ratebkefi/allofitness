'use strict';
app.controller('eventClubCtrl', ['config', '$scope', '$filter', '$rootScope','communProvider','memberProvider', 'clubProvider','FileUploader', '$state','$location', '$timeout','$http', 'ngDialog',
    function (config, $scope ,$filter, $rootScope,communProvider,memberProvider,clubProvider,FileUploader, $state, $location, $timeout, $http, ngDialog) {


        $scope.save=false;
        $scope.message ="";
        $scope.itemTypeClub=[];
        $scope.itemFunctionClub=[];
        $scope.itemNetworkClub=[];
        $scope.itemNeventsClub=[];
        $scope.dateseventsClub=[];
        $scope.itemCountry=[];
        $scope.itemRegion=[];
        $scope.itemDep=[];
        $scope.itemCity=[];
        $scope.item=[];
        $scope.item.confirm_password='';
        $scope.item.networkclub=0;
        $scope.item.typeclub=0;
        $scope.itemSuperficie =[];
        $scope.itemCivility =[];
        $scope.url_site='';
        $scope.dis=false;
        $scope.submitted =false;



        // we will store all of our form data in this object

        $scope.formData = {};

        var validateLicense = function (newVal) {
            // If you are only checking for content to be entered
            return (newVal !== '' && newVal !== undefined);
        };

        var validateInfo = function (newVal) {
            if (newVal.length > 0) {
                for (var i = 0, l = newVal.length; i < l; i++) {
                    if (newVal[i] === undefined || newVal[i] === '') {
                        return false;
                    }
                }
                return true;
            }
            return false;
        };

        $scope.$watch('formData.license', function (newVal) {
            $scope.licenseValidated = validateLicense(newVal);
        });

        $scope.$watchGroup(['item.club_name', 'item.networkclubs', 'item.typeclubs'], function (newVal) {
            $scope.infoValidated = validateInfo(newVal);
        });


        $scope.dis=false;
        // LISTE CLUB EVENTS
        $scope.selected = [];

        $scope.query = {
            order: 'title',
            limit: 5,
            page: 1
        };

        $scope.searchFish   = '';


        // ADD EVENT

        $scope.regx="/(([0-2]?\d{1})|([3][0,1]{1}))/^[0,1]?\d{1}/(([1]{1}[9]{1}[9]{1}\d{1})|([2-9]{1}\d{3}))$/";
        $scope.items.minDtate=$filter("date")(new Date(1960, 1, 1), 'yyyy-MM-dd');
        $scope.items.maxDtate=$filter("date")(new Date(1980, 1, 1), 'yyyy-MM-dd');
        $scope.items.maxDtateI=$filter("date")(Date.now(), 'yyyy-MM-dd');
        $scope.items.minDtateI=$filter("date")(new Date(1900, 1, 1), 'yyyy-MM-dd');

        var uploaderp = $scope.uploaderp = new FileUploader({
            url: config.mediaUrlCoachCrop
        });

        // FILTERS

        uploaderp.filters.push({
            name: 'customFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS

        uploaderp.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploaderp.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploaderp.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
        };
        uploaderp.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploaderp.onSuccessItem = function(fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploaderp.onErrorItem = function(fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploaderp.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploaderp.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };



        $scope.addFields = function (form) {
            form.contacts.push({ birth_date: '' });
        }


        var randomString = function(length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for(var i = 0; i < length; i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            return text;
        }


        var ts = Math.round((new Date()).getTime() / 1000);
        $scope.generate1= ts+''+randomString(5);
        $scope.generate2= ts+''+randomString(5);
        $scope.generate3= ts+''+randomString(5);
        $scope.generate4= ts+''+randomString(5);
        $scope.generate5= ts+''+randomString(5);

        $scope.filename = function (filename) {
            var a = filename.split(".");
            if( a.length === 1 || ( a[0] === "" && a.length === 2 ) ) {
                return "";
            }
            return a.pop();
        }

        function callAtTimeout() {
            $state.go('index');
        }

        $scope.add_event = function(item) {


            console.log(item);

            $scope.submitted =true;
            if ($scope.formAdd.title.$invalid || $scope.formAdd.birthdate.$invalid ) {
                return;
            }

            if (!$scope.items.succ1) {
                return;
            }

            if(item.birth_date=='')
            {
                return;
            }
            $scope.params = {
                title: item.title,
                description: item.description,
                dates: item.birth_date,
                photo: item.photo,
            };
            console.log($scope.params);

            var message = 'Votre inscription effectuée avec succès';

            // coachProvider.addCoach($scope.params).success(
            //     function (data, status) {
            //
            //         console.log(data);
            //
            //         if(data.message.code=='200')
            //         {
            //             toastr.success(data.message.text);
            //             $scope.dis=true;
            //             $timeout(callAtTimeout, 5000);
            //         }
            //         else
            //         {
            //             toastr.error(data.message.text);
            //         }
            //     }
            // );

        }





    }
]);