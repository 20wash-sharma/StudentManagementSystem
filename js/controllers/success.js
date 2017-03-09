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
        
        $scope.onStudentDropDownChange = function (studentid) {
            
            Data.filterSubjectDropDown(studentid).then(function (results) {
                 
                 console.log(results);
               $rootScope.filteredsubjects=results;


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
                    $scope.sstudent={};
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
                     $scope.sclass={};
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
                    $scope.ssubject={};
                     Data.getSubject().then(function (results) {
                         $rootScope.subjects=results;
                         console.log(results);
                          $rootScope.subjectslength= Object.keys($rootScope.subjects).length;
                      
                          
                       
                        
                         
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
       console.log($scope.ssstudent);
       console.log($rootScope.filteredsubjects);
       for(sub in  $rootScope.filteredsubjects)
       {
         console.log($rootScope.filteredsubjects[sub].subject_name);
       }
            
            /*Data.addMarks($scope.ssstudent).then(function (status) {
                 toaster.clear();
                 console.log(status);
                if (status == 'success')
                {
                     $scope.ssstudent={};
                     Data.getStudentMarksInfo().then(function (results) {
                         $rootScope.studentMarkInfo=results;
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
            });*/


        };
        
        
     
    }]);