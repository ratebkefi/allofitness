'use strict';
app
    .controller('home', ['config', '$scope', '$filter', '$rootScope', 'homeProvider', '$state','$location', '$timeout',
        function (config, $scope ,$filter, $rootScope, homeProvider, $state, $location, $timeout) {

            $scope.activePath = null;
            $scope.clubTopRated=[];
            $scope.coachTopRated=[];
            $scope.itemAddRecent=[];

            $scope.itemEventsTop=[];
            $scope.itemAds=[];

            $scope.numerRelated = 10;
            
            $scope.$on('$routeChangeSuccess', function(){
                $scope.activePath = $location.path();
                //console.log( $location.path() );
            });

            homeProvider.listTopRated($scope.numerRelated).success(
                function (data, status) {
                    $scope.clubTopRated= (data.result.club);
                    $scope.coachTopRated= (data.result.coach);
                    //console.log(data.result);
                }
            );

            homeProvider.lastSubClub().success(
                function (data, status) {

                    for (var i = 0; i < data.length; i++) {

                        if( data[i].club_media.length==0){
                            $scope.itemAddRecent.push({
                                image: 'images/default.png',
                                title: data[i].club_name,
                                id: data[i].id,
                                type:'club'
                            });
                        }else{
                            $scope.itemAddRecent.push({
                                image: data[i].club_media[0].name,
                                title: data[i].club_name,
                                id: data[i].id,
                                type:'club'
                            });
                        }

                    }



                    homeProvider.lastSubCoach().success(
                        function (data, status) {

                            for (var i = 0; i < data.length; i++) {
                                    $scope.itemAddRecent.push({
                                        image: data[i].photo,
                                        title: data[i].first_name+' '+data[i].last_name,
                                        id: data[i].id,
                                        type:'coach'
                                    });

                            }



                            //console.log($scope.itemSubClub);

                        }
                    );
                    console.log($scope.itemAddRecent);
                    //console.log($scope.itemSubClub);

                }
            );



            var ladate=new Date();
            ladate="0"+(ladate.getMonth()+1)+"-"+ladate.getFullYear();

            homeProvider.listEventsTop(6,ladate).success(
                function (data, status) {
                    $scope.itemEventsTop= (data.result);
                   //console.log($scope.itemEventsTop);

                    // var items = [], categories = [];
                    // for(var i = 0; i < $scope.itemEventsTop.length;i++){
                    //     categories.push($scope.itemEventsTop[i].name);
                    //     for(var j = 0; j < $scope.itemEventsTop[i].items.length;j++){
                    //         items.push($scope.itemEventsTop[i].items[j].name);
                    //     }
                    // }
                    // console.log(categories);
                     //console.log($scope.itemEventsTop);

                }
            );

            homeProvider.lastAds(2).success(
                function (data, status) {
                    $scope.itemAds= (data);
                    console.log($scope.itemAds);

                }
            );


            // Top slider
            $scope.slides = [
                {image: 'images/slider/cours-de-golf.jpg', description: "Here's our small slogan."},
                {image: 'images/slider/cours-de-remise-en-forme.jpg', description: "Here's our small slogan."},
                {image: 'images/slider/cours-de-running.jpg', description: "Here's our small slogan."}
            ];

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
                autoplay: false,
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
                autoplay: false,
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

            $scope.slickConfig2 = {
                enabled: true,
                autoplay: true,
                dfraggable: false,
                method: {},
                event: {
                    beforeChange: function (event, slick, currentSlide, nextSlide) {
                    },
                    afterChange: function (event, slick, currentSlide, nextSlide) {
                    }
                }
            };


            $scope.miniGalleryResponsive = [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ];

            


            // recently added
            $scope.list_recently = [
                {image: 'images/slider/clubs.jpg', name: "CLUB GIMY.1", date: "2016-06-02", url: "#", id: "215"},
                {image: 'images/slider/moa.jpg', name: "CLUB GIMY.2", date: "2016-08-15", url: "#", id: "215"},
                {image: 'images/slider/olga.jpg', name: "CLUB GIMY.3", date: "2016-04-02", url: "#", id: "215"},
                {image: 'images/slider/clubs.jpg', name: "CLUB GIMY.4", date: "2016-03-12", url: "#", id: "215"},
                {image: 'images/slider/moa.jpg', name: "CLUB GIMY.5", date: "2016-05-24", url: "#", id: "215"},
                {image: 'images/slider/olga.jpg', name: "CLUB GIMY.6", date: "2016-04-29", url: "#", id: "215"}
            ];



            // LIST CARTE
            $scope.tasks = [
                {name: 'Item One',price: '50 €'},
                {name: 'The second item',price: '100 €'},
                {name: 'Three items is the best',price: '200 €'}
            ];

            $scope.hoverIn = function(){
                this.hoverEdit = true;
            };

            $scope.hoverOut = function(){
                this.hoverEdit = false;
            };




            //SEARCH
            // $scope.search_club = function(item) {
            //     console.log(item.club_name);
            //
            //
            // }


            // BEST SCORE

            /* paggination */
            $scope.items = [{
                "name": "CLUB DE FITNESS",
                "image": "images/emerald-114-150x150.jpg",
                "notice": "2.5",
                "category": [{
                    "category": "Professeur de tennis"
                }, {
                    "category": "business"
                }],
                "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            },{
                "name": "Rodrick",
                "image": "images/coach.jpg",
                "price": "25.00 €",
                "category": [{
                    "category": "Professeur de tennis"
                }, {
                    "category": "business"
                }],
                "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            }];


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
