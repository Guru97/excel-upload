<?php


require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');
require('db_config.php');


if(isset($_POST['Submit']))
{
    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

    $Reader = new SpreadsheetReader($uploadFilePath);

    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".


    $html="<table border='1'>";
    $html.="<tr><th>fname</th><th>lname</th></tr>";


    /* For Loop for all sheets */
  //  for($i=0;$i<$totalSheet;$i++){


//      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)
      {
        $html.="<tr>";
        $fname = isset($Row[0]) ? $Row[0] : ''; 
        $lname = isset($Row[1]) ? $Row[1] : '';
        echo $fname;
        echo $lname;
        die();
        $html.="<td>".$fname."</td>";
        $html.="<td>".$lname."</td>";
        $html.="</tr>";


        $query = "insert into excel(fname,lname) values('".$fname."','".$lname."')";


        $mysqli->query($query);
       }


  //  }


    $html.="</table>";
    echo $html;
    echo "<br />Data Inserted in dababase";

}

?>