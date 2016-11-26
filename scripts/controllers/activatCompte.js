/**
 * Created by DEV-PC on 04/07/2016.
 */
'use strict';
app.controller('activatCompte', ['config', '$scope', '$filter', '$rootScope', 'communProvider', '$state','$location','$timeout','$q', '$log',
    function (config, $scope ,$filter, $rootScope, communProvider, $state, $location,$timeout, $q, $log) {

        $scope.role='';
        $scope.response='';
        $scope.message='';

        $scope.activePath = null;
        $scope.$on('$routeChangeSucacess', function(){
            $scope.activePath = $location.path();
            console.log( $location.path() );
        });

        var token = $state.params.token;
        console.log(token);


        communProvider.activatCompte(token).success(
            function (data, status) {

                $scope.role=data.result.roles;
                $scope.response=data.message.code;
                if($scope.response=='203')
                {
                    $scope.message='Félicitations ! Votre compte a bien été activé.';
                }
                else if($scope.response=='205')
                {
                    $scope.message='Compte déja activé.';
                }
                else
                {
                    $scope.message="Erreur : token invalide";
                }

                console.log($scope.message);
            }
        );





        // Top slider
        $scope.slides = [
            {image: 'images/header/coach.jpg', description: "Here's our small slogan."},
            {image: 'images/header/coach1.jpg', description: "Here's our small slogan."},
            {image: 'images/header/coach2.jpg', description: "Here's our small slogan."},{image: 'images/header/club.jpg', description: "Here's our small slogan."}];

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

        $scope.slickConfig1 = {
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

