'use strict';
app.directive('validPassword', function() {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            ctrl.$parsers.unshift(function (viewValue, $scope) {
                var noMatch = viewValue != scope.form.password.$viewValue
                ctrl.$setValidity('noMatch', !noMatch)
            })
        }
    }
});

