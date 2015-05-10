var app = angular.module('contactsApp', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
	$routeProvider
        .when('/contacts', {
    		'templateUrl': 'src/views/list.html',
    		'controller': 'ContactsController'
    	})
        .when('/contacts/new', {
            'templateUrl': 'src/views/new.html',
            'controller': 'NewContactController'
        });
}]);

app
    .controller('ContactsController', function ($scope, $http) {
        $http.get('api/contacts').success(function(response) {
            $scope.contacts = response;
        });

        $scope.order = 'first_name';
        $scope.reverse = false;

        $scope.setOrder = function(order) {
            $scope.order = order;
        };

        $scope.setSort = function()
        {
            $scope.reverse = ! $scope.reverse;
        };
    })
    .controller('NewContactController', function($scope, $http) {
        $scope.order = 'first_name';
        $scope.save = function (contact) {
            $http.post('api/contacts', contact);
        }
    });
