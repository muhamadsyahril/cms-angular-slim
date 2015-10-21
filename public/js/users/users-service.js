'use strict';

angular.module('slimapp')
  .factory('Users', ['$resource', function ($resource) {
    return $resource('slimapp/users/:id', {}, {
      'query': { method: 'GET', isArray: true},
      'get': { method: 'GET'},
      'update': { method: 'PUT'}
    });
  }]);
