<?php 
include("config.php");

$target_dir = "../files/";

//Unique file name so no data is lost
$file_new_name_array = explode(".", basename($_FILES["fileToUpload"]["name"]));
$file_new_name = ($file_new_name_array[0] . "_" . date("Ymdhis") . "." . $file_new_name_array[1]);

$target_file = $target_dir . $file_new_name;
$uploadOk = 1;
$error = "";

if(isset($_POST['submit']))
{
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $error =  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
}

echo $error;

if($uploadOk == 1)
{
    //Parse text
    //each line is a new data:
    //x, y, z, a, b, c, d, e, f, g, h, i, date
    //space localisation + 9 variables for data storage + date
    //total 12 vars

    $txt_file    = file_get_contents($target_file);
    $rows        = explode("\n", $txt_file);

    foreach($rows as $row => $data)
    {
        $row_data = explode(",", $data);
        $x = $row_data[0]; //longitude
        $y = $row_data[1]; //altitude
        $z = $row_data[2]; //latitude
        $a = $row_data[3]; //BOD Biochimical oxygene demand  
        $b = $row_data[4]; //Dissolved Oxygen
        $c = $row_data[5]; //Fecal Coliform
        $d = $row_data[6]; //Nitrates
        $e = $row_data[7]; //pH
        $f = $row_data[8]; //Temps
        $g = $row_data[9]; //Total dissolved solids
        $h = $row_data[10]; //Total phosphate
        $i = $row_data[11]; //Turbidity
        $date = $row_data[12]; //date

        //Send data to database before algo run
        $sql = "INSERT INTO data_logs (x, y, z, a, b, c, d, e, f, g, h, i, date_time) VALUES ($x, $y, $z, $a, $b, $c, $d, $e, $f, $g, $h, $i, $date)";
        $db->query($sql);

        //run algo
        (float)$water_state = $a * 0.11 + $b * 0.17 + $c * 0.16 + $d * 0.10 + $e * 0.11 + $f * 0.10 + $g * 0.07 + $h * 0.10 + $i * 0.08;

        $result = mysqli_query($db, "SELECT id FROM circuit WHERE x=$x AND y=$y AND z=$z limit 1");
        $value = mysqli_fetch_object($result);

        $sql = "INSERT INTO chart_info (x, y) VALUES ($value->id, $water_state)";
        $db->query($sql);
    }
}

?>