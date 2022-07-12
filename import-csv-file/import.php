<?php
session_start();
//import.php
// Get DATABASE class.
require_once "assets/utils/Database.php";
require_once "assets/utils/errors.php";


// Init Variables
$insertRow = "";
$output = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  //Init DB lower_thirds
    $db = new Database();
  
  //GET DATA FROM POST
    $speaker_id = $_POST["speaker_id"];
    $speaker_firstName = $_POST["speaker_firstName"];
    $speaker_lastName = $_POST["speaker_lastName"];
    $speaker_title = $_POST["speaker_title"];
    $speaker_company = $_POST["speaker_company"];
    $speaker_position = $_POST["speaker_position"];
    $speaker_description = $_POST["speaker_description"];
    $speaker_image = $_POST["speaker_image"];
    $speaker_sessionSubject = $_POST["speaker_sessionSubject"];
   
   
   
   
   
   
   for($count = 0; $count < count($speaker_id); $count++)
   {
      
      $insertRow = $db->insertRow("INSERT INTO speakers( `id`, `firstName`, `lastName`, `title`, `company`, `position`, `description`, `image`, `sessionSubject`) 
                                        VALUE (?,?,?,?,?,?,?,?,?)", [
                                                                   $speaker_id[$count], 
                                                                   $speaker_firstName[$count], 
                                                                   $speaker_lastName[$count],
                                                                   $speaker_title[$count],
                                                                   $speaker_company[$count],
                                                                   $speaker_position[$count],
                                                                   $speaker_description[$count],
                                                                   $speaker_image[$count],  
                                                                   $speaker_sessionSubject[$count]
                                                                  ] );
   
     // if return error
      if( $insertRow !== TRUE ){
          break;
      }
     
   }// for

  
   // if return error
   if( $insertRow !== TRUE ){
     // Put the error on the flash message 
      $response = [
        "success" => 0,
        "message" => $insertRow->getMessage(), 
        "code"    => $insertRow->getCode(), 
        "file"    => $insertRow->getFile(), 
        "line"    => $insertRow->getLine()
      ];   
      echo json_encode($response);
   
  } else {
    // file uploaded
    //echo json_encode(array("success"=>1));
    echo "Success";
  
  }

} // if POST





?>
