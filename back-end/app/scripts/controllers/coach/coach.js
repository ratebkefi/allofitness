app.controller('CoachCtrl', function(config,$scope,$rootScope,$window,$state,coachProvider,$http) {

$scope.verfiAuthentificated();
    var vm = this;
    vm.coachs = []; //declare an empty array
    vm.pageno = 1; // initialize page no to 1
    vm.total_count = 0;
    vm.itemsPerPage = 30; //this could be a dynamic value from a drop down
    $scope.pageno=1;
    $scope.total_count=0;
    $scope.nbPage= 0;
    $scope.search_filter='';

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
            console.log(response);
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

    $scope.updateStatus = function(id,status) {

        $scope.params = {
            id: id,
            status: status,
        };
        coachProvider.updateStatus($scope.params).success(
            function (data, status) {
                vm.getData($scope.pageno);
            }
        );

    };

});