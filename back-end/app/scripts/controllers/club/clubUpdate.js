
app.controller('ClubUpdateCtrl', function(config,Flash, $scope ,$filter, $rootScope, clubProvider, $state, $location,$http ) {

    $scope.verfiAuthentificated();
    $scope.itemCivility =[];
    $scope.address={};
    $scope.address.selected='';
    $scope.itemFunctionClub=[];
    $scope.itemSuperficie =[];

    clubProvider.listArea().success(
        function (data, status) {
            $scope.itemSuperficie= (data);

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

    /**
     * Init global parameters
     */
    var clubId = $state.params.id;
    $scope.items=[];
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

    clubProvider.showClub(clubId).success(
        function (data, status) {
            $scope.items.id=clubId;
            $scope.items.club_name=data.club_name;
            $scope.items.superficie=data.superficie;
            $scope.items.url_site=data.url_site;
            $scope.items.first_name_responsible=data.first_name_responsible;
            $scope.items.last_name_responsible=data.last_name_responsible;
            $scope.items.responsible_function=data.id_function;
            $scope.items.email_of_the_person_contacted=data.email_of_the_person_contacted;
            $scope.items.email_of_the_person_contacted_cc=data.email_of_the_person_contacted_cc;
            $scope.items.civility=data.id_user.civility,
            $scope.items.cellphone=parseInt(data.cellphone);
            $scope.items.phone=parseInt(data.phone);
            $scope.items.email=data.id_user.email;
            $scope.items.password=data.id_user.plain_password;
            $scope.confirm_password=data.id_user.plain_password;
            $scope.items.club_network=data.id_network;
            $scope.items.club_type=data.id_type;
            $scope.items.adresse=data.id_adress.adress;
            $scope.items.adresse_contunied=data.adress_continued;
            $scope.items.country=data.id_adress.id_country;
            $scope.items.region=data.id_adress.id_region;
            $scope.items.dep=data.id_adress.id_departement;
            $scope.items.city=data.id_adress.id_city;
            $scope.items.cp=parseInt(data.id_adress.id_cp);
            $scope.items.cp=parseInt(data.id_adress.id_cp);
            $scope.items.superficie=data.id_area;

            //$scope.items= (data);
            console.log(data);

            var countryId = $scope.items.country.id;
            $scope.itemRegion=[];
            clubProvider.listRegion(countryId).success(
                function (data, status) {
                    $scope.itemRegion= (data);
                }
            );

            var regionId = $scope.items.region.id;
            $scope.itemDep=[];
            clubProvider.listDep(regionId).success(
                function (data, status) {
                    $scope.itemDep= (data);
                }
            );

            var depId = $scope.items.dep.id;
            $scope.itemCity=[];
            clubProvider.listCity(depId).success(
                function (data, status) {
                    $scope.itemCity= (data);
                }
            );

        }
    );

    $scope.activePath = null;
    $scope.$on('$routeChangeSucacess', function(){
        $scope.activePath = $location.path();
        console.log( $location.path() );
    });

    $scope.save=false;
    $scope.nameapp = config.appName;
    $scope.message ="";
    $scope.itemTypeClub=[];
    $scope.itemNetworkClub=[];
    $scope.itemCountry=[];
    $scope.itemRegion=[];
    $scope.itemDep=[];
    $scope.itemCity=[];

    $scope.submitted =false;
    clubProvider.listCountry().success(
        function (data, status) {
            $scope.itemCountry= (data);
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

    $scope.update_club = function(confirm_password) {

        $scope.submitted =true;
        console.log($scope.params);
        if(confirm_password=='')
        {
            return;
        }




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
            id: $scope.items.id,
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

        clubProvider.updateClub($scope.params).success(
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
