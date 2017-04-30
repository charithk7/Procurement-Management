
// create the module and name it biziApp
var biziApp = angular.module('biziApp', ['ngRoute', 'ui.bootstrap','ngSanitize']);



// configure our routes
biziApp.config(function ($routeProvider) {
    $routeProvider

    // route for the home page
        .when('/', {
            templateUrl: 'load_view/main',
            controller: 'mainController',
            title: 'Home'
        })

        .when('/dashboard', {
            templateUrl: 'load_view/dashboard_content',
            controller: 'dashController',
            title: 'Dashboard'
        })


        .when('/search', {
            templateUrl: 'accounts/global_search',
            controller: 'searchController',
            title: 'Search'
        })


        .when('/note_grn', {
            templateUrl: 'load_view/note_grn',
            controller: 'note_grnController',
            title: 'Received Goods'
        })

        .when('/note_grn_add', {
            templateUrl: 'load_form/note_grn_add',
            controller: 'note_grn_addController',
            title: 'Add Bills'
        })

        .when('/purchase_order', {
            templateUrl: 'load_view/purchase_order',
            controller: 'purchase_orderController',
            title: 'Contracts'
        })
        .when('/purchase_order_add/:state/:id', {
            templateUrl: 'load_form/purchase_order_add',
            controller: 'purchase_order_addController',
            title: 'Add Contract'
        })


        .when('/suppliers', {
            templateUrl: 'load_view/suppliers',
            controller: 'suppliersController',
            title: 'Suppliers'
        })
        .when('/suppliers_add/:state/:id', {
            templateUrl: 'load_form/suppliers_add',
            controller: 'suppliers_addController',
            title: 'Add Suppliers'
        })

        .when('/weigh_bridge', {
            templateUrl: 'load_view/weigh_bridge',
            controller: 'weigh_bridgeController',
            title: 'Weigh Bridge'
        })

    ;


});

biziApp.run(['$rootScope', function($rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);

biziApp.run( function($rootScope, $location) {
    $rootScope.$watch(function() {
            return $location.path();
        },
        function(a){
            console.log('url has changed: ' + a);
            // show loading div, etc...
            $.ajax({
                url: base_url + "Verify_login/check_session",
                type: "POST",

                success: function (response) {
                    if(response==0){
                        location.reload();
                    }

                }
            });
        });
});