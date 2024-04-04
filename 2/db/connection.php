<?php 
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','db_student');

try{
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
}
catch(Exception $e){
    die("Error: ".mysqli_connect_error(). "<br>" . $e);
}
?>