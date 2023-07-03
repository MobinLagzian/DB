<?php

   error_reporting(E_ERROR | E_PARSE);

   include 'config/db_connect.php';

function reserve($studentID){

   include 'config/db_connect.php';

   // show food
   print("\n\nthese are list of your researved foods: \n");

   $sql = 'SELECT name, launchTiime FROM food,reserve where reserve.food_food_id = food.food_id AND reserve.student_idstudent='.$studentID;
   $result = mysqli_query($conn, $sql);
   $foods = mysqli_fetch_all($result, MYSQLI_ASSOC);

   for($i=0; $i<count($foods); $i++){
      echo "  food: ".$foods[$i]['name']."  time: ".$foods[$i]['launchTiime']."\n";
   }
   mysqli_free_result($result);


   //delete food
   print("\n\nDo you want delete food? (enter food ID): \n");  
   
   $deletedFood=01;

   $sql = 'DELETE FROM reserve WHERE food_food_id = '.$deletedFood .' AND student_idstudent = '.$studentID;
   if (mysqli_query($conn, $sql)) {
      echo "Your food deleted successfully\n";
   } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
   


   //researve food
   print("\n\nthese are list of foods in this week: (enter food ID)\n");

   $sql = 'SELECT food_id, name, cost, launchTiime FROM food';
   $result = mysqli_query($conn, $sql);
   $foods = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
   for($i=0; $i<count($foods); $i++){
      echo "food ID: ".$foods[$i]['food_id']."  food: ".$foods[$i]['name']."  cost: ".$foods[$i]['cost']."  time: ".$foods[$i]['launchTiime']."\n";
   }


   mysqli_free_result($result);


   print("\n\nenter your reserve food:\n");

   $reserveFood = '01';

   $sql = 'INSERT INTO reserve(food_food_id,student_idstudent) VALUES ('.$reserveFood.', '.$studentID.')';
   if (mysqli_query($conn, $sql)) {
      echo "Your food researved successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_free_result($result);
    
}

function showSchedule($studentID) {

   print("\n\nYour term schedule: \n");

   $sql = 'SELECT DISTINCT cource.courceName, cource.class, professor.profname
            FROM termSchedule
            WHERE student_idstudent='.$studentID ;
   $result = mysqli_query($conn, $sql);
   $schedule = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
   for($i=0; $i<count($schedule); $i++){
      echo "courceName: ".$schedule[$i]['cource.courceName']."  class: ".$schedule [$i]['cource.class']."  profname: ".$schedule [$i]['professor.profname']."\n";
   }
   mysqli_free_result($result);


}
function addcourse($studentID) {

   include 'config/db_connect.php';

   $openDate = 2023-07-2;
   $closeDate = 2023-07-7;
   if(date("Y-m-d") < $openDate and date("Y-m-d") > $closeDate){
      print("we are not in selection time");
      return(0);
   }

   // show courses
   print("\n\nthese are list of courses: \n");

   $sql = 'SELECT idcource,courceName FROM cource';
   $result = mysqli_query($conn, $sql);
   $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
   for($i=0; $i<count($courses); $i++){
      echo "course ID: ".$courses[$i]['idcource']."  course Name: ".$courses[$i]['courceName']."\n";
   }

   mysqli_free_result($result);



   //add course
   print("\n\nyou want select a corse?(enter course ID) \n");
   
   $selectedCourse = 12345;

   $sql = 'INSERT INTO choose VALUES ('.$studentID.', '.$selectedCourse.')';
   if (mysqli_query($conn, $sql)) {
      echo "Your cource researved successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_free_result($result);
   
   for($i=0; $i<count($schedule); $i++){
      echo "courceName: ".$schedule[$i]['cource.courceName']."  class: ".$schedule [$i]['cource.class']."  profname: ".$schedule [$i]['professor.profname']."\n";
   }
   mysqli_free_result($result);


   //delete course
   print("\n\nDo you want delete course? (enter course ID): \n");  
   
   $deletedCourse=12345;

   $sql = 'DELETE FROM choose WHERE cource_idcource = '.$deletedCourse .' AND student_idstudent = '.$studentID;
   if (mysqli_query($conn, $sql)) {
      echo "Your course deleted successfully\n";
   } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
}

function edit($studentID) {
   include 'config/db_connect.php';
   $name='hassan mohammadi';
   $sql= 'SELECT sname from student WHERE idstudent='.$studentID;
   $result = mysqli_query($conn, $sql);
   $edit = mysqli_fetch_all($result, MYSQLI_ASSOC);

   for($i=0; $i<count($edit); $i++){
      echo "  name: ".$edit[$i]['sname']."\n";
   }
   
   mysqli_free_result($result);
   
   $sql = "UPDATE student SET student.sname = '".$name."' where idstudent =".$studentID;
   if (mysqli_query($conn, $sql)) {
      echo "Your cource researved successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   
   mysqli_free_result($result);

}
function presentation($studentId){
   include 'config/db_connect.php';
   $sql= 'SELECT cource.courceName, present.classtime, present.status FROM cource,present  
   WHERE present.student_idstudent='.$studentId.' AND  present.cource_idcource=coursce.idcource GROUP BY present.student_idstudent';
   $result = mysqli_query($conn, $sql);
   $pst = mysqli_fetch_all($result, MYSQLI_ASSOC);

   for($i=0; $i<count($pst); $i++){
      echo "courceName: ".$pst[$i]['cource.courceName']."  classtime: ".$pst [$i]['present.classtime']."  status: ".$pst [$i]['present.status']."\n";
   }
   mysqli_free_result($result);

}
function viewdetail($studentId) {
   include 'config/db_connect.php';
   $sql = 'SELECT * FROM termSchedule';
   $result = mysqli_query($conn, $sql);
   $pst = mysqli_fetch_all($result, MYSQLI_ASSOC);
   for($i=0; $i<count($pst); $i++){
      echo "courceName: ".$pst[$i]['cource.courceName']."  classtime: ".$pst [$i]['present.classtime']."  status: ".$pst [$i]['present.status']."\n";
   }
}
function deleteSingel(studentId) {
   include 'config/db_connect.php';
   $openDate = 2023-07-2;
   $closeDate = 2023-07-7;
   if(date("Y-m-d") < $openDate and date("Y-m-d") > $closeDate){
      print("we are not in selection time");
      return(0);
   }

   print("\n\nDo you want delete course? (enter course ID): \n");  
   
   $deletedCourse=12345;

   $sql = 'DELETE FROM choose WHERE cource_idcource = '.$deletedCourse .' AND student_idstudent = '.$studentID;
   if (mysqli_query($conn, $sql)) {
      echo "Your course deleted successfully\n";
   } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
}
function evaluation($studentID) {
   print("\n\nDo you want evaloate professor? (enter professor ID): \n");

   $sql= 'SELECT idprofessor, profname FROM professor';
   $result = mysqli_query($conn, $sql);
   $professor = mysqli_fetch_all($result, MYSQLI_ASSOC);
   for($i=0; $i<count($professor); $i++){
      echo "professor ID: ".$professor[$i]['idprofessor']."  professor Name: ".$professor [$i]['profname']."\n";
   } 
   mysqli_free_result($result);

   $evaluatedProfessor=12345;
   $score = 20;

   $sql = 'INSERT INTO profelvaluation(student_idstudent,professor_idprofessor,score) VALUES ('.$studentID.', '.$evaluatedProfessor.', '$score')';
   if (mysqli_query($conn, $sql)) {
      echo "Your comment aded successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   mysqli_free_result($result);
}
function view1() {
   include 'config/db_connect.php';
   $sql = 'SELECT * FROM GoodProf';
   $result = mysqli_query($conn, $sql);
   $pst = mysqli_fetch_all($result, MYSQLI_ASSOC);
   for($i=0; $i<count($pst); $i++){
      echo "idprofessor: ".$pst[$i]['professor.idprofessor']."  profname: ".$pst [$i]['professor.profname']."\n";
   }
}
function view2() {
   include 'config/db_connect.php';
   $sql = 'SELECT * FROM drop';
   $result = mysqli_query($conn, $sql);
   $pst = mysqli_fetch_all($result, MYSQLI_ASSOC);
   for($i=0; $i<count($pst); $i++){
      echo "idstudent: ".$pst[$i]['student.idstudent']."  name : ".$pst [$i]['student.sname ']."\n";
   }
}
function view3($studentId) {
   include 'config/db_connect.php';
   $sql = 'SELECT courceName FROM passedLessons WHERE student_idstudent='.$studentId;
   $result = mysqli_query($conn, $sql);
   $pst = mysqli_fetch_all($result, MYSQLI_ASSOC);
   for($i=0; $i<count($pst); $i++){
      echo "courceName: ".$pst[$i]['cource.courceName']."  classtime: ".$pst [$i]['present.classtime']."  status: ".$pst [$i]['present.status']."\n";
   }
}
function view4() {
   include 'config/db_connect.php';
   $sql = 'SELECT courceName FROM AStudents ';
   $result = mysqli_query($conn, $sql);
   $pst = mysqli_fetch_all($result, MYSQLI_ASSOC);
   for($i=0; $i<count($pst); $i++){
      echo $pst[$i]."\n";
   }
}


   $studentID = 991276264;

   print("enter yor task baseed on this numbers:\n
        0 for reserve food \n
        1 for see schedule\n
        2 for select course\n
        3 for delete course\n
        4 for edit profile\n
        5 for viee course details\n
        6 for view report card\n
        7 for view presentation\n
        8 for avaluate professors\n
        9 for view exam Schedule\n
        10 for view 1
        11 for view 2
        12 for view 3
        13 for view 4");
$a=2;
   if($a == 0){reserve($studentID);}
   if($a == 1){showSchedule($studentID);}
   if($a == 2){addcourse($studentID);}
   if($a == 3){deleteSingel($studentID);}
   if($a == 4){edit($studentID);}
   if($a == 5){viewdetail($studentID);}
   if($a == 6){}
   if($a == 7){presentation($studentID);}
   if($a == 8){evaluation($studentID);}
   if($a == 9){}
   if($a == 10){view1();}
   if($a == 11){view2();}
   if($a == 12){view3(studentId);}
   if($a == 13){view4();}
   


?>

