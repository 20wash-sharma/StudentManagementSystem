myApp.controller('SuccessController', 
['$scope', '$http', '$location', 'Data', '$rootScope','$routeParams','toaster',
    function ($scope, $http, $location, Data, $rootScope,$routeParams,toaster) {
        $scope.message = "Welcome!!!";
       
                 
        $scope.updateuserinfo = function () {
            Data.updateUserInfo().then(function (status) {
                 toaster.clear();
                if (status == 'success')
                {
                    //$location.path('/profile');
                     toaster.pop('info', "", 'successfully updated', 3000, 'trustedHtml');
                } else if (status == 'usernameexists') {
                    $scope.invalidmessage = 'User name already exists';
                    
                     toaster.pop('warning', "", 'username exists', 3000, 'trustedHtml');
                 
                } else
                {
                    $scope.invalidmessage = 'Update failed';
                }


            }, function (err) {
                //document.write(err);
                $scope.invalidmessage = err;
            });


        };
         $scope.addStudent = function () {
            
            Data.addStudentInfo($scope.sstudent).then(function (status) {
                 toaster.clear();
                 console.log(status);
                if (status == 'success')
                {
                    //$location.path('/profile');
                    Data.getStudent().then(function (results) {
                         $rootScope.students=results;
                         
                          console.log(results);
                       
                        
                         
                     });
                     toaster.pop('info', "", 'successfully added', 3000, 'trustedHtml');
                } else
                {
                    $scope.invalidmessage = 'add failed';
                     toaster.pop('warning', "", 'add failed', 3000, 'trustedHtml');
                }


            }, function (err) {
                //document.write(err);
                $scope.invalidmessage = err;
            });


        };
     $scope.addClass = function () {
       
            
            Data.addClass($scope.sclass).then(function (status) {
                 toaster.clear();
                 console.log(status);
                if (status == 'success')
                {
                    Data.getClass().then(function (results) {
                         $rootScope.classes=results;
                         
                          console.log(results);
                       
                        
                         
                     });
                     toaster.pop('info', "", 'successfully added', 3000, 'trustedHtml');
                } else
                {
                    $scope.invalidmessage = 'add failed';
                     toaster.pop('warning', "", 'add failed', 3000, 'trustedHtml');
                }


            }, function (err) {
                //document.write(err);
                $scope.invalidmessage = err;
            });


        };
      $scope.addSubject = function () {
       
            
            Data.addSubject($scope.ssubject).then(function (status) {
                 toaster.clear();
                 console.log(status);
                if (status == 'success')
                {
                     Data.getSubject().then(function (results) {
                         $rootScope.subjects=results;
                         console.log(results);
                         
                          
                       
                        
                         
                     });
                     toaster.pop('info', "", 'successfully added', 3000, 'trustedHtml');
                } else
                {
                    $scope.invalidmessage = 'add failed';
                     toaster.pop('warning', "", 'add failed', 3000, 'trustedHtml');
                }


            }, function (err) {
                //document.write(err);
                $scope.invalidmessage = err;
            });


        };
     $scope.addMarks = function () {
       
            
            Data.addMarks($scope.ssstudent).then(function (status) {
                 toaster.clear();
                 console.log(status);
                if (status == 'success')
                {
                    //$location.path('/profile');
                     toaster.pop('info', "", 'successfully added', 3000, 'trustedHtml');
                } else
                {
                    $scope.invalidmessage = 'add failed';
                     toaster.pop('warning', "", 'add failed', 3000, 'trustedHtml');
                }


            }, function (err) {
                //document.write(err);
                $scope.invalidmessage = err;
            });


        };
        
        
     
    }]);