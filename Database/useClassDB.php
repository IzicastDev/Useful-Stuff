<?php
  
 // https://www.youtube.com/watch?v=NLTO82RXlpQ
  
  require_once "utils.php";
  require_once "Database.php";
  
  $db = new Database(); 
  
  

//GET ROW
    $getRow = $db->getRow("SELECT * FROM athlete WHERE atn_race_number=?", ["3"]);
    // test it
    __("Get Single ROW: ", $getRow);
    
//GET ROWS
  $getRows = $db->getRows("SELECT * FROM athlete");
  // test it
  __("Get Multiple ROWS: ", $getRows);
  
  
//INSERT ROWS
$insertRow = $db->insertRow("INSERT INTO athlete(atn_race_number, atn_first_name, atn_last_name, atn_team_name) VALUE (?,?,?,?)", ["243","arthur", "Mann", "DBTeam"] );
// test it
__("Insert ROW: ", $insertRow);

//UPDATE ROW
$race_number  = "356";
$first_name   = "Duarte";
$last_name    = "Magalhães";
$team_name    = "Atelier";
$id           = 20;

$updateRow = $db->updateRow("UPDATE live SET race_number=?, first_name=?,last_name=?, team_name=? WHERE id=? ", 
[$race_number , $first_name, $last_name, $team_name , $id    ] );
// test it
__("UPDATE ROW: ", $updateRow);