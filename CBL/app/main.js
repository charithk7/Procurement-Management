biziApp.controller('mainController', function ($scope,$location) {

    $scope.isCurrentPath = function (path) {
        return $location.path() == path;
    };

    //Move to Dashboard
    if ($location.path() == '/') {
        $location.path('/purchase_order');
    }

});