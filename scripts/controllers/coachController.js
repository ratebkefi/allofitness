'use strict';
app
    .controller('coach', ['config', '$scope','FileUploader', '$filter', '$rootScope','toastr', 'communProvider','coachProvider', '$state','$timeout','$http',
        function (config, $scope, FileUploader, $filter, $rootScope,toastr, communProvider,coachProvider, $state,$timeout,$http) {







            $scope.itemCountry=[];
            $scope.itemRegion=[];
            $scope.itemDep=[];
            $scope.itemCity=[];
            $scope.itemCivility =[];
            $scope.items=[];
            $scope.items.confirm_password='';
            $scope.regx="/(([0-2]?\d{1})|([3][0,1]{1}))/^[0,1]?\d{1}/(([1]{1}[9]{1}[9]{1}\d{1})|([2-9]{1}\d{3}))$/";
            $scope.items.minDtate=$filter("date")(new Date(1960, 1, 1), 'yyyy-MM-dd');
            $scope.items.maxDtate=$filter("date")(new Date(1980, 1, 1), 'yyyy-MM-dd');
            $scope.items.maxDtateI=$filter("date")(Date.now(), 'yyyy-MM-dd');
            $scope.items.minDtateI=$filter("date")(new Date(1900, 1, 1), 'yyyy-MM-dd');

            $scope.dis=false;

            communProvider.listCountry().success(
                function (data, status) {
                    $scope.itemCountry= (data);
                    console.log(data)

                }
            );

            communProvider.listCivility().success(
                function (data, status) {
                    $scope.itemCivility= (data);

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
                        console.log(data);
                        $scope.itemCity= (data);

                    }
                );
            };

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

            var uploaderk = $scope.uploaderk = new FileUploader({
                url: config.mediaUrlCoach
            });

            // FILTERS

            uploaderk.filters.push({
                name: 'customFilter',
                fn: function(item /*{File|FileLikeObject}*/, options) {
                    var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                    return '|jpg|png|jpeg|gif|pdf|doc|msword|docx|'.indexOf(type) !== -1;
                }
            });

            // CALLBACKS

            uploaderk.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
                console.info('onWhenAddingFileFailed', item, filter, options);
                console.log("onWhenAddingFileFailed");
            };
            uploaderk.onAfterAddingFile = function(fileItem) {
                console.info('onAfterAddingFile', fileItem);
            };
            uploaderk.onBeforeUploadItem = function(item) {
                console.info('onBeforeUploadItem', item);
            };
            uploaderk.onProgressItem = function(fileItem, progress) {
                console.info('onProgressItem', fileItem, progress);
            };
            uploaderk.onSuccessItem = function(fileItem, response, status, headers) {
                console.info('onSuccessItem', fileItem, response, status, headers);
            };
            uploaderk.onErrorItem = function(fileItem, response, status, headers) {
                console.info('onErrorItem', fileItem, response, status, headers);
            };
            uploaderk.onCancelItem = function(fileItem, response, status, headers) {
                console.info('onCancelItem', fileItem, response, status, headers);
            };
            uploaderk.onCompleteItem = function(fileItem, response, status, headers) {
                console.info('onCompleteItem', fileItem, response, status, headers);
            };

            var uploaderk = $scope.uploaderk = new FileUploader({
                url: config.mediaUrlCoach
            });

            // FILTERS

            uploaderk.filters.push({
                name: 'customFilter',
                fn: function(item /*{File|FileLikeObject}*/, options) {
                    var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                    return '|jpg|png|jpeg|gif|pdf|doc|msword|docx|'.indexOf(type) !== -1;
                }
            });

            // CALLBACKS

            uploaderk.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
                console.info('onWhenAddingFileFailed', item, filter, options);
            };
            uploaderk.onAfterAddingFile = function(fileItem) {
                console.info('onAfterAddingFile', fileItem);
            };
            uploaderk.onBeforeUploadItem = function(item) {
                console.info('onBeforeUploadItem', item);
            };
            uploaderk.onProgressItem = function(fileItem, progress) {
                console.info('onProgressItem', fileItem, progress);
            };
            uploaderk.onSuccessItem = function(fileItem, response, status, headers) {
                console.info('onSuccessItem', fileItem, response, status, headers);
            };
            uploaderk.onErrorItem = function(fileItem, response, status, headers) {
                console.info('onErrorItem', fileItem, response, status, headers);
            };
            uploaderk.onCancelItem = function(fileItem, response, status, headers) {
                console.info('onCancelItem', fileItem, response, status, headers);
            };
            uploaderk.onCompleteItem = function(fileItem, response, status, headers) {
                console.info('onCompleteItem', fileItem, response, status, headers);
            };


            var uploaderc = $scope.uploaderc = new FileUploader({
                url: config.mediaUrlCoach
            });

            // FILTERS

            uploaderc.filters.push({
                name: 'customFilter',
                fn: function(item /*{File|FileLikeObject}*/, options) {
                    var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                    return '|jpg|png|jpeg|gif|pdf|doc|msword|docx|'.indexOf(type) !== -1;
                }
            });

            // CALLBACKS

            uploaderc.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
                console.info('onWhenAddingFileFailed', item, filter, options);
            };
            uploaderc.onAfterAddingFile = function(fileItem) {
                console.info('onAfterAddingFile', fileItem);
            };
            uploaderc.onBeforeUploadItem = function(item) {
                console.info('onBeforeUploadItem', item);
            };
            uploaderc.onProgressItem = function(fileItem, progress) {
                console.info('onProgressItem', fileItem, progress);
            };
            uploaderc.onSuccessItem = function(fileItem, response, status, headers) {
                console.info('onSuccessItem', fileItem, response, status, headers);
            };
            uploaderc.onErrorItem = function(fileItem, response, status, headers) {
                console.info('onErrorItem', fileItem, response, status, headers);
            };
            uploaderc.onCancelItem = function(fileItem, response, status, headers) {
                console.info('onCancelItem', fileItem, response, status, headers);
            };
            uploaderc.onCompleteItem = function(fileItem, response, status, headers) {
                console.info('onCompleteItem', fileItem, response, status, headers);
            };

            var uploaderr = $scope.uploaderr = new FileUploader({
                url: config.mediaUrlCoach
            });

            // FILTERS

            uploaderr.filters.push({
                name: 'customFilter',
                fn: function(item /*{File|FileLikeObject}*/, options) {
                    var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                    return '|jpg|png|jpeg|gif|pdf|doc|msword|docx|'.indexOf(type) !== -1;
                }
            });

            // CALLBACKS

            uploaderr.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
                console.info('onWhenAddingFileFailed', item, filter, options);
            };
            uploaderr.onAfterAddingFile = function(fileItem) {
                console.info('onAfterAddingFile', fileItem);
            };
            uploaderr.onBeforeUploadItem = function(item) {
                console.info('onBeforeUploadItem', item);
            };
            uploaderr.onProgressItem = function(fileItem, progress) {
                console.info('onProgressItem', fileItem, progress);
            };
            uploaderr.onSuccessItem = function(fileItem, response, status, headers) {
                console.info('onSuccessItem', fileItem, response, status, headers);
            };
            uploaderr.onErrorItem = function(fileItem, response, status, headers) {
                console.info('onErrorItem', fileItem, response, status, headers);
            };
            uploaderr.onCancelItem = function(fileItem, response, status, headers) {
                console.info('onCancelItem', fileItem, response, status, headers);
            };
            uploaderr.onCompleteItem = function(fileItem, response, status, headers) {
                console.info('onCompleteItem', fileItem, response, status, headers);
            };
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

            $scope.add_coach = function(item) {


              console.log(item);

                $scope.submitted =true;
                if(item.confirm_password=='')
                {

                    return;
                }
                 if ($scope.form.first_name.$invalid ||$scope.form.last_name.$invalid ||$scope.form.password.$invalid ||
                     $scope.form.email.$invalid ||$scope.form.adress.$invalid ||$scope.form.phone.$invalid ||
                     $scope.form.countrys.$invalid ||$scope.form.regions.$invalid ||$scope.form.deps.$invalid ||
                     $scope.form.cps.$invalid  || $scope.form.civilitys.$invalid  ||
                    $scope.form.confirmPassword.$error.noMatch || $scope.form.birthdate.$invalid ) {
                     $scope.form.confirmPassword.$invalid=false;
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
                     first_name: item.first_name,
                     last_name: item.last_name,
                     adress: item.adress,
                     adresse_contunied: item.adresse_contunied,
                     country: parseInt(item.country),
                     region: parseInt(item.region),
                     departement: parseInt(item.departement),
                     city: parseInt(item.city),
                     civility:parseInt(item.civility),
                     cp:  item.cps,
                     phone: parseInt(item.phone),
                     birth_date: item.birth_date,
                     diploma: item.diploma,
                     business_card:item.business_card,
                     photo: item.photo,
                     kbis: item.kbis,
                     rib: item.rib,
                     password: item.password,
                     email: item.email,
                 };
                console.log($scope.params);

                var message = 'Votre inscription effectuée avec succès';

                coachProvider.addCoach($scope.params).success(
                    function (data, status) {

                        console.log(data);

                        if(data.message.code=='200')
                        {
                            toastr.success(data.message.text);
                            $scope.dis=true;
                            $timeout(callAtTimeout, 5000);
                        }
                        else
                        {
                            toastr.error(data.message.text);
                        }
                    }
                );

            }



            // Top slider
            $scope.slides = [
                {image: 'images/header/coach.jpg', description: "Here's our small slogan."},
                {image: 'images/header/coach1.jpg', description: "Here's our small slogan."},
                {image: 'images/header/coach2.jpg', description: "Here's our small slogan."}];

            $scope.direction = 'left';
            $scope.currentIndex = 0;

            $scope.setCurrentSlideIndex = function (index) {
                $scope.direction = (index > $scope.currentIndex) ? 'left' : 'right';
                $scope.currentIndex = index;
            };

            $scope.isCurrentSlideIndex = function (index) {
                return $scope.currentIndex === index;
            };

            $scope.prevSlide = function () {
                $scope.direction = 'left';
                $scope.currentIndex = ($scope.currentIndex < $scope.slides.length - 1) ? ++$scope.currentIndex : 0;
            };

            $scope.nextSlide = function () {
                $scope.direction = 'right';
                $scope.currentIndex = ($scope.currentIndex > 0) ? --$scope.currentIndex : $scope.slides.length - 1;
            };

            // carrousel
            $scope.slickConfig = {
                enabled: true,
                autoplay: true,
                draggable: false,
                autoplaySpeed: 3000,
                method: {},
                event: {
                    beforeChange: function (event, slick, currentSlide, nextSlide) {
                    },
                    afterChange: function (event, slick, currentSlide, nextSlide) {
                    }
                }
            };

            /************************************************/

        }
    ])


    .animation('.slide-animation', function () {
        return {
            beforeAddClass: function (element, className, done) {
                var scope = element.scope();

                if (className == 'ng-hide') {
                    var finishPoint = element.parent().width();
                    if(scope.direction !== 'right') {
                        finishPoint = -finishPoint;
                    }
                    TweenMax.to(element, 0.5, {left: finishPoint, onComplete: done });
                }
                else {
                    done();
                }
            },
            removeClass: function (element, className, done) {
                var scope = element.scope();

                if (className == 'ng-hide') {
                    element.removeClass('ng-hide');

                    var startPoint = element.parent().width();
                    if(scope.direction === 'right') {
                        startPoint = -startPoint;
                    }

                    TweenMax.fromTo(element, 0.5, { left: startPoint }, {left: 0, onComplete: done });
                }
                else {
                    done();
                }
            }
        };
    });


