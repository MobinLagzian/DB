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
        9 for view exam Schedule\n");

   $a = 1;
   if($a == 0){reserve($studentID);}
   if($a == 1){showSchedule($studentID);}
   if($a == 2){addcourse($studentID);}
   if($a == 3){}
   if($a == 4){}
   if($a == 5){}
   if($a == 6){}
   if($a == 7){}
   if($a == 8){}
   if($a == 9){}
?>

