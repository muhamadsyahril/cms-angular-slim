'use strict';

angular.module('slimapp')
  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .when('/users', {
        templateUrl: 'views/users/users.html',
        controller: 'UsersController',
        resolve:{
          resolvedUsers: ['Users', function (Users) {
            return Users.query();
          }]
        }
      })
    }]);
