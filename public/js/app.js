var app = angular.module("myapp",[]);

app.controller("usercontroller", function($scope, $http){

let products = [];
    $http.get("/devis/getProductsForm")
        .then(function(response) {
            $.each(response.data, function (key, value) {
                $.each(value, function (key, value) {
                    products.push(value.categoryName);
                    $scope.names = products;
                })
            })
        });
});

