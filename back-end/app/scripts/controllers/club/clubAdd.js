app.controller('ClubAddCtrl', function(config,Flash, $scope ,$filter, $rootScope, clubProvider, $state, $location,$http ) {

    $scope.verfiAuthentificated();
    $scope.save=false;
    $scope.nameapp = config.appName;
    $scope.message ="";
    $scope.itemTypeClub=[];
    $scope.itemNetworkClub=[];
    $scope.itemCountry=[];
    $scope.itemRegion=[];
    $scope.itemDep=[];
    $scope.itemCity=[];
    $scope.itemSuperficie =[];
    $scope.itemCivility =[];
    $scope.itemFunctionClub = [];
    $scope.items=[];
    $scope.submitted =false;
    clubProvider.listCountry().success(
        function (data, status) {
            $scope.itemCountry= (data);
        }
    );

    clubProvider.listCivility().success(
        function (data, status) {
            $scope.itemCivility= (data);
        }
    );

    clubProvider.listFunctionClub().success(
        function (data, status) {
            $scope.itemFunctionClub= (data);
        }
    );

    clubProvider.listArea().success(
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

    $scope.updateRegion = function(item) {
        $scope.itemRegion=[];
        clubProvider.listRegion(item).success(
            function (data, status) {
                $scope.itemRegion= (data);
            }
        );
    };

    $scope.updateDepartement = function(item) {
        $scope.itemDep=[];
        clubProvider.listDep(item).success(
            function (data, status) {
                $scope.itemDep= (data);
            }
        );
    };

    $scope.updateCity = function(item) {
        $scope.itemCity=[];
        clubProvider.listCity(item).success(
            function (data, status) {
                $scope.itemCity= (data);
            }
        );
    };

    $scope.message = "";

    $scope.add_club = function(address,confirm_password) {
        $scope.submitted =true;

        if( angular.isUndefined($scope.items.city))
        {
            $scope.params = {
                club_name: $scope.items.club_name,
                club_network: parseInt($scope.items.club_network.id),
                club_type: parseInt($scope.items.club_type.id),
                adress: $scope.items.adresse,
                adresse_contunied: $scope.items.adresse_contunied,
                country: parseInt($scope.items.country.id),
                region: parseInt($scope.items.region.id),
                departement: parseInt($scope.items.dep.id),
                civility: parseInt($scope.items.civility.id),
                cp: parseInt($scope.items.cp),
                phone: $scope.items.phone,
                cellphone: $scope.items.cellphone,
                url_site: $scope.items.url_site,
                superficie: $scope.items.superficie.id,
                first_name_responsible: $scope.items.first_name_responsible,
                last_name_responsible: $scope.items.last_name_responsible,
                responsible_function: $scope.items.responsible_function,
                email_of_the_person_contacted: $scope.items.email_of_the_person_contacted,
                email_of_the_person_contacted_cc: $scope.items.email_of_the_person_contacted_cc,
                password: $scope.items.password,
                email: $scope.items.email,
            };
        }
        else
        {
            $scope.params = {
                club_name: $scope.items.club_name,
                club_network: parseInt($scope.items.club_network.id),
                club_type: parseInt($scope.items.club_type.id),
                adress: $scope.items.adresse,
                adresse_contunied: $scope.items.adresse_contunied,
                country: parseInt($scope.items.country.id),
                region: parseInt($scope.items.region.id),
                departement: parseInt($scope.items.dep.id),
                city: parseInt($scope.items.city.id),
                civility: parseInt($scope.items.civility.id),
                cp: parseInt($scope.items.cp),
                phone: $scope.items.phone,
                cellphone: $scope.items.cellphone,
                url_site: $scope.items.url_site,
                superficie: $scope.items.superficie.id,
                first_name_responsible: $scope.items.first_name_responsible,
                last_name_responsible: $scope.items.last_name_responsible,
                responsible_function: $scope.items.responsible_function,
                email_of_the_person_contacted: $scope.items.email_of_the_person_contacted,
                email_of_the_person_contacted_cc: $scope.items.email_of_the_person_contacted_cc,
                password: $scope.items.password,
                email: $scope.items.email,
            };
        }

        console.log($scope.params);
        if(confirm_password=='')
        {
            return;
        }

        if ($scope.form.club_name.$invalid ||$scope.form.networkclubs.$invalid ||$scope.form.typeclubs.$invalid ||
            $scope.form.adresse.$invalid ||$scope.form.countrys.$invalid ||$scope.form.regions.$invalid ||
            $scope.form.civilitys.$invalid ||$scope.form.superficies.$invalid ||
            $scope.form.deps.$invalid ||$scope.form.citys.$invalid ||$scope.form.cps.$invalid ||
            $scope.form.phone.$invalid ||$scope.form.url_site.$invalid ||
            $scope.form.first_name_responsible.$invalid ||$scope.form.last_name_responsible.$invalid
            ||$scope.form.responsible_function.$invalid ||
            $scope.form.email_of_the_person_contacted.$invalid ||$scope.form.passwords.$invalid ||$scope.form.email.$invalid
            ||$scope.form.superficies.$invalid||$scope.form.confirm_password.$error.validator ) {
            $scope.form.confirm_password.$invalid=false;
            return;
        }

        $scope.params = {
            club_name: $scope.items.club_name,
            club_network: parseInt($scope.items.club_network.id),
            club_type: parseInt($scope.items.club_type.id),
            adress: $scope.items.adresse,
            adresse_contunied: $scope.items.adresse_contunied,
            country: parseInt($scope.items.country.id),
            region: parseInt($scope.items.region.id),
            departement: parseInt($scope.items.dep.id),
            city: parseInt($scope.items.city.id),
            civility:parseInt($scope.items.civility.id),
            cp: parseInt($scope.items.cp),
            phone: $scope.items.phone,
            cellphone: $scope.items.cellphone,
            url_site: $scope.items.url_site,
            superficie: $scope.items.superficie.id,
            first_name_responsible: $scope.items.first_name_responsible,
            last_name_responsible: $scope.items.last_name_responsible,
            responsible_function: $scope.items.responsible_function.id,
            email_of_the_person_contacted: $scope.items.email_of_the_person_contacted,
            email_of_the_person_contacted_cc: $scope.items.email_of_the_person_contacted_cc,
            password: $scope.items.password,
            email: $scope.items.email,
        };
        console.log($scope.params);
        clubProvider.addClub($scope.params).success(
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

    $scope.confirm_password = '';
    $scope.address = {};
    $scope.refreshAddresses = function(address) {
        var params = {address: address, sensor: false};
        return $http.get(
            'http://maps.googleapis.com/maps/api/geocode/json',
            {params: params}
        ).then(function(response) {
            $scope.addresses = response.data.results;
        });
    };



});
