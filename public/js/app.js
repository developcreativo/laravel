var app = angular.module('app',['ngRoute']);

app.config(function($routeProvider)
{
    $routeProvider.when('/pos', {
        templateUrl : '/index.html',
        controller : 'POSController'
    })});


app.controller('POSController', function ($scope) {
    $scope.food = {
      pizza       : {count: 1, detail: "Brick Oven Pizza", price: 15},
      donut       : {count: 3, detail: "Glazed Donut",price: 8},
      tortilla    : {count: 1, detail: "Tortilla Chips",price: 3},
      burger      : {count: 1, detail: "Burger",price: 3},
      samosa      : {count: 1, detail: "Delicious Samosas",price: 3},
      coldcoffee  : {count: 1, detail: "Cold Coffee",price: 2},
      hotcoffee   : {count: 1, detail: "Hot Coffee",price: 2},
      coke        : {count: 1, detail: "Coke",price: 2},
      dietcoke    : {count: 1, detail: "Diet Coke",price: 2},
      pepsi       : {count: 1, detail: "Pepsi",price: 2}
    };
    
    
    $scope.itemsCnt = 1;
    
    $scope.order = [];
    
    $scope.add = function(item) {
      var foodItem = {
        id : $scope.itemsCnt,
        item : item
      };
      $scope.order.push(foodItem);
      $scope.itemsCnt = $scope.order.length;
    };
    
    $scope.getSum = function() {
      var i = 0,
        sum = 0;
      for(; i < $scope.order.length; i++) {
        sum += parseInt($scope.order[i].item.price, 10);
      }
      return sum;
    };
    
    $scope.deleteItem = function(index) {
      $scope.order.splice(index,1);
    };
    
    $scope.checkout = function(index) {
      alert("Order total: $" + $scope.getSum() + "\n\nPayment received. Thanks.");
    };
    
    $scope.clearOrder = function() {
      $scope.order = [];
    };
});


