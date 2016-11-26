'use strict';
app
    .controller('listcoach', ['config', '$scope', '$filter', '$rootScope','coachProvider', '$state','$http','$window',
        function (config, $scope, $filter, $rootScope,coachProvider, $state,$http,$window) {

            $scope.itemCountry=[];
            $scope.itemRegion=[];
            $scope.itemDep=[];
            $scope.itemCity=[];
            $scope.itemCivility =[];
            $scope.items=[];



            var vm = this;
            vm.coachs = []; //declare an empty array
            vm.pageno = 1; // initialize page no to 1
            vm.total_count = 0;
            vm.itemsPerPage = 12; //this could be a dynamic value from a drop down
            $scope.pageno=1;
            $scope.total_count=0;
            $scope.nbPage= 0;
            $scope.search_filter='';
            $scope.list_coach=[];
            $scope.filter_coach={};

            var items = {};
            vm.getData = function(pageno){ // This would fetch the data on page change.
                $scope.pageno=pageno;
                vm.pageno=pageno;
                vm.coachs = [];
                items.search_filter=$scope.search_filter;
                items.item_per_page=vm.itemsPerPage;
                items.page_number=$scope.pageno;
                $http.post(config.apiUrl + "api/coach/filter/", items).success(function(response){
                    vm.coachs = response;  //ajax request to fetch data into vm.data

                    $scope.list_coach= response;
                    console.log($scope.list_coach);
                    coachProvider.total(items).success(
                        function (data, status) {
                            vm.total_count = data;
                            $scope.total_count = data;
                            $scope.nbPage= parseInt($scope.total_count  / vm.itemsPerPage) ;
                            if(($scope.total_count- ($scope.nbPage*vm.itemsPerPage))>0)
                                $scope.nbPage=$scope.nbPage+1;

                        }
                    );
                });
            };

            vm.getData(vm.pageno);

            $scope.pagination = function (pageno) {

                vm.getData(pageno);

            };




            // PAGE LISTING COACH

            /* paggination */
            // $scope.items = [{
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // },{
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // },{
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }, {
            //     "name": "Rodrick",
            //     "image": "images/coach.jpg",
            //     "price": "25.00 €",
            //     "category": [{
            //         "category": "Professeur de tennis"
            //     }, {
            //         "category": "business"
            //     }],
            //     "description":"Professeur de tennis DEJEPS, j'entraîne au club de Colombes et pour Tennis Action depuis 4 ans"
            // }];
            //
            // // create empty search model (object) to trigger $watch on update
            // $scope.search = {};
            //
            // $scope.resetFilters = function () {
            //     // needs to be a function or it won't trigger a $watch
            //     $scope.search = {};
            // };

            // pagination controls
            // $scope.currentPage = 1;
            // $scope.totalItems = $scope.items.length;
            // $scope.entryLimit = 8; // items per page
            // $scope.noOfPages = Math.ceil($scope.totalItems / $scope.entryLimit);
            //
            // // $watch search to update pagination
            // $scope.$watch('search', function (newVal, oldVal) {
            //     $scope.filtered = filterFilter($scope.items, newVal);
            //     $scope.totalItems = $scope.filtered.length;
            //     $scope.noOfPages = Math.ceil($scope.totalItems / $scope.entryLimit);
            //     $scope.currentPage = 1;
            // }, true);


        }
    ]);


// app.filter('startFrom', function () {
//     return function (input, start) {
//         if (input) {
//             start = +start;
//             return input.slice(start);
//         }
//         return [];
//     };
// });
