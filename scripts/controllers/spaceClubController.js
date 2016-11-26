'use strict';
app.controller('spaceClubCtrl', ['config', '$scope', '$filter', '$rootScope','communProvider','memberProvider', 'clubProvider','FileUploader', '$state','$location', '$timeout','$http', 'ngDialog',
    function (config, $scope ,$filter, $rootScope,communProvider,memberProvider,clubProvider,FileUploader, $state, $location, $timeout, $http, ngDialog) {

        $scope.activePath = null;
        $scope.$on('$routeChangeSucacess', function(){
            $scope.activePath = $location.path();
            // console.log( $location.path() );
        });


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



        $scope.itemClub = {
            club_info: '2',
        };

        console.log($scope.id_club);

        communProvider.listCountry().success(
            function (data, status) {
                $scope.itemCountry= (data);

            }
        );



        communProvider.listCivility().success(
            function (data, status) {
                $scope.itemCivility= (data);

            }
        );


        communProvider.listFunctionClub().success(
            function (data, status) {
                $scope.itemFunctionClub= (data);

            }
        );


        communProvider.listArea().success(
            function (data, status) {
                $scope.itemSuperficie= (data);

            }
        );


        clubProvider.listTypeClub().success(
            function (data, status) {
                $scope.itemTypeClub= (data);
            }
        );


        clubProvider.listNetworkClub().success(
            function (data, status) {
                $scope.itemNetworkClub= data;

            }
        );

        clubProvider.listeventsClub($scope.itemClub).success(
            function (data, status) {
                $scope.itemNeventsClub= data.result;
                console.log(data.result);


            }
        );

        $scope.updateRegion = function(item) {
            $scope.itemRegion=[];
            communProvider.listRegion(item.id).success(
                function (data, status) {
                    $scope.itemRegion= (data);
                }
            );
        };

        $scope.updateDepartement = function(item) {
            $scope.itemDep=[];
            communProvider.listDep(item.id).success(
                function (data, status) {
                    $scope.itemDep= (data);
                }
            );
        };

        $scope.updateCity = function(item) {

            $scope.itemCity=[];
            communProvider.listCity(item.id).success(
                function (data, status) {
                    $scope.itemCity= (data);
                    console.log(data);
                    // $scope.itemArray =$scope.itemCity;

                }
            );
        };


        $rootScope.progress = 0;

        $rootScope.progressActive = function (path) {

            if(path=='/club/info'){
                return '11';
            }
            else if(path=='/club/activity'){
                return '22';
            }
            else if(path=='/club/access'){
                return '33';
            }
            else if(path=='/club/presentation'){
                return '44';
            }
            else if(path=='/club/invitation'){
                return '55';
            }
            else if(path=='/club/photos'){
                return '66';
            }
            else if(path=='/club/subscriptions'){
                return '77';
            }
            else if(path=='/club/authors'){
                return '88';
            }
            else if(path=='/club/events'){
                return '100';
            }
            else{
                return '0';
            }

        };






        $scope.mapsModel = function () {
            ngDialog.open({ template: 'googlemapsModel', className: 'ngdialog-theme-default' });
        };

        $scope.customCallbackFunction = function( pickedPlace ){
            console.log( pickedPlace );
        }



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




        // UPLOADER
        var uploaderd = $scope.uploaderd = new FileUploader({
            url: config.mediaUrlCoach
        });

        // FILTERS

        uploaderd.filters.push({
            name: 'customFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                console.log(type);
                return '|jpg|png|jpeg|gif|pdf|doc|msword|docx|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS

        uploaderd.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploaderd.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploaderd.onAfterAddingAll = function(addedFileItems) {
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploaderd.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
        };
        uploaderd.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploaderd.onProgressAll = function(progress) {
            console.info('onProgressAll', progress);
        };
        uploaderd.onSuccessItem = function(fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploaderd.onErrorItem = function(fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploaderd.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploaderd.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploaderd.onCompleteAll = function() {
            console.info('onCompleteAll');
        };


        $scope.dis=false;
        // LISTE CLUB EVENTS
        $scope.selected = [];

        $scope.query = {
            order: 'title',
            limit: 5,
            page: 1
        };

        $scope.searchFish   = '';

        

    }
]);