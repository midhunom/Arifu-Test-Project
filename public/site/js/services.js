App.factory('schoolService', function($http){

    return{

        getAllStudents:function(){
            return $http.get("http://localhost:8000/api/v1/school").then(function(response) {
                response.data;
                //console.log($scope.students);
            });
        },

        getAllCourses:function(){
            return $http.get("http://localhost:8000/api/v1/school?courses=1").then(function(response){
                response.data;
            })
        },
        getCoursedetails:function($id){
            return $http().get("http://localhost:8000/api/v1/school?course="+$id).then(function(response){
                response.data;
            })
        },
        getCourseCert:function(){
            return $http.get("http://localhost:8000/api/v1/school?certs=c").then(function(response){
                response.data;
            })
        },
        getCourseAppDetails:function($id){
            return $http.get("http://localhost:8000/api/v1/school?date="+$id+",2017-05-10,2017-05-14").then(function(response){
                response.data;
            })
        }
    }


})
