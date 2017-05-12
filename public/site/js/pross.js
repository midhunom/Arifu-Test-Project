
var App = angular.module('courseApp', []);

App.controller('statsController', function($scope, $http, $location, $anchorScroll) {

    $scope.student = {};
    $scope.student.gender = 'male';

    $scope.submitForm = function($student) {



        $http({
            method  : 'get',
            url     : 'http://localhost:8000/user/'+$student.name+'/'+$student.email+'/'+$student.gender+'',
            headers : {'Content-Type': 'application/json'}
        }).then(function(data) {
            $scope.response = data.data;
            $scope.showAllStudents();
            //console.log($scope.response);
            $scope.student.name = ''
            $scope.student.email = ''

        });
    };

    // ===get all students===
    $scope.showAllStudents = function() {
        $http.get("http://localhost:8000/api/v1/school").then(function(data) {
            $scope.students = data.data;
            //console.log($scope.students);
        });
    }
    $scope.showAllStudents();

    // / ===get all students info===
    $scope.link = {};
    $scope.showInfo = function($link, $studentName) {
         $http.get($link).then(function(data) {
            $scope.student_name = $studentName;
            $scope.studentdata = data.data;
            //console.log($scope.studentdata);
        });
    }


    // ===get all courses===
    $scope.showAllCourses = function() {
        $http.get("http://localhost:8000/api/v1/school?courses=1").then(function(data) {
            $scope.courses = data.data;
           //console.log($scope.courses);
        });
    }

    $scope.showAllCourses();


    // ===get details about course==
    $scope.courseDet = function($id, $courseName){
        $scope.disp = true;
            $http.get("http://localhost:8000/api/v1/school?course="+$id).then(function(data) {
            $scope.coursename = $courseName;
            $scope.coursedatas = data.data;
            //console.log( $scope.coursedatas);
        });

    }

    // ===get course certificates awarded==
    $scope.courseCerts = function(){

        $scope.collect = [];
        $http.get("http://localhost:8000/api/v1/school?certs=c").then(function(data) {
             $scope.coursecerts = data.data;

            for($scope.d = 0; $scope.d<$scope.coursecerts.length; $scope.d++){
               $scope.collect.push($scope.coursecerts[$scope.d]);

            }
               //console.log($scope.collect) ;
        });

    }
    $scope.courseCerts();


    $scope.scrollToTable = function($scrollPlace) {
        $location.hash($scrollPlace);
        $anchorScroll();
    };

    // ===get details about course application==
    $scope.courseApplic = function($id){
        $scope.disp = true;
        $http.get("http://localhost:8000/api/v1/school?date="+$id+",2017-05-10,2017-05-14").then(function(data) {
            $scope.courseApps = data.data;
            console.log( $scope.courseApps);
        });

    }



});