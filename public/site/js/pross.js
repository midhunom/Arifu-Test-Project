
var App = angular.module('courseApp', []);

App.controller('statsController', function($scope, $http, $location, $anchorScroll, schoolService) {

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
            $scope.student.name = ''
            $scope.student.email = ''

        });
    };

    // ===get all students===
    $scope.$scope.showAllStudents = function(){
        schoolService.getAllStudents().then(function(data){
            $scope.students = data.data;
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
        schoolService.getAllCourses().then(function(data) {
            $scope.courses = data.data;
           //console.log($scope.courses);
        });
    }

    $scope.showAllCourses();


    // ===get details about course==
    $scope.courseDet = function($id, $courseName){
        $scope.disp = true;
            schoolService.getCoursedetails($id).then(function(data) {
            $scope.coursename = $courseName;
            $scope.coursedatas = data.data;
            //console.log( $scope.coursedatas);
        });

    }

    // ===get course certificates awarded==
    $scope.courseCerts = function(){

        $scope.collect = [];
        schoolService.getCourseCert().then(function(data) {
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
        schoolService.getCourseAppDetails($id).then(function(data) {
            $scope.courseApps = data.data;
            //console.log( $scope.courseApps);
        });

    }



});