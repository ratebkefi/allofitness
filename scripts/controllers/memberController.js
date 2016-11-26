'use strict';
app.controller('memberCtrl', ['config', '$scope', '$filter', '$rootScope','communProvider','memberProvider','toastr', '$state','$location', '$timeout','$q', '$log',
    function (config, $scope ,$filter, $rootScope,communProvider,memberProvider,toastr, $state, $location, $timeout, $q, $log) {

        $scope.activePath = null;
        $scope.$on('$routeChangeSucacess', function(){
            $scope.activePath = $location.path();
            // console.log( $location.path() );
        });

        $scope.save=false;
        $scope.nameapp = config.appName;
        $scope.message ="";
        $scope.itemTypeClub=[];
        $scope.itemFunctionClub=[];
        $scope.itemNetworkClub=[];
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

        $scope.items.minDtate=$filter("date")(new Date(1960, 1, 1), 'yyyy-MM-dd');
        $scope.items.maxDtate=$filter("date")(new Date(1980, 1, 1), 'yyyy-MM-dd');
        $scope.items.maxDtateI=$filter("date")(Date.now(), 'yyyy-MM-dd');
        $scope.items.minDtateI=$filter("date")(new Date(1900, 1, 1), 'yyyy-MM-dd');
        

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
        function callAtTimeout() {
            $state.go('index');
        }
        $scope.add_member = function(item) {

            $scope.submitted =true;
            if(item.confirm_password=='')
            {

                return;
            }

            console.log(item.registerednewsletter);


            if ($scope.form.firstname.$invalid ||$scope.form.adress.$invalid ||$scope.form.countrys.$invalid ||$scope.form.regions.$invalid ||
                $scope.form.civilitys.$invalid || $scope.form.deps.$invalid  ||$scope.form.cps.$invalid ||
                $scope.form.mobilephone.$invalid ||$scope.form.lastname.$invalid || $scope.form.birthdate.$invalid ||
                $scope.form.password.$invalid ||$scope.form.email.$invalid || $scope.form.confirmPassword.$error.noMatch ) {
                $scope.form.confirmPassword.$invalid=false;
                return;
            }

            $scope.params = {
                birthdate: item.birthdate,
                adress: item.adress,
                adresse_contunied: item.adresse_contunied,
                country: parseInt(item.country),
                region: parseInt(item.region),
                departement: parseInt(item.departement),
                city: parseInt(item.city),
                cp: item.cps,
                civility:parseInt(item.civility),
                mobilephone: item.mobilephone,
                //cellphone: item.cellphone,
                lastname: item.lastname,
                firstname: item.firstname,
                emailsponsor: item.emailsponsor,
                registerednewsletter: item.registerednewsletter,
                password: item.password,
                email: item.email
            };

            console.log($scope.params);

            memberProvider.addMember($scope.params).success(
                function (data, status) {
console.log(data);


                    $scope.save=true;
                    // $scope.message='Enregisterer avec succes !';
                    if(data.message.code=='200')
                    {
                        toastr.success(data.message.text);
                        $timeout(callAtTimeout, 5000);
                        $scope.dis=true;

                    }
                    else
                    {
                        toastr.error(data.message.text);
                    }

                    // $state.go('index');
                }
            );

        }


        $scope.getMatches = function () {
            var results = ['Apple', 'Apple is a fruit']
            return results;
        }



        // Top slider
        $scope.slides = [
            {image: 'images/header/club.jpg', description: "Here's our small slogan."}];

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
