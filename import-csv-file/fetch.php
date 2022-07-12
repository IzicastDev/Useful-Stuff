<?php

//fetch.php

if(!empty($_FILES['csv_file']['name']))
{
  $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
  $column = fgetcsv($file_data);
   while($row = fgetcsv($file_data))
     {
/*
        $row_data[] = array(
         'student_name'  => $row[0],
         'student_phone'  => $row[1]
        );
*/

      $row_data[] = array(
        'speaker_id'              => $row[0],
        'speaker_firstName'       => $row[1],
        'speaker_lastName'        => $row[2],
        'speaker_title'           => $row[3],
        'speaker_company'         => $row[4],
        'speaker_position'        => $row[5],
        'speaker_description'     => $row[6],
        'speaker_image'           => $row[7],
        'speaker_sessionSubject'  => $row[8]
       );
     }
  $output = array(
    'column'  => $column,
    'row_data'  => $row_data
   );

  echo json_encode($output);

}

?>