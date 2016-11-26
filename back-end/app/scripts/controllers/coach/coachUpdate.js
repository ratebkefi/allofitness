app.controller('CoachUpdateCtrl', function(config,Flash, $scope ,FileUploader,$filter, $rootScope, coachProvider, $state, $location,$filter,$http ) {


    var coachId = $state.params.id;
   console.log(coachId);
    $scope.save=false;
    $scope.nameapp = config.appName;
    $scope.message ="";
    $scope.itemTypeClub=[];
    $scope.itemNetworkClub=[];
    $scope.itemCountry=[];
    $scope.itemRegion=[];
    $scope.itemDep=[];
    $scope.itemCity=[];
    $scope.items=[];
    $scope.items.succ0=false;
    $scope.items.succ1=false;
    $scope.items.succ2=false;
    $scope.items.succ3=false;
    $scope.items.succ4=false;
    $scope.items.birth_date='';

    $scope.confirm_password='';


    $scope.address = {};
    $scope.updateadress = false;
    $scope.refreshAddresses = function(address) {
        var params = {address: address, sensor: false};
        return $http.get(
            'http://maps.googleapis.com/maps/api/geocode/json',
            {params: params}
        ).then(function(response) {
            $scope.addresses = response.data.results;
            $scope.updateadress = true;
        });
    };





    coachProvider.showCoach(coachId).success(
        function (data, status) {

            $scope.items.id=coachId;
            $scope.items.email=data.id_user.email;
            $scope.items.password=data.id_user.plain_password;
            $scope.items.confirm_password=$scope.items.password;
            $scope.items.first_name=data.first_name;
            $scope.items.last_name=data.last_name;
            $scope.items.country=data.id_adress.id_country;
            $scope.items.region=data.id_adress.id_region;
            $scope.items.dep=data.id_adress.id_departement;
            $scope.items.city=data.id_adress.id_city;
            $scope.items.civility=data.id_user.civility;
            $scope.items.cp=parseInt(data.id_adress.id_cp);
            $scope.confirm_password=data.id_user.plain_password;
            $scope.date= data.birth_date.slice(0, 10);
            $scope.items.adresse=data.id_adress.adress;
            $scope.items.adresse_contunied=data.id_adress.adress_continued;
            $scope.items.birth_date=data.birth_date;
            $scope.items.mention=data.mention;
            $scope.items.phone=parseInt(data.phone);
            var date = new Date(data.birth_date);
            $scope.items.birthdate = $filter('date')(date, 'yyyy-MM-dd');


            var countryId = $scope.items.country.id;
            $scope.itemRegion=[];
            coachProvider.listRegion(countryId).success(
                function (data, status) {
                    $scope.itemRegion= (data);
                }
            );

            var regionId = $scope.items.region.id;
            $scope.itemDep=[];
            coachProvider.listDep(regionId).success(
                function (data, status) {
                    $scope.itemDep= (data);
                }
            );

            var depId = $scope.items.dep.id;
            $scope.itemCity=[];
            coachProvider.listCity(depId).success(
                function (data, status) {
                    $scope.itemCity= (data);
                }
            );

        }
    );



    coachProvider.listCountry().success(
        function (data, status) {
            $scope.itemCountry= (data);
        }
    );


    $scope.updateRegion = function(item) {
        $scope.itemRegion=[];
        coachProvider.listRegion(item).success(
            function (data, status) {
                $scope.itemRegion= (data);
            }
        );
    };

    $scope.updateDepartement = function(item) {
        $scope.itemDep=[];
        coachProvider.listDep(item).success(
            function (data, status) {
                $scope.itemDep= (data);
            }
        );
    };

    $scope.updateCity = function(item) {
        $scope.itemCity=[];
        coachProvider.listCity(item).success(
            function (data, status) {
                $scope.itemCity= (data);
            }
        );
    };


    $scope.message = "";




    var uploaderd = $scope.uploaderd = new FileUploader({
        url: config.mediaUrl
    });

    // FILTERS

    uploaderd.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
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
        url: config.mediaUrl
    });

    // FILTERS

    uploaderp.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
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
        url: config.mediaUrl
    });

    // FILTERS

    uploaderk.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
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
        url: config.mediaUrl
    });

    // FILTERS

    uploaderk.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
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
        url: config.mediaUrl
    });

    // FILTERS

    uploaderc.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
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
        url: config.mediaUrl
    });

    // FILTERS

    uploaderr.filters.push({
        name: 'customFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
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


    $scope.generate = function () {
        return randomString(10);
    }
    $scope.generate1= randomString(10);
    $scope.generate2= randomString(10);
    $scope.generate3= randomString(10);
    $scope.generate4= randomString(10);
    $scope.generate5= randomString(10);

    $scope.filename = function (filename) {
        var a = filename.split(".");
        return a.pop();
    }

    $scope.update_coach = function(confirm_password) {

        $scope.submitted =true;






        if(confirm_password=='')
        {

            return;
        }
        if( angular.isUndefined($scope.items.city)) {

            $scope.params = {
                id: $scope.items.id,
                first_name: $scope.items.first_name,
                last_name: $scope.items.last_name,
                adress: $scope.items.adresse,
                adresse_contunied: $scope.items.adresse_contunied,
                country: parseInt($scope.items.country.id),
                region: parseInt($scope.items.region.id),
                civility: parseInt($scope.items.civility.id),
                departement: parseInt($scope.items.dep.id),
                cp: parseInt($scope.items.cp),
                phone: parseInt($scope.items.phone),
                birth_date: $scope.items.birthdate,
                diploma: $scope.items.diploma,
                mention: $scope.items.mention,
                business_card: $scope.items.business_card,
                photo: $scope.items.photo,
                kbis: $scope.items.kbis,
                rib: $scope.items.rib,
                password: $scope.items.password,
                email: $scope.items.email,
            };
        }

        else
        {

            $scope.params = {
                id: $scope.items.id,
                first_name: $scope.items.first_name,
                last_name: $scope.items.last_name,
                adress: $scope.items.adresse,
                adresse_contunied: $scope.items.adresse_contunied,
                country: parseInt($scope.items.country.id),
                civility: parseInt($scope.items.civility.id),
                region: parseInt($scope.items.region.id),
                departement: parseInt($scope.items.dep.id),
                city: parseInt($scope.items.city.id),
                cp: parseInt($scope.items.cp),
                phone: parseInt($scope.items.phone),
                birth_date: $scope.items.birthdate,
                diploma: $scope.items.diploma,
                mention: $scope.items.mention,
                business_card: $scope.items.business_card,
                photo: $scope.items.photo,
                kbis: $scope.items.kbis,
                rib: $scope.items.rib,
                password: $scope.items.password,
                email: $scope.items.email,
            };

        }


        console.log( $scope.params);



        var message = 'Enregisterer avec succes !';
        coachProvider.updateCoach($scope.params).success(
            function (data, status) {
                console.log(data);
                if(data.message.code=='200')
                {
                    Flash.create('success', data.message.text, 0, {class: 'custom-class', id: 'custom-id'}, true);
                    $state.go('club.list');
                }
                else
                {
                    Flash.create('warning', data.message.text, 0, {class: 'custom-class', id: 'custom-id'}, true);
                }


            }
        );

    }


});
